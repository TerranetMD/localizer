<?php

namespace Terranet\Localizer;

use Illuminate\Support\Manager;
use Terranet\Localizer\Resolvers\DomainResolver;
use Terranet\Localizer\Resolvers\EnvironmentResolver;
use Terranet\Localizer\Resolvers\RequestResolver;

class Resolver extends Manager
{
    protected $resolvers = [
        'request',
        'domain',
        'environment',
    ];

    public function createRequestDriver()
    {
        return new RequestResolver(app('request'));
    }

    /**
     * @return DomainResolver
     */
    public function createDomainDriver()
    {
        return new DomainResolver(app('request'));
    }

    /**
     * @return EnvironmentResolver
     */
    public function createEnvironmentDriver()
    {
        return new EnvironmentResolver();
    }

    /**
     * Resolve locale
     *
     * @return mixed
     */
    public function resolve()
    {
        if ($driver = $this->getDefaultDriver()) {
            return $this->driver($driver)->resolve();
        }

        foreach ($this->resolvers as $resolver) {
            if ($locale = $this->driver($resolver)->resolve()) {
                return $locale;
            }
        }

        return config('app.fallback_locale');
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return config('localizer.resolver');
    }
}

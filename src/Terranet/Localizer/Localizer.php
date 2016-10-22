<?php

namespace Terranet\Localizer;

class Localizer
{
    /**
     * Resolved locale
     *
     * @var
     */
    protected static $locale;

    protected $resolver;

    protected $provider;

    /**
     * Localizer constructor.
     *
     * @param Resolver $resolver
     * @param Provider $provider
     */
    public function __construct(Resolver $resolver, Provider $provider)
    {
        $this->resolver = $resolver;
        $this->provider = $provider;
    }

    /**
     * Find locale
     *
     * @return mixed
     */
    public function find()
    {
        if (null === static::$locale) {
            /**
             * 1. resolve locale
             * 2. find resolved locale using provider
             * 3. if not found resolved locale => fetch default locale using provider
             */
            if (! ($resolved = $this->resolver->resolve()) ||
                ! ($locale = $this->provider->find($resolved))
            ) {
                $resolved = config('app.fallback_locale');
                if (! $locale = $this->provider->find($resolved)) {
                    $locale = $this->getDefault();
                }
            }

            static::$locale = $locale;
        }

        return static::$locale;
    }

    /**
     * Fetch all active languages
     *
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->provider->fetchAll();
    }

    /**
     * Get default locale
     *
     * @return mixed
     */
    public function getDefault()
    {
        return $this->provider->getDefault();
    }

    public function getResolver()
    {
        return $this->resolver;
    }
}

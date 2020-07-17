<?php

namespace Terranet\Localizer\Resolvers;

use Illuminate\Http\Request;
use Terranet\Localizer\Contracts\Resolver;
use Terranet\Localizer\Locale;

class DomainResolver implements Resolver
{
    /**
     * @var Request
     */
    private $request;

    /**
     * DomainResolver constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Resolve locale using domain name
     *
     * @return mixed
     */
    public function resolve()
    {
        $httpHost = $this->request->getHttpHost();
        $domains = explode('.', $httpHost);
        $level = config('localizer.domain.level', 3);

        return ($total = count($domains)) >= $level ? $domains[$total - $level] : null;
    }

    /**
     * Re-Assemble current url with different locale.
     *
     * @param mixed string|Locale $iso
     * @param null $url
     * @return mixed
     */
    public function assemble($iso, $url = null)
    {
        // TODO: Implement assemble() method.
        return url($url);
    }
}

<?php

namespace Terranet\Localizer\Contracts;

use Terranet\Localizer\Locale;

interface Resolver
{
    /**
     * Resolve locale
     *
     * @return mixed
     */
    public function resolve();

    /**
     * Re-Assemble current url with different locale.
     *
     * @param mixed string|Locale $iso
     * @param null $url
     * @return mixed
     */
    public function assemble($iso, $url = null);
}

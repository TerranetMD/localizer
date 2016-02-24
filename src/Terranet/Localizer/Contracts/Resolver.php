<?php

namespace Terranet\Localizer\Contracts;

interface Resolver
{
    /**
     * Resolve locale
     *
     * @return mixed
     */
    public function resolve();
}

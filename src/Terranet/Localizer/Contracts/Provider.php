<?php

namespace Terranet\Localizer\Contracts;

interface Provider
{
    /**
     * Fetch all available languages
     *
     * @return mixed
     */
    public function fetchAll();
}

<?php

use Terranet\Localizer\Models\Language;

return [
    /*
    |--------------------------------------------------------------------------
    | Default Locale Resolver
    |--------------------------------------------------------------------------
    |
    | This option controls the default locale resolver.
    | Available providers: request, domain, environment
    |
    */
    'resolver' => null,

    /*
    |--------------------------------------------------------------------------
    | Default Locales Provider
    |--------------------------------------------------------------------------
    |
    | This option controls the default locales provider.
    | Available providers: eloquent
    |
    */
    'provider' => 'eloquent',

    /*
    |--------------------------------------------------------------------------
    | Default Model
    |--------------------------------------------------------------------------
    |
    | This option controls the default model used by Eloquent provider.
    |
    */
    'eloquent' => [
        'model' => Language::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Request Section
    |--------------------------------------------------------------------------
    |
    | This option controls the default section used by Request resolver
    | while extracting locale from request url.
    |
    */
    'request'  => [
        // segment to read while detecting from request uri
        'segment' => 1,

        // header to read while detecting from headers
        'header'  => 'HTTP_ACCEPT_LANGUAGE',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Domain Level
    |--------------------------------------------------------------------------
    |
    | This option controls the default domain level used by Domain resolver
    | while extracting locale from domain name.
    |
    */
    'domain'   => [
        'level' => 3,
    ],
];

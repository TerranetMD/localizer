<?php

namespace localizer {

    use Closure;
    use InvalidArgumentException;
    use Route;
    use Terranet\Localizer\Locale;

    /**
     * Fetch locale if specified or return all available locales
     *
     * @return mixed
     */
    function locales()
    {
        return app('terranet.localizer')->fetchAll();
    }

    /**
     * Fetch locale if specified or return all available locales
     *
     * @return mixed
     */
    function locale()
    {
        return app('terranet.localizer')->find();
    }

    /**
     * Fetch default locale
     *
     * @return mixed
     */
    function getDefault()
    {
        return app('terranet.localizer')->getDefault();
    }

    /**
     * Localizer router helper
     *
     * @param         $attributes
     * @param Closure $callback
     * @throws InvalidArgumentException
     */
    function group($attributes, Closure $callback = null)
    {
        Route::group($attributes, $callback);

        /**
         * register localized routes
         */
        if ($locale = locale()) {
            $attributes = array_merge(
                $attributes,
                ['prefix' => $locale->iso6391()]
            );

            Route::group($attributes, $callback);
        }
    }

    /**
     * Rebuild url to a new locale.
     *
     * @param $iso
     * @param null $url
     * @return mixed
     */
    function url($iso, $url = null)
    {
        if (is_null($url)) {
            $url = request()->getRequestUri();
        }

        if ($prefix = Route::current()->getPrefix()) {
            $url = substr($url, strlen($prefix));
        }

        if ($iso instanceof Locale) {
            $iso = $iso->iso6391();
        }

        return app('terranet.localizer')->getResolver()->assemble($iso, $url);
    }
}

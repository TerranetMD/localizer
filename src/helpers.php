<?php

namespace localizer {

    use Closure;
    use InvalidArgumentException;
    use Route;

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
}

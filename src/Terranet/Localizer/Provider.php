<?php

namespace Terranet\Localizer;

use Illuminate\Support\Manager;
use Terranet\Localizer\Models\Language;
use Terranet\Localizer\Providers\EloquentProvider;

class Provider extends Manager
{
    /**
     * Current locale
     *
     * @var
     */
    protected static $language = null;

    /**
     * List of available locales
     *
     * @var
     */
    protected static $languages = null;

    /**
     * Default locale
     *
     * @var
     */
    protected static $default = null;

    protected $drivers = [
        'eloquent'
    ];

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return config('localizer.provider', 'eloquent');
    }

    public function createEloquentDriver()
    {
        return new EloquentProvider(config('localizer.eloquent.model', Language::class));
    }

    /**
     * Find language by locale
     *
     * @param $locale
     * @return mixed
     */
    public function find($locale)
    {
        if (null === static::$language) {
            foreach ($this->fetchAll() as $item) {
                if ($item->locale() == $locale || $item->iso6391() == $locale) {
                    static::$language = $item;
                    break;
                }
            }
        }

        return static::$language;
    }

    /**
     * Fetch all active languages
     *
     * @return mixed
     */
    public function fetchAll()
    {
        if (static::$languages === null) {
            static::$languages = $this->driver()->fetchAll();

            static::$languages = array_map(function ($language) {
                return new Locale($language);
            }, static::$languages);
        }

        return static::$languages;
    }

    /**
     * Get default locale
     *
     * @return mixed
     */
    public function getDefault()
    {
        if (null === static::$default) {
            foreach ($this->fetchAll() as $item) {
                if ($item->isDefault()) {
                    static::$default = $item;
                    break;
                }
            }
        }

        return static::$default;
    }
}

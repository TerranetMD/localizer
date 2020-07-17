<?php

namespace Terranet\Localizer\Resolvers;

use Terranet\Localizer\Contracts\Resolver;
use Terranet\Localizer\Data;
use Terranet\Localizer\Locale;

class EnvironmentResolver implements Resolver
{
    protected static $environment = null;

    /**
     * Resolve locale
     *
     * @return mixed
     */
    public function resolve()
    {
        if (static::$environment !== null) {
            return static::$environment;
        }

        $language = setlocale(LC_ALL, 0);
        $languages = explode(';', $language);
        $languageArray = [];

        foreach ($languages as $locale) {
            if (strpos($locale, '=') !== false) {
                $language = substr($locale, strpos($locale, '='));
                $language = substr($language, 1);
            }
            if ($language !== 'C') {
                if (strpos($language, '.') !== false) {
                    $language = substr($language, 0, strpos($language, '.'));
                } else {
                    if (strpos($language, '@') !== false) {
                        $language = substr($language, 0, strpos($language, '@'));
                    }
                }
                $language = str_ireplace(
                    array_keys(Data::$languages),
                    array_values(Data::$languages),
                    (string)$language
                );
                $language = str_ireplace(array_keys(Data::$regions), array_values(Data::$regions), $language);

                $languageArray[$language] = 1;
                if (strpos($language, '_') !== false) {
                    $languageArray[substr($language, 0, strpos($language, '_'))] = 1;
                }
            }
        }
        static::$environment = $languageArray;

        return ! empty($languageArray) ? array_keys($languageArray)[0] : null;
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
        return url($url);
    }
}

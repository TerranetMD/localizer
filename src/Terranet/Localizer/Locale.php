<?php

namespace Terranet\Localizer;

class Locale
{
    protected $data;

    /**
     * Locale constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Language ID
     *
     * @return int
     */
    public function id()
    {
        return (int) $this->data['id'];
    }

    /**
     * Language ISO 639-1: two-letter codes, one per language
     *
     * @return string
     */
    public function iso6391()
    {
        return (string) $this->data['iso6391'];
    }
    
    /**
     * Alias for iso6391() method.
     *
     * @return string
     */
    public function iso()
    {
        return $this->iso6391();
    }

    /**
     * Language locale
     *
     * @return string
     */
    public function locale()
    {
        return (string) $this->data['locale'];
    }

    /**
     * Language name
     *
     * @return string
     */
    public function title()
    {
        return (string) $this->data['title'];
    }

    /**
     * Implicit flag, use this if no language detected
     *
     * @return bool
     */
    public function isDefault()
    {
        return (bool) $this->data['is_default'];
    }
}

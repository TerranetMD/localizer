<?php

namespace Terranet\Localizer\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = [
        'iso6391', 'locale', 'title', 'active', 'is_default'
    ];

    public $timestamps = false;

    /**
     * Fetch only active items
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * Fetch only locked items
     *
     * @param $query
     * @return mixed
     */
    public function scopeLocked($query)
    {
        return $query->where('active', 0);
    }

    /**
     * Fetch default item
     *
     * @param $query
     * @return mixed
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', 1);
    }
}

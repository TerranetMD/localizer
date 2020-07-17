<?php

namespace Terranet\Localizer\Providers;

use Illuminate\Database\Eloquent\Model;
use Terranet\Localizer\Contracts\Provider;

class EloquentProvider implements Provider
{
    private $model;

    /**
     * EloquentProvider constructor.
     *
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Fetch all active languages
     *
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->createModel()
                    ->where('active', '=', 1)
                    ->orderBy('is_default', 'desc')
                    ->orderBy('id', 'asc')
                    ->get(['id', 'iso6391', 'locale', 'title', 'is_default'])
                    ->toArray();
    }

    /**
     * Create a new instance of the model.
     *
     * @return Model
     */
    protected function createModel()
    {
        $class = '\\' . ltrim($this->model, '\\');

        return new $class;
    }
}

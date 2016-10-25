<?php

namespace Terranet\Localizer;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Terranet\Localizer\Console\LanguagesTableCommand;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config' => config_path(),
            __DIR__ . '/../../database/seeds' => base_path('database/seeds')
        ]);

        $this->mergeConfigFrom(__DIR__ . '/../../config/localizer.php', 'localizer');
    }

    public function register()
    {
        if (! defined('_TERRANET_LOCALIZER_')) {
            define('_TERRANET_LOCALIZER_', 1);
        }

        $this->app->singleton('terranet.localizer', function ($app) {
            $localizer = (new Localizer(
                new Resolver($app),
                new Provider($app)
            ));

            if ($locale = $localizer->find()) {
                $localizer->setLocale($locale);
            }

            return $localizer;
        });

        $this->registerCommands();
    }

    protected function registerCommands()
    {
        $this->app->singleton('command.localizer.table', function ($app) {
            return new LanguagesTableCommand($app['files'], $app['composer']);
        });

        $this->commands(['command.localizer.table']);
    }
}

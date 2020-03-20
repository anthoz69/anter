<?php

namespace Anthoz69\Anter;

use Illuminate\Config\Repository as Config;
use Illuminate\Support\ServiceProvider;

class AnterServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/anter.php', 'anter');

        // Register the service the package provides.
        $this->app->singleton('anter', function ($app) {
            return new Anter;
        });

        $this->app->singleton('anter.store', function ($app) {
            return new AnterStore($app['config']->get('anter.store', []));
        });

        $this->app->singleton('anter.img', function ($app) {
            return new AnterImg(new Config($app['config']->get('anter.img', [])));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'anter',
            'anter.store',
            'anter.img',
        ];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/anter.php' => config_path('anter.php'),
        ], 'anter.config');
    }
}

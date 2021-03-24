<?php

namespace Laravelista\Ekko\Frameworks\Laravel;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Config;
use Laravelista\Ekko\Url\LaravelUrlProvider;

class ServiceProvider extends \Illuminate\Support\ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config.php',
            'ekko'
        );

        $this->app->singleton(Ekko::class, function (Application $app) {
            $ekko = new Ekko($app->make('router'));
            $ekko->setUrlProvider(new LaravelUrlProvider($app->make('request')));
            $ekko->setDefaultOutput(Config::get('ekko.default_output'));

            return $ekko;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config.php' => $this->app->configPath('ekko.php'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Ekko::class];
    }
}

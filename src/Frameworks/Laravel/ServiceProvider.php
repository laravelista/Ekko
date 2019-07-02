<?php

namespace Laravelista\Ekko\Frameworks\Laravel;

use Laravelista\Ekko\Url\LaravelUrlProvider;
// use Illuminate\Contracts\Support\DeferrableProvider;

class ServiceProvider extends \Illuminate\Support\ServiceProvider /* implements DeferrableProvider */
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * Laravel 5.8
     * The defer boolean property on the service provider which is/was used to
     * indicate if a provider is deferred has been deprecated in Laravel 5.8.
     * In order to mark the service provider as deferred it should implement
     * the Illuminate\Contracts\Support\DeferrableProvider contract.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config.php', 'ekko'
        );

        $this->app->singleton(Ekko::class, function ($app) {
            $ekko = new Ekko($app['router']);
            $ekko->setUrlProvider(new LaravelUrlProvider($app['request']));
            $ekko->setDefaultOutput(config('ekko.default_output'));

            return $ekko;
        });

        if (config('ekko.global_helpers')) {
            Ekko::enableGlobalHelpers();
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config.php' => config_path('ekko.php'),
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

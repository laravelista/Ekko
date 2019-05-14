<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravelista\Ekko\Frameworks\Laravel\Ekko;
use Laravelista\Ekko\Url\LaravelUrlProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class EkkoServiceProvider extends ServiceProvider implements DeferrableProvider
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
        $this->app->singleton(Ekko::class, function ($app) {
            $ekko = new Ekko($app['router']);
            $ekko->setUrlProvider(new LaravelUrlProvider($app['url']));
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
        //
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

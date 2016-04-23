<?php namespace Laravelista\Ekko;

use Illuminate\Support\ServiceProvider;
use Laravelista\Ekko\Ekko;

class EkkoServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Ekko::class, function ($app) {
            return new Ekko(
                $app['router'],
                $app['url']
            );
        });
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

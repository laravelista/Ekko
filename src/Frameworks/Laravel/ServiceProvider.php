<?php

namespace Laravelista\Ekko\Frameworks\Laravel;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Config;
use Laravelista\Ekko\Url\LaravelUrlProvider;

class ServiceProvider extends \Illuminate\Support\ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            path: __DIR__.'/config.php',
            key: 'ekko'
        );

        $this->app->singleton(
            abstract: Ekko::class,
            concrete: function (Application $app) {
                $ekko = new Ekko($app->make(abstract: 'router'));
                $ekko->setUrlProvider(
                    urlProvider: new LaravelUrlProvider(
                        request: $app->make('request')
                    )
                );
                $ekko->setDefaultOutput(value: Config::get(key: 'ekko.default_output'));

                return $ekko;
            }
        );
    }

    public function boot(): void
    {
        $this->publishes(paths: [
            __DIR__.'/config.php' => $this->app->configPath(path: 'ekko.php'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [Ekko::class];
    }
}

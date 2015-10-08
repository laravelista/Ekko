<?php namespace Laravelista\Ekko;

use Illuminate\Support\ServiceProvider;

class EkkoServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->singleton('ekko', function()
        {
            return new Ekko();
        });
	}
}

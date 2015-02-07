<?php namespace Mrkj\Admininja;

use Illuminate\Support\ServiceProvider;

class AdmininjaServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;
	
	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__ . '/../../config/admininja.php', 'admininja'
		);
	}
	
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../../config/admininja.php' => config_path('admininja.php'),
		]);
	}

}

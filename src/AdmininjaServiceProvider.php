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
			__DIR__ . '/../config/admininja.php', 'admininja'
		);

		$this->app['command.admininja.publish'] = $this->app->share(function($app)
		{
			return new Console\Commands\PublishCommand($app['files'], public_path());
		});

		$this->commands('command.admininja.publish');
	}

	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../config/admininja.php' => config_path('admininja.php'),
		]);
	}

}

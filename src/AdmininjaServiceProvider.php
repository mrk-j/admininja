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

		/**
		 * Register admininja:publish command
		 */
		$this->app['command.admininja.publish'] = $this->app->share(function($app)
		{
			return new Console\Commands\PublishCommand($app['files'], public_path());
		});

		$this->commands('command.admininja.publish');

		/**
		 * Configure admininja routes
		 */
		$routeConfig = ['prefix' => $this->app['config']->get('admininja.uri')];

		$this->app['router']->group($routeConfig, function($router)
		{
			$router->get('/', function()
			{
				return view('admininja::layouts.master');
			});
		});
	}

	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../config/admininja.php' => config_path('admininja.php'),
		]);

		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'admininja');
	}

}

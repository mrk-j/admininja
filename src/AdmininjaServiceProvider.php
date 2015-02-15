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

			$router->get('model/{model}', [
				'uses' => 'Mrkj\Admininja\Http\Controllers\ModelController@index',
				'as' => 'admininja.model.index'
			]);

			$router->get('model/{model}/create', [
				'uses' => 'Mrkj\Admininja\Http\Controllers\ModelController@create',
				'as' => 'admininja.model.create'
			]);

			$router->post('model/{model}', [
				'uses' => 'Mrkj\Admininja\Http\Controllers\ModelController@store',
				'as' => 'admininja.model.store'
			]);

			$router->get('model/{model}/{id}/edit', [
				'uses' => 'Mrkj\Admininja\Http\Controllers\ModelController@edit',
				'as' => 'admininja.model.edit'
			]);

			$router->put('model/{model}/{id}', [
				'uses' => 'Mrkj\Admininja\Http\Controllers\ModelController@update',
				'as' => 'admininja.model.update'
			]);

			$router->delete('model/{model}/{id}', [
				'uses' => 'Mrkj\Admininja\Http\Controllers\ModelController@destroy',
				'as' => 'admininja.model.destroy'
			]);
		});

		$this->app['admininja'] = function()
		{
			return new Admininja;
		};
	}

	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../config/admininja.php' => config_path('admininja.php'),
		]);

		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'admininja');

		$this->app['view']->composer('*', 'Mrkj\Admininja\Composers\MenuComposer');
	}

}

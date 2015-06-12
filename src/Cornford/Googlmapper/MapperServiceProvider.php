<?php namespace Cornford\Googlmapper;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class MapperServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$configPath = __DIR__ . '/../../config/config.php';
		$this->publishes([$configPath => config_path('googlmapper.php')], 'googlmapper');

		$viewPath = __DIR__ . '/../../views';
		$this->loadViewsFrom($viewPath, 'googlmapper');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$configPath = __DIR__ . '/../../config/config.php';
		$this->mergeConfigFrom($configPath, 'googlmapper');

		$this->app['mapper'] = $this->app->share(function($app)
		{
			return new Mapper(
				$this->app->view,
				$app['config']->get('googlmapper')
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
		return array('mapper');
	}

}

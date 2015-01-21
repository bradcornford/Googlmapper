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
		$this->package('cornford/googlmapper');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['mapper'] = $this->app->share(function($app)
		{
			$config = $app['config']->get('googlmapper::config');

			return new Mapper(
				$this->app->view,
				$config
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

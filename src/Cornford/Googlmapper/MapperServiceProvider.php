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
		$this->loadViewsFrom(base_path('resources/views/cornford/googlmapper'), 'googlmapper');

		$this->publishes(
			[
				__DIR__ . '/../../config/config.php' => config_path('googlmapper.php'),
				__DIR__ . '/../../views' => base_path('resources/views/cornford/googlmapper')
			],
			'googlmapper'
		);
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

        $this->app->singleton(
            'mapper',
            function($app)
            {
                return new Mapper($this->app->view, $app['config']->get('googlmapper'));
            }
        );
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

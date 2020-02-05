<?php

namespace Cornford\Googlmapper;

use Illuminate\Support\ServiceProvider;

class MapperServiceProvider extends ServiceProvider
{
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
                __DIR__ . '/../config/config.php' => config_path('googlmapper.php'),
                __DIR__ . '/../resources/views' => base_path('resources/views/cornford/googlmapper')
            ],
            'googlmapper'
        );

        $this->app->alias(Mapper::class, 'mapper');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/config.php';
        $this->mergeConfigFrom($configPath, 'googlmapper');

        $this->app->singleton(
            Mapper::class,
            function ($app) {
                return new Mapper($app->view, $app['config']->get('googlmapper'));
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
        return ['mapper', Mapper::class];
    }
}

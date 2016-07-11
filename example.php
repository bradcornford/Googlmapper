<?php

require_once __DIR__ . "/vendor/autoload.php";

use Cornford\Googlmapper\Mapper;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Factory;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\FileViewFinder;

/**
 * Env function.
 *
 * @param string $key
 * @param string $value
 *
 * @return string
 */
function env($key, $value)
{
    return $value;
}

$fileViewFinder = new FileViewFinder(new Filesystem,  [__DIR__ . '/src/views']);
$fileViewFinder->addNamespace('googlmapper', [__DIR__ . '/src/views']);

$engineResolver = new EngineResolver();
$engineResolver->register(
    'blade',
    function () {
        return new CompilerEngine(new BladeCompiler(new Filesystem(), sys_get_temp_dir()));
    }
);

$viewFactory = new Factory($engineResolver, $fileViewFinder, new Dispatcher(new Container));

$config = include_once __DIR__ . '/src/config/config.php';

$mapper = new Mapper($viewFactory, $config);

// Location
$mapper->location('Sheffield')->streetview(1, 1, ['ui' => false]);

// Map
$mapper->map(53.3, -1.4, ['zoom' => 10, 'center' => false, 'markers' => ['title' => 'My Location', 'animation' => 'DROP']]);

// Information window
$mapper->informationWindow(53.4, -1.5, 'Content');
$mapper->informationWindow(52.4, -1.0, 'Content');
$mapper->informationWindow(51.4, -0.5, 'Content');

// Render
print $mapper->render();
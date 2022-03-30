<?php

require_once __DIR__ . "/vendor/autoload.php";

use FifyIO\Googlmapper\Mapper;
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

$fileViewFinder = new FileViewFinder(new Filesystem,  [__DIR__ . '/resources/views']);
$fileViewFinder->addNamespace('googlmapper', [__DIR__ . '/resources/views']);

$engineResolver = new EngineResolver();
$engineResolver->register(
    'blade',
    function () {
        return new CompilerEngine(new BladeCompiler(new Filesystem(), sys_get_temp_dir()));
    }
);

$viewFactory = new Factory($engineResolver, $fileViewFinder, new Dispatcher(new Container));

$config = include_once __DIR__ . '/config/config.php';

$mapper = new Mapper($viewFactory, $config);

// Location
$mapper->location('Sheffield')->streetview(1, 1, ['ui' => false]);

// Map
$mapper->map(53.3, -1.4, ['zoom' => 10, 'center' => false, 'markers' => ['title' => 'My Location', 'animation' => 'DROP', 'label' => 'A']]);

// Information window.
$mapper->informationWindow(53.4, -1.5, 'Content');
$mapper->informationWindow(52.4, -1.0, 'Content');
$mapper->informationWindow(51.4, -0.5, 'Content');

// Marker
$mapper->marker(53.39, -1.48, ['icon' => 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=|2b81c6|000000', 'label' => '']);
$mapper->marker(50.5, 0.5, ['icon' => ['symbol' => 'CIRCLE', 'scale' => 10], 'animation' => 'DROP', 'label' => 'Marker', 'title' => 'Marker']);
$mapper->marker(49.5, 1.5, [
    'title'     => 'title',
    'icon'      => [
        'path'         => 'M10.5,0C4.7,0,0,4.7,0,10.5c0,10.2,9.8,19,10.2,19.4c0.1,0.1,0.2,0.1,0.3,0.1s0.2,0,0.3-0.1C11.2,29.5,21,20.7,21,10.5 C21,4.7,16.3,0,10.5,0z M10.5,5c3,0,5.5,2.5,5.5,5.5S13.5,16,10.5,16S5,13.5,5,10.5S7.5,5,10.5,5z',
        'fillColor'    => '#7c2a27',
        'fillOpacity'  => 1,
        'strokeWeight' => 0,
        'anchor'       => [0, 0],
        'origin'       => [0, 0],
        'size'         => [21, 30]
    ],
    'label'     => [
        'text' => 'Label',
        'color' => 'blue',
        'fontFamily' => 'Arial',
        'fontSize' => '15px',
        'fontWeight' => 'bold',
    ],
    'autoClose' => true,
    'clickable' => false,
    'cursor' => 'default',
    'opacity' => 0.5,
    'visible' => true,
    'zIndex' => 1000,
]);

// Render
print $mapper->render();

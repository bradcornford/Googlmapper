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

$config = include_once __DIR__ . '/src/config/dev/config.php';

$mapper = new Mapper($viewFactory, $config);

class test {
    public $name;
}

// Location
//$mapper->location('Sheffield')->streetview(1, 1, ['ui' => false]);

print '<html><head>';
print '<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
print '<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>';
print '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>';
print '</head><body>';

// Map
$mapper->map(53.3, -1.4, ['cluster' => false, 'zoom' => 10, 'center' => false, 'eventAfterLoad' => 'addMapCntrol(maps[0].map); console.log(1); google.maps.event.trigger(maps[0].markers[1], "click"); console.log(1);', 'markers' => ['icon' => 'https://lh4.ggpht.com/Tr5sntMif9qOPrKV_UVl7K8A_V3xQDgA7Sw_qweLUFlg76d_vGFA7q1xIKZ6IcmeGqg=w50', 'title' => 'My Location', 'animation' => 'DROP', 'autoClose' => true]]);

$test = new test();
$test->name = 'content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content content ';

// Information window
$mapper->informationWindow(53.4, -1.5, 'Content 1', ['maxWidth' => 653, 'icon' => '']);
$mapper->informationWindow(52.4, -1.0, 'Content 2');
$mapper->informationWindow(51.4, -0.5, 'Content 3');


$mapper->streetview(53.3771, -1.4688, 0, 0);



// Render
//print '<div>
//
//  <!-- Nav tabs -->
//  <ul class="nav nav-tabs" role="tablist">
//    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
//    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
//  </ul>
//
//  <!-- Tab panes -->
//  <div class="tab-content">
//    <div role="tabpanel" class="tab-pane active" id="home">';



//    print '</div>
//    <div role="tabpanel" class="tab-pane" id="profile">';

print $mapper->render();

print "

<script>
      
    function addMapCntrol(map) {
        var centerControlDiv = document.createElement('div');
        
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.border = '2px solid #fff';
        controlUI.style.borderRadius = '3px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginBottom = '22px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Click to recenter the map';
        centerControlDiv.appendChild(controlUI);
        
        var controlText = document.createElement('div');
        controlText.style.color = 'rgb(25,25,25)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '16px';
        controlText.style.lineHeight = '38px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = 'Center Map';
        controlUI.appendChild(controlText);
        
        controlUI.addEventListener('click', function() {
            map.setCenter({lat: 41.85, lng: -87.65});
        });
        
        centerControlDiv.index = 1;
        
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv)
    }
      
</script>
";

//print '</div>
//  </div>
//
//</div>';
//
//print '
//<script type="text/javascript">
//$(\'a[href="#profile"]\').on(\'shown.bs.tab\', function(e)
//    {
//        google.maps.event.trigger(maps[0].map, \'resize\');
//    });
//</script>
//';


//print '</body>';
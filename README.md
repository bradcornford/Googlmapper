# An easy way to integrate Google Maps with Laravel

[![Latest Stable Version](https://poser.pugx.org/cornford/Googlmapper/version.png)](https://packagist.org/packages/cornford/googlmapper)
[![Total Downloads](https://poser.pugx.org/cornford/googlmapper/d/total.png)](https://packagist.org/packages/cornford/googlmapper)
[![Build Status](https://travis-ci.org/bradcornford/Googlmapper.svg?branch=master)](https://travis-ci.org/bradcornford/Googlmapper)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bradcornford/Googlmapper/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bradcornford/Googlmapper/?branch=master)

### For Laravel 4.x, check [version 1.0.1](https://github.com/bradcornford/Googlmapper/tree/v1.0.1)

Think of Googlmapper as an easy way to integrate Google Maps with Laravel, providing a variety of helpers to speed up the utilisation of mapping. These include:

- `Mapper::map`
- `Mapper::location`
- `Mapper::streetview`
- `Mapper::marker`
- `Mapper::informationWindow`
- `Mapper::polyline`
- `Mapper::polygon`
- `Mapper::rectangle`
- `Mapper::circle`
- `Mapper::render`

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `cornford/googlmapper`.

	"require": {
		"cornford/googlmapper": "2.*"
	}

Next, update Composer from the Terminal:

	composer update

Once this operation completes, the next step is to add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

	Cornford\Googlmapper\MapperServiceProvider::class,

The next step is to introduce the facade. Open `app/config/app.php`, and add a new item to the aliases array.

	'Mapper'         => Cornford\Googlmapper\Facades\MapperFacade::class,

Finally we need to introduce the configuration files into your application.

	php artisan vendor:publish --provider="Cornford\Googlmapper\MapperServiceProvider" --tag=googlmapper

You also need to set your Google API Key into the `GOOGLE_API_KEY` environment variable. To obtain an API key for your project, visit the [Google developers console](https://console.developers.google.com/).

That's it! You're all set to go.

## Configuration

You can now configure Googlmapper in a few simple steps. Open `app/config/packages/cornford/googlmapper/config.php` and update the options as needed.

- `enabled` - Enable Google Maps.
- `key` - A Google Maps API key.
- `region` - A region Google Maps should utilise, required in ISO 3166-1 code format, e.g. GB.
- `language` - A language Google Maps should utilise, required in ISO 639-1 code format, e.g. en-gb.
- `async` - Perform the loading and rendering of Googlmapper map asynchronously, e.g. false.
- `user` - Use custom Google Maps for users logged into the Google service, e.g. false.
- `marker` - Automatically add Google Maps marker for your maps initial location, e.g. true.
- `center` - Automatically center Google Maps around the initial location, when false, Google Maps will automatically center the map, e.g. true.
- `locate` - Automatically center Google Maps around the users current location, when false, Google Maps will automatically center the map, e.g. true.
- `zoom` - Set the default zoom level for Google Maps, e.g. 8.
- `scrollWheelZoom` - Set the default scroll wheel zoom Google Maps, e.g. true.
- `zoomControl` - Set the default zoom control for Google Maps, e.g. true.
- `mapTypeControl` - Set the default map type control for Google Maps, e.g. true.
- `scaleControl` - Set the default scale control for Google Maps, e.g. true.
- `streetViewControl` - Set the default street view control for Google Maps, e.g. true.
- `rotateControl` - Set the default rotate control for Google Maps, e.g. true.
- `fullscreenControl` - Set the default fullscreen control for Google Maps, e.g. true.
- `type` - Set the default map type for Google Maps, e.g. ROADMAP, SATELLITE, HYBRID, TERRAIN.
- `ui` - Show the Google Maps default UI options, e.g. true.
- `markers.icon` - Set the default marker icon, e.g. img/icon.png.
- `markers.animation` - Set the default marker animation, e.g. NONE, DROP, BOUNCE.
- `markers.autoclose` - Automatically close Information Windows of current marker when other markers are clicked, e.g. true.
- `cluster` - Set if map marker clusters should be used.
- `clusters.icon` - Display custom images for clusters using icon path.
- `clusters.grid` - The grid size of a cluster in pixels.
- `clusters.zoom` - The maximum zoom level that a marker can be part of a cluster.
- `clusters.center` - Whether the center of each cluster should be the average of all markers in the cluster.
- `clusters.size` - The minimum number of markers to be in a cluster before the markers are hidden and a count is shown.

## Usage

It's really as simple as using the Mapper class in any Controller / Model / File you see fit with:

`Mapper::`

This will give you access to

- [Map](#map)
- [Location](#location)
- [Streetview](#streetview)
- [Marker](#marker)
- [Information Window](#information-window)
- [Polyline](#polyline)
- [Polygon](#polygon)
- [Rectangle](#rectangle)
- [Circle](#circle)
- [Render](#render)
- [RenderJavascript](#renderJavascript)

### Example

Initialize the map in your controller `MapController.php`:

    use Mapper;

	public function index()
	{
	    Mapper::map(53.381128999999990000, -1.470085000000040000);

	    return view('map')
	}

Within in the view `map.blade.php` add following code to render the map:

	<div style="width: 500px; height: 500px;">
		{!! Mapper::render() !!}
	</div>

### Map

The `map` method allows a map to be created, with latitude, longitude and optional parameters for options.

	Mapper::map(53.381128999999990000, -1.470085000000040000);
	Mapper::map(53.381128999999990000, -1.470085000000040000, ['zoom' => 15, 'center' => false, 'marker' => false, 'type' => 'HYBRID', 'overlay' => 'TRAFFIC']);
	Mapper::map(53.381128999999990000, -1.470085000000040000, ['zoom' => 10, 'markers' => ['title' => 'My Location', 'animation' => 'DROP']]);
	Mapper::map(53.381128999999990000, -1.470085000000040000, ['zoom' => 10, 'markers' => ['title' => 'My Location', 'animation' => 'DROP'], 'cluster' => false]);
	Mapper::map(53.381128999999990000, -1.470085000000040000, ['zoom' => 10, 'markers' => ['title' => 'My Location', 'animation' => 'DROP'], 'clusters' => ['size' => 10, 'center' => true, 'zoom' => 20]]);

##### Map Events

**Before Load**

This event is fired before the map is loaded.

	Mapper::map(53.381128999999990000, -1.470085000000040000, ['eventBeforeLoad' => 'console.log("before load");']);

**After Load**

This event is fired after the map is loaded.

	Mapper::map(53.381128999999990000, -1.470085000000040000, ['eventAfterLoad' => 'console.log("after load");']);

### Location

The `location` method allows a location to be searched for with a string, returning a Location object with its latitude and longitude.

	Mapper::location('Sheffield');
	Mapper::location('Sheffield')->map(['zoom' => 15, 'center' => false, 'marker' => false, 'type' => 'HYBRID', 'overlay' => 'TRAFFIC']);
	Mapper::location('Sheffield')->streetview(1, 1, ['ui' => false]);

### Streetview

The `streetview` method allows a streetview map to be created, with latitude, longitude, heading, pitch and optional parameters for options.

	Mapper::streetview(53.381128999999990000, -1.470085000000040000, 1, 1);
	Mapper::streetview(53.381128999999990000, -1.470085000000040000, 1, 1, ['ui' => false]);

### Marker

The `marker` method allows a marker to be added to a map, with latitude, longitude, and optional parameters for options.

	Mapper::marker(53.381128999999990000, -1.470085000000040000);
	Mapper::marker(53.381128999999990000, -1.470085000000040000, ['symbol' => 'circle', 'scale' => 1000]);
	Mapper::map(52.381128999999990000, 0.470085000000040000)->marker(53.381128999999990000, -1.470085000000040000, ['markers' => ['symbol' => 'circle', 'scale' => 1000, 'animation' => 'DROP']]);

#### Draggable Markers

If you need draggable marker, you can add option draggable. 

	Mapper::marker(53.381128999999990000, -1.470085000000040000, ['draggable' => true]);

##### Draggable Events

**Click**

This event is fired when the marker icon was clicked.

	Mapper::marker(53.381128999999990000, -1.470085000000040000, ['draggable' => true, 'eventClick' => 'console.log("left click");']);

**Double Click**

This event is fired when the marker icon was double clicked.

	Mapper::marker(53.381128999999990000, -1.470085000000040000, ['draggable' => true, 'eventDblClick' => 'console.log("double left click");']);

**Right Click**

This event is fired for a right click on the marker.

	Mapper::marker(53.381128999999990000, -1.470085000000040000, ['draggable' => true, 'eventRightClick' => 'console.log("right click");']);

**Mouse Over**

This event is fired when the mouse enters the area of the marker icon.

 	Mapper::marker(53.381128999999990000, -1.470085000000040000, ['draggable' => true, 'eventMouseOver' => 'console.log("mouse over");']);

**Mouse Down**

This event is fired for a mouse down on the marker.

	Mapper::marker(53.381128999999990000, -1.470085000000040000, ['draggable' => true, 'eventMouseDown' => 'console.log("mouse down");']);

**Mouse Up**

This event is fired for a mouse up on the marker.

	Mapper::marker(53.381128999999990000, -1.470085000000040000, ['draggable' => true, 'eventMouseUp' => 'console.log("mouse up");']);

**Mouse Out**

This event is fired when the mouse leaves the area of the marker icon.

	Mapper::marker(53.381128999999990000, -1.470085000000040000, ['draggable' => true, 'eventMouseOut' => 'console.log("mouse out");']);

**Drag**

This event is repeatedly fired while the user drags the marker.

	Mapper::marker(53.381128999999990000, -1.470085000000040000, ['draggable' => true, 'eventDrag' => 'console.log("dragging");']);

**Drag Start**

This event is fired when the user starts dragging the marker.

	Mapper::marker(53.381128999999990000, -1.470085000000040000, ['draggable' => true, 'eventDragStart' => 'console.log("drag start");']);

**Drag End**

This event is fired when the user stops dragging the marker.

	Mapper::marker(53.381128999999990000, -1.470085000000040000, ['draggable' => true, 'eventDragEnd' => 'console.log("drag end");']);

### Information Window

The `informationWindow` method allows an information window to be added to to a map, with latitude, longitude, content, and optional parameters for options.

	Mapper::informationWindow(53.381128999999990000, -1.470085000000040000, 'Content');
	Mapper::informationWindow(53.381128999999990000, -1.470085000000040000, 'Content', ['open' => true, 'maxWidth'=> 300, markers' => ['title' => 'Title']]);
	Mapper::map(52.381128999999990000, 0.470085000000040000)->informationWindow(53.381128999999990000, -1.470085000000040000, 'Content', ['markers' => ['animation' => 'DROP']]);

### Polyline

The `polyline` method allows a polyline to be added to a map, with coordinates, and optional parameters for options.

	Mapper::polyline([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]]);
	Mapper::polyline([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]], ['editable' => 'true']);
	Mapper::map(52.381128999999990000, 0.470085000000040000)->polyline([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]], ['strokeColor' => '#000000', 'strokeOpacity' => 0.1, 'strokeWeight' => 2]);

### Polygon

The `polygon` method allows a polygon to be added to a map, with coordinates, and optional parameters for options.

	Mapper::polygon([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]]);
	Mapper::polygon([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]], ['editable' => 'true']);
	Mapper::map(52.381128999999990000, 0.470085000000040000)->polygon([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]], ['strokeColor' => '#000000', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FFFFFF']);

### Rectangle

The `rectangle` method allows a rectangle to be added to a map, with coordinates, and optional parameters for options.

	Mapper::rectangle([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]]);
	Mapper::rectangle([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]], ['editable' => 'true']);
	Mapper::map(52.381128999999990000, 0.470085000000040000)->rectangle([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000], ['latitude' => 52.381128999999990000, 'longitude' => 0.470085000000040000]], ['strokeColor' => '#000000', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FFFFFF']);

### Circle

The `circle` method allows a circle to be added to a map, with coordinates, and optional parameters for options.

	Mapper::circle([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000]]);
	Mapper::circle([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000]], ['editable' => 'true']);
	Mapper::map(52.381128999999990000, 0.470085000000040000)->circle([['latitude' => 53.381128999999990000, 'longitude' => -1.470085000000040000]], ['strokeColor' => '#000000', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FFFFFF', 'radius' => 1000]);

### Render

The `render` method allows all maps to be rendered to the page, this method can be included in Views or added as controller passed parameter, and optional parameter for item.

	Mapper::render();
	Mapper::render(0);

### RenderJavascript

The `renderJavascript` method allows all required javascript to be rendered to the page, this method can be included in Views or added as controller passed parameter.

    Mapper::renderJavascript();

### License

Googlmapper is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

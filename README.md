# An easy way to integrate Google Maps with Laravel

[![Latest Stable Version](https://poser.pugx.org/cornford/Googlmapper/version.png)](https://packagist.org/packages/cornford/googlmapper)
[![Total Downloads](https://poser.pugx.org/cornford/googlmapper/d/total.png)](https://packagist.org/packages/cornford/googlmapper)
[![Build Status](https://travis-ci.org/bradcornford/Googlmapper.svg?branch=master)](https://travis-ci.org/bradcornford/Googlmapper)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bradcornford/Googlmapper/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bradcornford/Googlmapper/?branch=master)

### For Laravel 4.x, check [version 1.0.1](https://github.com/bradcornford/Googlmapper/tree/v1.0.1)

Think of Googlmapper as an easy way to integrate Google Maps with Laravel, providing a variety of helpers to speed up the utilisation of mapping. These include:

- `Mapper::map`
- `Mapper::stretview`
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

	'Cornford\Googlmapper\MapperServiceProvider',

The next step is to introduce the facade. Open `app/config/app.php`, and add a new item to the aliases array.

	'Mapper'         => 'Cornford\Googlmapper\Facades\MapperFacade',

Finally we need to introduce the configuration files into your application.

	php artisan vendor:publish --provider="Cornford\\Googlmapper\\MapperServiceProvider"

You also need to set your Google API Key into the `GOOGLE_API_KEY` environment variable. To obtain an API key for your project, visit the [Google developers console](https://console.developers.google.com/).

That's it! You're all set to go.

## Configuration

You can now configure Googlmapper in a few simple steps. Open `app/config/packages/cornford/googlmapper/config.php` and update the options as needed.

- `enabled` - Enable Google Maps.
- `key` - A Google Maps API key.
- `region` - A region Google Maps should utilise, required in ISO 3166-1 code format, e.g. GB.
- `language` - A language Google Maps should utilise, required in ISO 639-1 code format, e.g. en-gb.
- `user` - Use custom Google Maps for users logged into the Google service, e.g. false.
- `marker` - Automatically add Google Maps marker for your maps initial location, e.g. true.
- `center` - Automatically center Google Maps around the initial location, when false, Google Maps will automatically center the map, e.g. true.
- `zoom` - Set the default zoom level for Google Maps, e.g. 8.
- `type` - Set the default map type for Google Maps, e.g. ROADMAP, SATELLITE, HYBRID, TERRAIN.
- `ui` - Show the Google Maps default UI options, e.g. true.
- `markers.icon` - Set the default marker icon, e.g. img/icon.png.
- `markers.animation` - Set the default marker animation, e.g. NONE, DROP, BOUNCE.

## Usage

It's really as simple as using the Mapper class in any Controller / Model / File you see fit with:

`Mapper::`

This will give you access to

- [Map](#map)
- [Streetview](#streetview)
- [Marker](#marker)
- [Information Window](#information-window)
- [Polyline](#polyline)
- [Polygon](#polygon)
- [Rectangle](#rectangle)
- [Circle](#circle)
- [Render](#render)

### Map

The `map` method allows a map to be created, with latitude, longitude and optional parameters for options.

	Mapper::map(53.381128999999990000, -1.470085000000040000);
	Mapper::map(53.381128999999990000, -1.470085000000040000, ['zoom' => 15, 'center' => false, 'marker' => false, 'type' => 'HYBRID', 'overlay' => 'TRAFFIC']);
	Mapper::map(53.381128999999990000, -1.470085000000040000, ['zoom' => 10, 'markers' => ['title' => 'My Location', 'Animation' => 'DROP']]);

### Streetview

The `streetview` method allows a streetview map to be created, with latitude, longitude, heading, pitch and optional parameters for options.

	Mapper::streetview(53.381128999999990000, -1.470085000000040000);
	Mapper::streetview(53.381128999999990000, -1.470085000000040000, ['ui' => false]);

### Marker

The `marker` method allows a marker to be added to a map, with latitude, longitude, and optional parameters for options.

	Mapper::marker(53.381128999999990000, -1.470085000000040000);
	Mapper::marker(53.381128999999990000, -1.470085000000040000, ['symbol' => 'circle', 'scale' => 1000]);
	Mapper::map(52.381128999999990000, 0.470085000000040000)->marker(53.381128999999990000, -1.470085000000040000, ['markers' => ['symbol' => 'circle', 'scale' => 1000, 'animation' => 'DROP']]);

### Information Window

The `informationWindow` method allows an information window to be added to to a map, with latitude, longitude, content, and optional parameters for options.

	Mapper::informationWindow(53.381128999999990000, -1.470085000000040000, 'Content');
	Mapper::informationWindow(53.381128999999990000, -1.470085000000040000, 'Content', ['markers' => ['title' => 'Title']]);
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

### License

Googlmapper is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

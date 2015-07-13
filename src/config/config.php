<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Enable Mapping
    |--------------------------------------------------------------------------
    |
    | Enable Google mapping.
    |
    */
    'enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Google API Key
    |--------------------------------------------------------------------------
    |
    | A Google API key to link Googlmapper to Google's API.
    |
    */
    'key' => env('GOOGLE_API_KEY', 'AIzaSyAtqWsq5Ai3GYv6dSa6311tZiYKlbYT4mw'),

    /*
    |--------------------------------------------------------------------------
    | Region
    |--------------------------------------------------------------------------
    |
    | The region Google API should use required in ISO 3166-1 code format.
    |
    */
    'region' => 'GB',

    /*
    |--------------------------------------------------------------------------
    | Language
    |--------------------------------------------------------------------------
    |
    | The Language Google API should use required in ISO 639-1 code format.
    |
    */
    'language' => 'en-gb',

    /*
    |--------------------------------------------------------------------------
    | User Custom Maps
    |--------------------------------------------------------------------------
    |
    | Automatically add the logged in Google user to Googlmapper displayed map.
    |
    */
    'user' => false,

    /*
    |--------------------------------------------------------------------------
    | Location Marker
    |--------------------------------------------------------------------------
    |
    | Automatically add a location marker to the provided location for a
    | Googlmapper displayed map.
    |
    */
    'marker' => true,

    /*
    |--------------------------------------------------------------------------
    | Center Map
    |--------------------------------------------------------------------------
    |
    | Automatically center the Googlmapper displayed map on the provided
    | location.
    |
    */
    'center' => true,

    /*
    |--------------------------------------------------------------------------
    | Default Zoom
    |--------------------------------------------------------------------------
    |
    | The default zoom level Googlmapper should use.
    |
    */
    'zoom' => 8,

    /*
    |--------------------------------------------------------------------------
    | Map Type
    |--------------------------------------------------------------------------
    |
    | Set the default Googlmapper displayed map type. (ROADMAP|SATELLITE|HYBRID|TERRAIN)
    |
    */
    'type' => 'ROADMAP',

    /*
    |--------------------------------------------------------------------------
    | Map UI
    |--------------------------------------------------------------------------
    |
    | Should the default Googlmapper displayed map UI be shown.
    |
    */
    'ui' => true,

    /*
    |--------------------------------------------------------------------------
    | Map Marker
    |--------------------------------------------------------------------------
    |
    | Set the default Googlmapper map marker behaviour.
    |
    */
    'markers' => array(

        /*
        |--------------------------------------------------------------------------
        | Marker Icon
        |--------------------------------------------------------------------------
        |
        | Display a custom icon for markers. (Link to an image)
        |
        */
        'icon' => '',

        /*
        |--------------------------------------------------------------------------
        | Marker Animation
        |--------------------------------------------------------------------------
        |
        | Display an animation effect for markers. (NONE|DROP|BOUNCE)
        |
        */
        'animation' => 'NONE',

    ),

    /*
    |--------------------------------------------------------------------------
    | Map Marker Cluster
    |--------------------------------------------------------------------------
    |
    | Enable default Googlmapper map marker cluster.
    |
    */
    'cluster' => true,

);

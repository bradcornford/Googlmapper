<?php

namespace FifyIO\Googlmapper;

use FifyIO\Googlmapper\Contracts\MappingBaseInterface;
use FifyIO\Googlmapper\Exceptions\MapperArgumentException;
use FifyIO\Googlmapper\Traits\Languages;
use FifyIO\Googlmapper\Traits\Regions;
use Illuminate\View\Factory as View;

abstract class MapperBase implements MappingBaseInterface
{
    use Regions;
    use Languages;

    private const ENABLED = true;

    private const REGION = 'GB';

    private const LANGUAGE = 'en-gb';

    private const TYPE_ROADMAP = 'ROADMAP';
    private const TYPE_SATELLITE = 'SATELLITE';
    private const TYPE_HYBRID = 'HYBRID';
    private const TYPE_TERRAIN = 'TERRAIN';

    private const ASYNC = false;

    private const MARKER = true;

    private const CENTER = true;

    private const LOCATE = false;

    private const ZOOM = 8;
    private const SCROLL_WHEEL_ZOOM = true;

    private const CONTROL_ZOOM = true;
    private const CONTROL_MAP_TYPE = true;
    private const CONTROL_SCALE = false;
    private const CONTROL_STREET_VIEW = true;
    private const CONTROL_ROTATE = false;
    private const CONTROL_FULLSCREEN = true;

    private const HEADING = 0;

    private const TILT = 0;

    private const UI = true;

    private const ANIMATION_NONE = 'NONE';
    private const ANIMATION_DROP = 'DROP';
    private const ANIMATION_BOUNCE = 'BOUNCE';

    private const GESTURE_HANDLING_AUTO = 'auto';
    private const GESTURE_HANDLING_NONE = 'none';
    private const GESTURE_HANDLING_GREEDY = 'greedy';
    private const GESTURE_HANDLING_COOPERATIVE = 'cooperative';

    private const OVERLAY_NONE = 'NONE';
    private const OVERLAY_BIKE = 'BIKE';
    private const OVERLAY_TRANSIT = 'TRANSIT';
    private const OVERLAY_TRAFFIC = 'TRAFFIC';

    private const SYMBOL_CIRCLE = 'CIRCLE';
    private const SYMBOL_BACKWARD_CLOSED_ARROW = 'BACKWARD_CLOSED_ARROW';
    private const SYMBOL_FORWARD_CLOSED_ARROW = 'FORWARD_CLOSED_ARROW';
    private const SYMBOL_BACKWARD_OPEN_ARROW = 'BACKWARD_OPEN_ARROW';
    private const SYMBOL_FORWARD_OPEN_ARROW = 'FORWARD_OPEN_ARROW';

    private const ICON = '';

    private const CLUSTER = true;

    private const CLUSTERS_ICON = '//googlemaps.github.io/js-marker-clusterer/images/m';
    private const CLUSTERS_GRID = 60;
    private const CLUSTERS_ZOOM = null;
    private const CLUSTERS_CENTER = false;
    private const CLUSTERS_SIZE = 2;

    /**
     * View.
     *
     * @var \Illuminate\View\Factory
     */
    protected $view;

    /**
     * Mapping enabled.
     *
     * @var boolean
     */
    protected $enabled;

    /**
     * API Key.
     *
     * @var string
     */
    protected $key;

    /**
     * API Version.
     *
     * @var float|string
     */
    protected $version;

    /**
     * API region.
     *
     * @var string
     */
    protected $region;

    /**
     * API Language.
     *
     * @var string
     */
    protected $language;

    /**
     * Async maps.
     *
     * @var boolean
     */
    protected $async;

    /**
     * Automatic map marker.
     *
     * @var boolean
     */
    protected $marker;

    /**
     * Center map automatically.
     *
     * @var boolean
     */
    protected $center;

    /**
     * Locate users location.
     *
     * @var boolean
     */
    protected $locate;

    /**
     * Show map UI.
     *
     * @var boolean
     */
    protected $ui;

    /**
     * Map zoom level.
     *
     * @var int
     */
    protected $zoom;

    /**
     * Map scroll wheel zoom.
     *
     * @var boolean
     */
    protected $scrollWheelZoom;

    /**
     * Map zoom control.
     *
     * @var boolean
     */
    protected $zoomControl;

    /**
     * Map type control.
     *
     * @var boolean
     */
    protected $mapTypeControl;

    /**
     * Map scale control.
     *
     * @var boolean
     */
    protected $scaleControl;

    /**
     * Map street view control.
     *
     * @var boolean
     */
    protected $streetViewControl;

    /**
     * Map rotate control.
     *
     * @var boolean
     */
    protected $rotateControl;

    /**
     * Map fullscreen control.
     *
     * @var boolean
     */
    protected $fullscreenControl;

    /**
     * Map type.
     *
     * @var string
     */
    protected $type;

    /**
     * Available map types.
     *
     * @var array
     */
    protected $types = [
        'ROADMAP',
        'SATELLITE',
        'HYBRID',
        'TERRAIN'
    ];

    /**
     * Map heading.
     *
     * @var int
     */
    protected $heading;

    /**
     * Map tilt.
     *
     * @var int
     */
    protected $tilt;

    /**
     * Map marker icon.
     *
     * @var string
     */
    protected $icon;

    /**
     * Map marker animation.
     *
     * @var string
     */
    protected $animation;

    /**
     * Available map marker animations.
     *
     * @var array
     */
    protected $animations = [
        'NONE',
        'DROP',
        'BOUNCE',
    ];

    /**
     * Gesture handling.
     *
     * @var string
     */
    protected $gestureHandling;

    /**
     * Available map gesture handlers.
     *
     * @var array
     */
    protected $gestureHandlers = [
        'auto',
        'none',
        'greedy',
        'cooperative',
    ];

    /**
     * Map marker cluster.
     *
     * @var boolean
     */
    protected $cluster;

    /**
     * Map marker clusters icon.
     *
     * @var string
     */
    protected $clustersIcon;

    /**
     * Map marker clusters grid.
     *
     * @var int
     */
    protected $clustersGrid;

    /**
     * Map marker clusters zoom.
     *
     * @var int|null
     */
    protected $clustersZoom;

    /**
     * Map marker clusters center.
     *
     * @var boolean
     */
    protected $clustersCenter;

    /**
     * Map marker clusters size.
     *
     * @var int
     */
    protected $clustersSize;

    /**
     * Mapping items.
     *
     * @var array
     */
    public $items = [];

    /**
     * Construct Googlmapper.
     *
     * @param View  $view
     * @param array $options
     *
     * @throws MapperArgumentException
     */
    public function __construct(View $view, array $options = [])
    {
        $this->view = $view;

        if (!isset($options['key'])) {
            throw new MapperArgumentException('Google maps API key is required.');
        }

        if (!isset($options['version'])) {
            throw new MapperArgumentException('Google maps API version is required.');
        }

        if (!isset($options['region'])) {
            throw new MapperArgumentException('Region is required.');
        }

        if (!in_array($options['region'], $this->regions)) {
            throw new MapperArgumentException('Region is required in ISO 3166-1 code format.');
        }

        if (!isset($options['language']) || !in_array($options['language'], $this->languages)) {
            throw new MapperArgumentException('Language is required.');
        }

        if (!in_array($options['language'], $this->languages)) {
            throw new MapperArgumentException('Language is required in ISO 639-1 code format.');
        }

        $this->setEnabled($options['enabled'] ?? self::ENABLED);
        $this->setKey($options['key']);
        $this->setVersion($options['version']);
        $this->setRegion($options['region'] ?? self::REGION);
        $this->setLanguage($options['language'] ?? self::LANGUAGE);
        $this->setAsync($options['async'] ?? self::ASYNC);
        $this->setMarker($options['marker'] ?? self::MARKER);
        $this->setCenter($options['center'] ?? self::CENTER);
        $this->setLocate($options['locate'] ?? self::LOCATE);
        $this->setZoom($options['zoom'] ?? self::ZOOM);
        $this->setScrollWheelZoom($options['scrollWheelZoom'] ?? self::SCROLL_WHEEL_ZOOM);
        $this->setZoomControl($options['zoomControl'] ?? self::CONTROL_ZOOM);
        $this->setMapTypeControl($options['mapTypeControl'] ?? self::CONTROL_MAP_TYPE);
        $this->setScaleControl($options['scaleControl'] ?? self::CONTROL_SCALE);
        $this->setStreetViewControl($options['streetViewControl'] ?? self::CONTROL_STREET_VIEW);
        $this->setRotateControl($options['rotateControl'] ?? self::CONTROL_ROTATE);
        $this->setFullscreenControl($options['fullscreenControl'] ?? self::CONTROL_FULLSCREEN);
        $this->setType($options['type'] ?? self::TYPE_ROADMAP);
        $this->setHeading($options['heading'] ?? self::HEADING);
        $this->setTilt($options['tilt'] ?? self::TILT);
        $this->setUi($options['ui'] ?? self::UI);
        $this->setIcon($options['markers']['icon'] ?? self::ICON);
        $this->setAnimation($options['markers']['animation'] ?? self::ANIMATION_NONE);
        $this->setGestureHandling($options['gestureHandling'] ?? self::GESTURE_HANDLING_AUTO);
        $this->setCluster($options['cluster'] ?? self::CLUSTER);
        $this->setClustersIcon($options['clusters']['icon'] ?? self::CLUSTERS_ICON);
        $this->setClustersGrid($options['clusters']['grid'] ?? self::CLUSTERS_GRID);
        $this->setClustersZoom($options['clusters']['zoom'] ?? self::CLUSTERS_ZOOM);
        $this->setClustersCenter($options['clusters']['center'] ?? self::CLUSTERS_CENTER);
        $this->setClustersSize($options['clusters']['size'] ?? self::CLUSTERS_SIZE);
    }

    /**
     * Is mapping enabled?
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->getEnabled();
    }

    /**
     * Set enabled status.
     *
     * @param boolean $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    protected function setEnabled($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Invalid map enabled setting.');
        }

        $this->enabled = $value;
    }

    /**
     * Get the enabled status.
     *
     * @return boolean
     */
    protected function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Enable mapping.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function enableMapping()
    {
        $this->setEnabled(true);
    }

    /**
     * Disable mapping.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function disableMapping()
    {
        $this->setEnabled(false);
    }

    /**
     * Set the Google Maps key.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setKey($value)
    {
        if (!is_string($value)) {
            throw new MapperArgumentException('Invalid Google Map\'s API key.');
        }

        $this->key = $value;
    }

    /**
     * Get the Google Maps key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the Google Maps version.
     *
     * @param float|string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setVersion($value)
    {
        if (!is_float($value) && !is_string($value)) {
            throw new MapperArgumentException('Invalid Google Map\'s API version.');
        }

        $this->version = $value;
    }

    /**
     * Get the Google Maps version.
     *
     * @return float|string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the Google Maps region.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setRegion($value)
    {
        if (!is_string($value)) {
            throw new MapperArgumentException('Invalid map region.');
        }

        if (!in_array($value, $this->regions)) {
            throw new MapperArgumentException('Region is required in ISO 3166-1 code format.');
        }

        $this->region = $value;
    }

    /**
     * Get the Google Maps region.
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set the Google Maps language.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setLanguage($value)
    {
        if (!is_string($value)) {
            throw new MapperArgumentException('Invalid map language.');
        }

        if (!in_array($value, $this->languages)) {
            throw new MapperArgumentException('Language is required in ISO 639-1 code format.');
        }

        $this->language = $value;
    }

    /**
     * Get the Google Maps language.
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the map async status.
     *
     * @param boolean $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    protected function setAsync($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Invalid map async status.');
        }

        $this->async = $value;
    }

    /**
     * Get the map async status.
     *
     * @return boolean
     */
    public function getAsync()
    {
        return $this->async;
    }

    /**
     * Enable async for maps.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function enableAsync()
    {
        $this->setAsync(true);
    }

    /**
     * Disable async for maps.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function disableAsync()
    {
        $this->setAsync(false);
    }

    /**
     * Set the marker status.
     *
     * @param boolean $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    protected function setMarker($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Invalid map marker setting.');
        }

        $this->marker = $value;
    }

    /**
     * Get the marker status.
     *
     * @return boolean
     */
    public function getMarker()
    {
        return $this->marker;
    }

    /**
     * Enable markers for maps.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function enableMarkers()
    {
        $this->setMarker(true);
    }

    /**
     * Disable markers for maps.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function disableMarkers()
    {
        $this->setMarker(false);
    }

    /**
     * Set the map center status.
     *
     * @param boolean $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    protected function setCenter($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Invalid map center setting.');
        }

        $this->center = $value;
    }

    /**
     * Get the map center status.
     *
     * @return boolean
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * Enable center of maps.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function enableCenter()
    {
        $this->setCenter(true);
    }

    /**
     * Disable center of maps.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function disableCenter()
    {
        $this->setCenter(false);
    }

    /**
     * Set the map locate user status.
     *
     * @param boolean $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    protected function setLocate($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Invalid map locate setting.');
        }

        $this->locate = $value;
    }

    /**
     * Get the map locate user status.
     *
     * @return boolean
     */
    public function getLocate()
    {
        return $this->locate;
    }

    /**
     * Enable locate user position on maps.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function enableLocate()
    {
        $this->setLocate(true);
    }

    /**
     * Disable locate user position on maps.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function disableLocate()
    {
        $this->setLocate(false);
    }

    /**
     * Set the map UI status.
     *
     * @param boolean $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    protected function setUi($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Invalid map ui setting.');
        }

        $this->ui = $value;
    }

    /**
     * Get the map UI status.
     *
     * @return boolean
     */
    public function getUi()
    {
        return $this->ui;
    }

    /**
     * Enable maps ui.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function enableUi()
    {
        $this->setUi(false);
    }

    /**
     * Disable maps ui.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function disableUi()
    {
        $this->setUi(true);
    }

    /**
     * Set map zoom level.
     *
     * @param int $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setZoom($value)
    {
        if (!is_numeric($value)) {
            throw new MapperArgumentException('Zoom level must be an integer.');
        }

        if ($value < 1 || $value > 20) {
            throw new MapperArgumentException('A zoom level must be between 1 and 20.');
        }

        $this->zoom = $value;
    }

    /**
     * Get map zoom level.
     *
     * @return int
     */
    public function getZoom()
    {
        return $this->zoom;
    }

    /**
     * Set map scroll wheel zoom.
     *
     * @param boolean $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setScrollWheelZoom($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Mouse Wheel Zoom must be a boolean.');
        }

        $this->scrollWheelZoom = $value;
    }

    /**
     * Get map scroll wheel zoom.
     *
     * @return boolean
     */
    public function getScrollWheelZoom()
    {
        return $this->scrollWheelZoom;
    }

    /**
     * Set map zoom control.
     *
     * @param boolean $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setZoomControl($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Zoom control must be a boolean.');
        }

        $this->zoomControl = $value;
    }

    /**
     * Get map zoom control.
     *
     * @return boolean
     */
    public function getZoomControl()
    {
        return $this->zoomControl;
    }

    /**
     * Set map type control.
     *
     * @param boolean $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setMapTypeControl($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Map type control must be a boolean.');
        }

        $this->mapTypeControl = $value;
    }

    /**
     * Get map type control.
     *
     * @return boolean
     */
    public function getMapTypeControl()
    {
        return $this->mapTypeControl;
    }

    /**
     * Set map scale control.
     *
     * @param boolean $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setScaleControl($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Scale control must be a boolean.');
        }

        $this->scaleControl = $value;
    }

    /**
     * Get map scale control.
     *
     * @return boolean
     */
    public function getScaleControl()
    {
        return $this->scaleControl;
    }

    /**
     * Set map street view control.
     *
     * @param boolean $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setStreetViewControl($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Street view control must be a boolean.');
        }

        $this->streetViewControl = $value;
    }

    /**
     * Get map street view control.
     *
     * @return boolean
     */
    public function getStreetViewControl()
    {
        return $this->streetViewControl;
    }

    /**
     * Set map rotate control.
     *
     * @param boolean $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setRotateControl($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Rotate control must be a boolean.');
        }

        $this->rotateControl = $value;
    }

    /**
     * Get map rotate control.
     *
     * @return boolean
     */
    public function getRotateControl()
    {
        return $this->rotateControl;
    }

    /**
     * Set map fullscreen control.
     *
     * @param boolean $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setFullscreenControl($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Fullscreen control must be a boolean.');
        }

        $this->fullscreenControl = $value;
    }

    /**
     * Get map fullscreen control.
     *
     * @return boolean
     */
    public function getFullscreenControl()
    {
        return $this->fullscreenControl;
    }

    /**
     * Set map type.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setType($value)
    {
        if (!in_array($value, $this->types)) {
            throw new MapperArgumentException('Invalid map type.');
        }

        $this->type = $value;
    }

    /**
     * Get map type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set map heading.
     *
     * @param int|double $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setHeading($value)
    {
        if (!is_numeric($value)) {
            throw new MapperArgumentException('Invalid map heading.');
        }

        $this->heading = $value;
    }

    /**
     * Get map heading.
     *
     * @return int|double
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * Set map tilt.
     *
     * @param int|double $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setTilt($value)
    {
        if (!is_numeric($value)) {
            throw new MapperArgumentException('Invalid map tilt.');
        }

        $this->tilt = $value;
    }

    /**
     * Get map tilt.
     *
     * @return int
     */
    public function getTilt()
    {
        return $this->tilt;
    }

    /**
     * Set map marker icon.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setIcon($value)
    {
        if (!is_string($value)) {
            throw new MapperArgumentException('Invalid map marker icon.');
        }

        $this->icon = $value;
    }

    /**
     * Get map marker icon.
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set map marker animation.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setAnimation($value)
    {
        if (!in_array($value, $this->animations)) {
            throw new MapperArgumentException('Invalid map marker animation.');
        }

        $this->animation = $value;
    }

    /**
     * Get map marker animation.
     *
     * @return string
     */
    public function getAnimation()
    {
        return $this->animation;
    }

    /**
     * Set map gesture handling.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setGestureHandling($value)
    {
        if (!in_array($value, $this->gestureHandlers)) {
            throw new MapperArgumentException('Invalid map gesture handling.');
        }

        $this->gestureHandling = $value;
    }

    /**
     * Get map gesture handling.
     *
     * @return string
     */
    public function getGestureHandling()
    {
        return $this->gestureHandling;
    }

    /**
     * Set cluster status.
     *
     * @param bool $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    protected function setCluster($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Invalid map cluster setting.');
        }

        $this->cluster = $value;
    }

    /**
     * Get the cluster status.
     *
     * @return bool
     */
    public function getCluster()
    {
        return $this->cluster;
    }

    /**
     * Enable cluster.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function enableCluster()
    {
        $this->setCluster(true);
    }

    /**
     * Disable cluster.
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function disableCluster()
    {
        $this->setCluster(false);
    }

    /**
     * Set map cluster icon.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setClustersIcon($value)
    {
        if (!is_string($value)) {
            throw new MapperArgumentException('Invalid map clusters icon setting.');
        }

        $this->clustersIcon = $value;
    }

    /**
     * Get map clusters icon.
     *
     * @return string
     */
    public function getClustersIcon()
    {
        return $this->clustersIcon;
    }

    /**
     * Set map cluster grid.
     *
     * @param int $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setClustersGrid($value)
    {
        if (!is_int($value)) {
            throw new MapperArgumentException('Invalid map clusters grid setting.');
        }

        $this->clustersGrid = $value;
    }

    /**
     * Get map cluster grid.
     *
     * @return int
     */
    public function getClustersGrid()
    {
        return $this->clustersGrid;
    }

    /**
     * Set map cluster zoom.
     *
     * @param int|null $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setClustersZoom($value)
    {
        if (!is_integer($value) && !is_null($value)) {
            throw new MapperArgumentException('Invalid map clusters zoom setting.');
        }

        $this->clustersZoom = $value;
    }

    /**
     * Get map cluster grid.
     *
     * @return integer|null
     */
    public function getClustersZoom()
    {
        return $this->clustersZoom;
    }

    /**
     * Set map cluster center.
     *
     * @param bool $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setClustersCenter($value)
    {
        if (!is_bool($value)) {
            throw new MapperArgumentException('Invalid map clusters center setting.');
        }

        $this->clustersCenter = $value;
    }

    /**
     * Get map cluster center.
     *
     * @return bool
     */
    public function getClustersCenter()
    {
        return $this->clustersCenter;
    }

    /**
     * Set map cluster size.
     *
     * @param int $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setClustersSize($value)
    {
        if (!is_integer($value)) {
            throw new MapperArgumentException('Invalid map clusters size setting.');
        }

        $this->clustersSize = $value;
    }

    /**
     * Get map cluster size.
     *
     * @return int
     */
    public function getClustersSize()
    {
        return $this->clustersSize;
    }

    /**
     * Get mapper options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            'key' => $this->getKey(),
            'version' => $this->getVersion(),
            'region' => $this->getRegion(),
            'language' => $this->getLanguage(),
            'async' => $this->getAsync(),
            'marker' => $this->getMarker(),
            'center' => $this->getCenter(),
            'locate' => $this->getLocate(),
            'zoom' => $this->getZoom(),
            'scrollWheelZoom' => $this->getScrollWheelZoom(),
            'fullscreenControl' => $this->getFullscreenControl(),
            'zoomControl' => $this->getZoomControl(),
            'scaleControl' => $this->getScaleControl(),
            'streetViewControl' => $this->getStreetViewControl(),
            'rotateControl' => $this->getRotateControl(),
            'mapTypeControl' => $this->getMapTypeControl(),
            'type' => $this->getType(),
            'heading' => $this->getHeading(),
            'tilt' => $this->getTilt(),
            'ui' => $this->getUi(),
            'overlay' => '',
            'gestureHandling' => $this->getGestureHandling(),
            'markers' => [
                'title' => '',
                'label' => '',
                'content' => '',
                'icon' => $this->getIcon(),
                'place' => '',
                'animation' => $this->getAnimation(),
                'symbol' => '',
            ],
            'cluster' => $this->getCluster(),
            'clusters' => [
                'icon' => $this->getClustersIcon(),
                'grid' => $this->getClustersGrid(),
                'zoom' => $this->getClustersZoom(),
                'center' => $this->getClustersCenter(),
                'size' => $this->getClustersSize()
            ],
        ];
    }

    /**
     * Add mapping item.
     *
     * @param object $value
     *
     * @return void
     */
    protected function addItem($value)
    {
        $this->items[] = $value;
    }

    /**
     * Set mapping items.
     *
     * @param array $array
     *
     * @return void
     */
    protected function setItems(array $array)
    {
        $this->items = $array;
    }

    /**
     * Get the mapping items.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get a mapping item by reference.
     *
     * @param int $item
     *
     * @return array|bool
     */
    public function getItem($item)
    {
        return isset($this->items[$item]) ? $this->items[$item] : false;
    }
}

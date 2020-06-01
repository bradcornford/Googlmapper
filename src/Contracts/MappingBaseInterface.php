<?php

namespace Cornford\Googlmapper\Contracts;

use Cornford\Googlmapper\Exceptions\MapperArgumentException;

interface MappingBaseInterface
{
    /**
     * Is mapping enabled?
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Enable mapping.
     *
     * @return void
     */
    public function enableMapping();

    /**
     * Disable mapping.
     *
     * @return void
     */
    public function disableMapping();

    /**
     * Set the Google Maps key.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setKey($value);

    /**
     * Get the Google Maps key.
     *
     * @return string
     */
    public function getKey();

    /**
     * Set the Google Maps region.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setRegion($value);

    /**
     * Get the Google Maps region.
     *
     * @return string
     */
    public function getRegion();

    /**
     * Set the Google Maps language.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setLanguage($value);

    /**
     * Get the Google Maps language.
     *
     * @return string
     */
    public function getLanguage();

    /**
     * Get the map async status.
     *
     * @return bool
     */
    public function getAsync();

    /**
     * Enable async for maps.
     *
     * @return void
     */
    public function enableAsync();

    /**
     * Disable async for maps.
     *
     * @return void
     */
    public function disableAsync();

    /**
     * Get the marker status.
     *
     * @return bool
     */
    public function getMarker();

    /**
     * Enable markers for maps.
     *
     * @return void
     */
    public function enableMarkers();

    /**
     * Disable markers for maps.
     *
     * @return void
     */
    public function disableMarkers();

    /**
     * Get the map center status.
     *
     * @return bool
     */
    public function getCenter();

    /**
     * Enable center of maps.
     *
     * @return void
     */
    public function enableCenter();

    /**
     * Disable center of maps.
     *
     * @return void
     */
    public function disableCenter();

    /**
     * Get the map locate user status.
     *
     * @return bool
     */
    public function getLocate();

    /**
     * Enable locate user position on maps.
     *
     * @return void
     */
    public function enableLocate();

    /**
     * Disable locate user position on maps.
     *
     * @return void
     */
    public function disableLocate();

    /**
     * Get the map UI status.
     *
     * @return bool
     */
    public function getUi();

    /**
     * Enable maps ui.
     *
     * @return void
     */
    public function enableUi();

    /**
     * Disable maps ui.
     *
     * @return void
     */
    public function disableUi();

    /**
     * Set map zoom level.
     *
     * @param int $zoom
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setZoom($zoom);

    /**
     * Get map zoom level.
     *
     * @return int
     */
    public function getZoom();

    /**
     * Set map scroll wheel zoom.
     *
     * @param bool $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setScrollWheelZoom($value);

    /**
     * Get map scroll wheel zoom.
     *
     * @return bool
     */
    public function getScrollWheelZoom();

    /**
     * Set map zoom control.
     *
     * @param bool $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setZoomControl($value);

    /**
     * Get map zoom control.
     *
     * @return bool
     */
    public function getZoomControl();

    /**
     * Set map type control.
     *
     * @param bool $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setMapTypeControl($value);

    /**
     * Get map type control.
     *
     * @return bool
     */
    public function getMapTypeControl();

    /**
     * Set map scale control.
     *
     * @param bool $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setScaleControl($value);

    /**
     * Get map scale control.
     *
     * @return bool
     */
    public function getScaleControl();

    /**
     * Set map street view control.
     *
     * @param bool $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setStreetViewControl($value);

    /**
     * Get map street view control.
     *
     * @return bool
     */
    public function getStreetViewControl();

    /**
     * Set map rotate control.
     *
     * @param bool $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setRotateControl($value);

    /**
     * Get map rotate control.
     *
     * @return bool
     */
    public function getRotateControl();

    /**
     * Set map fullscreen control.
     *
     * @param bool $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setFullscreenControl($value);

    /**
     * Get map fullscreen control.
     *
     * @return bool
     */
    public function getFullscreenControl();

    /**
     * Set map type.
     *
     * @param string $type
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setType($type);

    /**
     * Get map type.
     *
     * @return string
     */
    public function getType();

    /**
     * Set map heading.
     *
     * @param int|double $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setHeading($value);

    /**
     * Get map heading.
     *
     * @return int|double
     */
    public function getHeading();

    /**
     * Set map tilt.
     *
     * @param int $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setTilt($value);

    /**
     * Get map tilt.
     *
     * @return int
     */
    public function getTilt();

    /**
     * Set map marker icon.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setIcon($value);

    /**
     * Get map marker icon.
     *
     * @return string
     */
    public function getIcon();

    /**
     * Set map marker animation.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setAnimation($value);

    /**
     * Get map marker animation.
     *
     * @return string
     */
    public function getAnimation();

    /**
     * Set map gesture handling.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setGestureHandling($value);

    /**
     * Get map gesture handling.
     *
     * @return string
     */
    public function getGestureHandling();

    /**
     * Get the cluster status.
     *
     * @return bool
     */
    public function getCluster();

    /**
     * Enable cluster.
     *
     * @return void
     */
    public function enableCluster();

    /**
     * Disable cluster.
     *
     * @return void
     */
    public function disableCluster();

    /**
     * Set map cluster icon.
     *
     * @param string $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setClustersIcon($value);

    /**
     * Get map clusters icon.
     *
     * @return string
     */
    public function getClustersIcon();

    /**
     * Set map cluster grid.
     *
     * @param int $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setClustersGrid($value);

    /**
     * Get map cluster grid.
     *
     * @return int
     */
    public function getClustersGrid();

    /**
     * Set map cluster zoom.
     *
     * @param int|null $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setClustersZoom($value);

    /**
     * Get map cluster grid.
     *
     * @return int|null
     */
    public function getClustersZoom();

    /**
     * Set map cluster center.
     *
     * @param bool $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setClustersCenter($value);

    /**
     * Get map cluster center.
     *
     * @return bool
     */
    public function getClustersCenter();

    /**
     * Set map cluster size.
     *
     * @param int $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setClustersSize($value);

    /**
     * Get map cluster size.
     *
     * @return int
     */
    public function getClustersSize();

    /**
     * Get the mapping items.
     *
     * @return array
     */
    public function getItems();

    /**
     * Get a mapping item by reference.
     *
     * @param int $item
     *
     * @return array|bool
     */
    public function getItem($item);
}

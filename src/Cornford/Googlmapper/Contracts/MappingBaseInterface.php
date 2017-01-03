<?php namespace Cornford\Googlmapper\Contracts;

use Cornford\Googlmapper\Exceptions\MapperArgumentException;

interface MappingBaseInterface {

	/**
	 * Is mapping enabled?
	 *
	 * @return boolean
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
     * @return boolean
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
	 * Get the map user status.
	 *
	 * @return boolean
	 */
	public function getUser();

	/**
	 * Enable users for maps.
	 *
	 * @return void
	 */
	public function enableUsers();

	/**
	 * Disable users for maps.
	 *
	 * @return void
	 */
	public function disableUsers();

	/**
	 * Get the marker status.
	 *
	 * @return boolean
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
	 * @return boolean
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
	 * @return boolean
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
	 * @return boolean
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
	 * @param integer $zoom
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setZoom($zoom);

	/**
	 * Get map zoom level.
	 *
	 * @return integer
	 */
	public function getZoom();

	/**
	 * Set map scroll wheel zoom.
	 *
	 * @param boolean $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setScrollWheelZoom($value);

	/**
	 * Get map scroll wheel zoom.
	 *
	 * @return boolean
	 */
	public function getScrollWheelZoom();

	/**
	 * Set map fullscreen control.
	 *
	 * @param boolean $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setFullscreenControl($value);

	/**
	 * Get map fullscreen control.
	 *
	 * @return boolean
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
     * @param integer|double $value
     *
     * @throws MapperArgumentException
     *
     * @return void
     */
    public function setHeading($value);

    /**
     * Get map heading.
     *
     * @return integer
     */
    public function getHeading();

	/**
	 * Set map tilt.
	 *
	 * @param integer $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setTilt($value);

	/**
	 * Get map tilt.
	 *
	 * @return integer
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
	 * Get the cluster status.
	 *
	 * @return boolean
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
	 * @param integer $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setClustersGrid($value);

	/**
	 * Get map cluster grid.
	 *
	 * @return integer
	 */
	public function getClustersGrid();

	/**
	 * Set map cluster zoom.
	 *
	 * @param integer|null $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setClustersZoom($value);

	/**
	 * Get map cluster grid.
	 *
	 * @return integer|null
	 */
	public function getClustersZoom();

	/**
	 * Set map cluster center.
	 *
	 * @param boolean $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setClustersCenter($value);

	/**
	 * Get map cluster center.
	 *
	 * @return boolean
	 */
	public function getClustersCenter();

	/**
	 * Set map cluster size.
	 *
	 * @param integer $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setClustersSize($value);

	/**
	 * Get map cluster size.
	 *
	 * @return integer
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
	 * @param integer $item
	 *
	 * @return array|boolean
	 */
	public function getItem($item);

}

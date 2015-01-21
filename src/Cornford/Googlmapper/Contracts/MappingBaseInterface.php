<?php namespace Cornford\Googlmapper\Contracts;

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
	 * Get map $tilt.
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

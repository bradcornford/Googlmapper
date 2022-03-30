<?php

namespace FifyIO\Googlmapper\Contracts;

use FifyIO\Googlmapper\Exceptions\MapperArgumentException;
use FifyIO\Googlmapper\Exceptions\MapperException;
use FifyIO\Googlmapper\Exceptions\MapperSearchException;
use FifyIO\Googlmapper\Exceptions\MapperSearchLimitException;
use FifyIO\Googlmapper\Exceptions\MapperSearchResultException;
use FifyIO\Googlmapper\Models\Location;

interface MappingInterface
{
    /**
     * Renders and returns Google Map code.
     *
     * @param int $item
     *
     * @return string
     */
    public function render($item = -1);

    /**
     * Renders and returns Google Map javascript code.
     *
     * @return string
     */
    public function renderJavascript();

    /**
     * Locate a location and return a Location instance.
     *
     * @param string $location
     *
     * @throws MapperArgumentException
     * @throws MapperSearchException
     * @throws MapperSearchResultException
     * @throws MapperSearchLimitException
     * @throws MapperException
     *
     * @return Location
     */
    public function location($location);

    /**
     * Add a new map.
     *
     * @param float $latitude
     * @param float $longitude
     * @param array $options
     *
     * @return void
     */
    public function map($latitude, $longitude, array $options = []);

    /**
     * Add a new street view map.
     *
     * @param float $latitude
     * @param float $longitude
     * @param int   $heading
     * @param int   $pitch
     * @param array $options
     *
     * @return void
     */
    public function streetview($latitude, $longitude, $heading, $pitch, array $options = []);

    /**
     * Add a new map marker.
     *
     * @param float $latitude
     * @param float $longitude
     * @param array $options
     *
     * @throws MapperException
     *
     * @return void
     */
    public function marker($latitude, $longitude, array $options = []);

    /**
     * Add a new map information window.
     *
     * @param float  $latitude
     * @param float  $longitude
     * @param string $content
     * @param array  $options
     *
     * @throws MapperException
     *
     * @return void
     */
    public function informationWindow($latitude, $longitude, $content, array $options = []);

    /**
     * Add a new map polyline.
     *
     * @param array $coordinates
     * @param array $options
     *
     * @throws MapperException
     *
     * @return void
     */
    public function polyline(array $coordinates = [], array $options = []);

    /**
     * Add a new map polygon.
     *
     * @param array $coordinates
     * @param array $options
     *
     * @throws MapperException
     *
     * @return void
     */
    public function polygon(array $coordinates = [], array $options = []);

    /**
     * Add a new map rectangle.
     *
     * @param array $coordinates
     * @param array $options
     *
     * @throws MapperException
     *
     * @return void
     */
    public function rectangle(array $coordinates = [], array $options = []);

    /**
     * Add a new map circle.
     *
     * @param array $coordinates
     * @param array $options
     *
     * @throws MapperException
     *
     * @return void
     */
    public function circle(array $coordinates = [], array $options = []);
}

<?php

namespace FifyIO\Googlmapper\Facades;

use FifyIO\Googlmapper\Mapper;
use FifyIO\Googlmapper\Models\Location;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string render(int $item)
 * @method static Location location()
 * @method static Mapper map($latitude, $longitude, array $options = [])
 * @method static Mapper streetview($latitude, $longitude, $heading, $pitch, array $options = [])
 * @method static Mapper marker($latitude, $longitude, array $options = [])
 * @method static Mapper informationWindow($latitude, $longitude, $content = '', array $options = [])
 * @method static Mapper polyline(array $coordinates = [], array $options = [])
 * @method static Mapper polygon(array $coordinates = [], array $options = [])
 * @method static Mapper rectangle(array $coordinates = [], array $options = [])
 * @method static Mapper circle(array $coordinates = [], array $options = [])
 * @method static bool isEnabled()
 * @method static void enableMapping()
 * @method static void setKey(string $value)
 * @method static string getKey()
 * @method static void setRegion(string $value)
 * @method static string getRegion()
 * @method static void setLanguage(string $value)
 * @method static string getLanguage()
 * @method static bool getAsync()
 * @method static void enableAsync()
 * @method static void disableAsync()
 * @method static bool getMarker()
 * @method static void enableMarkers()
 * @method static void disableMarkers()
 * @method static bool getCenter()
 * @method static void enableCenter()
 * @method static void disableCenter()
 * @method static bool getLocate()
 * @method static void enableLocate()
 * @method static void disableLocate()
 * @method static bool getUi()
 * @method static void enableUi()
 * @method static void disableUi()
 * @method static void setZoom(int $zoom)
 * @method static int getZoom()
 * @method static void setScrollWheelZoom(bool $value)
 * @method static bool getScrollWheelZoom()
 * @method static void setZoomControl(bool $value)
 * @method static bool getZoomControl()
 * @method static void setMapTypeControl(bool $value)
 * @method static bool getMapTypeControl()
 * @method static void setScaleControl(bool $value)
 * @method static bool getScaleControl()
 * @method static void setStreetViewControl(bool $value)
 * @method static bool getStreetViewControl()
 * @method static void setRotateControl(bool $value)
 * @method static bool getRotateControl()
 * @method static void setFullscreenControl(bool $value)
 * @method static bool getFullscreenControl()
 * @method static void setType(string $value)
 * @method static string getType()
 * @method static void setHeading(int|double $value)
 * @method static int|double getHeading()
 * @method static void setTilt(int $value)
 * @method static int getTilt()
 * @method static void setIcon(string $value)
 * @method static string getIcon()
 * @method static void setAnimation(string $value)
 * @method static string getAnimation()
 * @method static void setGestureHandling(string $value)
 * @method static string getGestureHandling()
 * @method static bool getCluster()
 * @method static void enableCluster()
 * @method static void disableCluster()
 * @method static void setClustersIcon(string $value)
 * @method static string getClustersIcon()
 * @method static void setClustersGrid(int $value)
 * @method static int getClustersGrid()
 * @method static void setClustersZoom(int|null $value)
 * @method static int|null getClustersZoom()
 * @method static void setClustersCenter(bool $value)
 * @method static bool getClustersCenter()
 * @method static void setClustersSize(int $value)
 * @method static int getClustersSize()
 * @method static array getItems()
 * @method static array|bool getItem(int $item)
 *
 * @see Mapper
 */
class MapperFacade extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return Mapper::class;
    }
}

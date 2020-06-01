<?php namespace spec\Cornford\Googlmapper;

use Cornford\Googlmapper\Exceptions\MapperArgumentException;
use Cornford\Googlmapper\Exceptions\MapperSearchKeyException;
use Cornford\Googlmapper\Exceptions\MapperSearchResultException;
use Cornford\Googlmapper\Mapper;
use Cornford\Googlmapper\Models\Location;
use Illuminate\View\Factory as View;
use Mockery;
use PhpSpec\ObjectBehavior;

class MapperSpec extends ObjectBehavior
{
    private const STRING = 'test';
    private const LOCATION = 'test';
    private const INTEGER = 10;
    private const FLOAT = 3.33;
    private const BOOLEAN = false;

    private const REGION = 'GB';
    private const LANGUAGE = 'en-gb';
    private const TYPE = 'ROADMAP';

    private const ANIMATION = 'NONE';

    private const GESTURE_HANDLING = 'none';

    private const API_KEY  = 'AIzaSyCTwWv4rTQdNtZAaAd8D1SK5m94eTp8GiQ';

    public function let()
    {
        $location = Mockery::mock(Location::class);

        $view = Mockery::mock(View::class);
        $view->shouldReceive('make')->andReturn($view);
        $view->shouldReceive('withView')->andReturn($view);
        $view->shouldReceive('withOptions')->andReturn($view);
        $view->shouldReceive('withItems')->andReturn($view);
        $view->shouldReceive('render')->andReturn(self::STRING);
        $view->shouldReceive('location')->andReturn($location);

        $this->beConstructedWith($view, ['enabled' => true, 'key' => self::STRING, 'version' => self::FLOAT, 'region' => self::REGION, 'language' => self::LANGUAGE]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Mapper::class);
    }

    public function it_throws_an_exception_with_incorrect_options()
    {
        $view = Mockery::mock(View::class);
        $this->shouldThrow(MapperArgumentException::class)
            ->during('__construct', [$view]);
    }

    public function it_can_return_a_location_when_a_location_is_searched()
    {
        // Skip due to API Key restrictions
        return;
        $this->setKey(self::API_KEY);
        $this->location(self::LOCATION)->shouldReturnAnInstanceOf(Location::class);
    }

    public function it_throws_an_exception_when_a_blank_location_is_searched()
    {
        $this->setKey(self::API_KEY);
        $this->shouldThrow(MapperArgumentException::class)->during('location', ['']);
    }

    public function it_throws_an_exception_when_an_invalid_location_is_searched()
    {
        // Skip due to API Key restrictions
        return;
        $this->setKey(self::API_KEY);
        $this->shouldThrow(MapperSearchResultException::class)->during('location', ['abcdefghijklmnopqrstuvwxyz']);
    }

    public function it_throws_an_exception_when_an_invalid_key_is_used_to_location_search()
    {
        $this->setKey('123');
        $this->shouldThrow(MapperSearchKeyException::class)->during('location', [self::LOCATION]);
    }

    public function it_can_be_enabled()
    {
        $this->enableMapping();
        $this->isEnabled()->shouldReturn(true);
        $this->render()->shouldReturn(self::STRING);
        $this->getItems()->shouldHaveCount(0);
        $this->getItems()->shouldReturn([]);
    }

    public function it_can_be_disabled()
    {
        $this->disableMapping();
        $this->isEnabled()->shouldReturn(false);
        $this->render()->shouldReturn(null);
        $this->getItems()->shouldHaveCount(0);
    }

    public function it_can_set_and_get_key_option()
    {
        $this->setKey(self::STRING);
        $this->getKey()->shouldReturn(self::STRING);
    }

    public function it_can_set_and_get_version_option()
    {
        $this->setVersion(self::STRING);
        $this->getVersion()->shouldReturn(self::STRING);
    }

    public function it_can_set_and_get_region_option()
    {
        $this->setRegion(self::REGION);
        $this->getRegion()->shouldReturn(self::REGION);
    }

    public function it_can_set_and_get_language_option()
    {
        $this->setLanguage(self::LANGUAGE);
        $this->getLanguage()->shouldReturn(self::LANGUAGE);
    }

    public function it_can_set_and_get_marker_option()
    {
        $this->enableMarkers();
        $this->getMarker()->shouldReturn(true);
        $this->disableMarkers();
        $this->getMarker()->shouldReturn(false);
    }

    public function it_can_set_and_get_center_option()
    {
        $this->enableCenter();
        $this->getCenter()->shouldReturn(true);
        $this->disableCenter();
        $this->getCenter()->shouldReturn(false);
    }

    public function it_can_set_and_get_locate_option()
    {
        $this->enableLocate();
        $this->getLocate()->shouldReturn(true);
        $this->disableLocate();
        $this->getLocate()->shouldReturn(false);
    }

    public function it_can_set_and_get_ui_option()
    {
        $this->enableUi();
        $this->getUi()->shouldReturn(false);
        $this->disableUi();
        $this->getUi()->shouldReturn(true);
    }

    public function it_can_set_and_get_zoom_option()
    {
        $this->setZoom(self::INTEGER);
        $this->getZoom()->shouldReturn(self::INTEGER);
    }

    public function it_can_set_and_get_type_option()
    {
        $this->setType(self::TYPE);
        $this->getType()->shouldReturn(self::TYPE);
    }

    public function it_can_set_and_get_tilt_option()
    {
        $this->setTilt(self::INTEGER);
        $this->getTilt()->shouldReturn(self::INTEGER);
    }

    public function it_can_set_and_get_icon_option()
    {
        $this->setIcon(self::STRING);
        $this->getIcon()->shouldReturn(self::STRING);
    }

    public function it_can_set_and_get_animation_option()
    {
        $this->setAnimation(self::ANIMATION);
        $this->getAnimation()->shouldReturn(self::ANIMATION);
    }

    public function it_can_set_and_get_gesture_handling_option()
    {
        $this->setGestureHandling(self::GESTURE_HANDLING);
        $this->getGestureHandling()->shouldReturn(self::GESTURE_HANDLING);
    }

    public function it_can_set_and_get_cluster_option()
    {
        $this->enableCluster();
        $this->getCluster()->shouldReturn(true);
        $this->disableCluster();
        $this->getCluster()->shouldReturn(false);
    }

    public function it_can_set_and_get_clusters_icon_option()
    {
        $this->setClustersIcon(self::STRING);
        $this->getClustersIcon()->shouldReturn(self::STRING);
    }

    public function it_can_set_and_get_clusters_grid_option()
    {
        $this->setClustersGrid(self::INTEGER);
        $this->getClustersGrid()->shouldReturn(self::INTEGER);
    }

    public function it_can_set_and_get_clusters_zoom_option()
    {
        $this->setClustersZoom(self::INTEGER);
        $this->getClustersZoom()->shouldReturn(self::INTEGER);
    }

    public function it_can_set_and_get_clusters_center_option()
    {
        $this->setClustersCenter(self::BOOLEAN);
        $this->getClustersCenter()->shouldReturn(self::BOOLEAN);
    }

    public function it_can_set_and_get_clusters_size_option()
    {
        $this->setClustersSize(self::INTEGER);
        $this->getClustersSize()->shouldReturn(self::INTEGER);
    }

    public function it_can_create_a_map()
    {
        $this->map(self::INTEGER, self::INTEGER)->shouldReturn($this);
        $this->render()->shouldReturn(self::STRING);
    }

    public function it_can_create_a_map_with_a_marker()
    {
        $this->map(self::INTEGER, self::INTEGER)->shouldReturn($this);
        $this->marker(self::INTEGER, self::INTEGER)->shouldReturn($this);
        $this->render()->shouldReturn(self::STRING);
    }

    public function it_can_create_a_map_with_an_information_window()
    {
        $this->map(self::INTEGER, self::INTEGER)->shouldReturn($this);
        $this->informationWindow(self::INTEGER, self::INTEGER, self::STRING)->shouldReturn($this);
        $this->render()->shouldReturn(self::STRING);
    }

    public function it_can_create_a_map_with_a_polyline()
    {
        $this->map(self::INTEGER, self::INTEGER)->shouldReturn($this);
        $this->polyline([['latitude' => self::INTEGER, 'longitude' => self::INTEGER]])->shouldReturn($this);
        $this->render()->shouldReturn(self::STRING);
    }

    public function it_can_create_a_map_with_a_polygon()
    {
        $this->map(self::INTEGER, self::INTEGER)->shouldReturn($this);
        $this->polygon([
            ['latitude' => self::INTEGER, 'longitude' => self::INTEGER],
            ['latitude' => self::INTEGER, 'longitude' => self::INTEGER]
        ])->shouldReturn($this);
        $this->render()->shouldReturn(self::STRING);
    }

    public function it_can_create_a_map_with_a_rectangle()
    {
        $this->map(self::INTEGER, self::INTEGER)->shouldReturn($this);
        $this->rectangle([
                ['latitude' => self::INTEGER, 'longitude' => self::INTEGER],
                ['latitude' => self::INTEGER, 'longitude' => self::INTEGER]
            ])->shouldReturn($this);
        $this->render()->shouldReturn(self::STRING);
    }

    public function it_can_create_a_map_with_a_circle()
    {
        $this->map(self::INTEGER, self::INTEGER)->shouldReturn($this);
        $this->circle([['latitude' => self::INTEGER, 'longitude' => self::INTEGER]])->shouldReturn($this);
        $this->render()->shouldReturn(self::STRING);
    }

    public function it_can_create_a_streetview_map()
    {
        $this->streetview(self::INTEGER, self::INTEGER, self::INTEGER, self::INTEGER)->shouldReturn($this);
        $this->render()->shouldReturn(self::STRING);
    }

    public function it_can_create_javascript_inclusions()
    {
        $this->map(self::INTEGER, self::INTEGER)->shouldReturn($this);
        $this->renderJavascript()->shouldReturn(self::STRING);
    }
}

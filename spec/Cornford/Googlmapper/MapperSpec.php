<?php namespace spec\Cornford\Googlmapper;

use Cornford\Googlmapper\Mapper;
use PhpSpec\ObjectBehavior;
use Mockery;

class MapperSpec extends ObjectBehavior
{

	const STRING = 'test';
	const INTEGER = 10;

	const REGION = 'GB';
	const LANGUAGE = 'en-gb';
	const TYPE = 'ROADMAP';

	public function let()
	{
		$view = Mockery::mock('Illuminate\View\Factory');
		$view->shouldReceive('make')->andReturn($view);
		$view->shouldReceive('withView')->andReturn($view);
		$view->shouldReceive('withOptions')->andReturn($view);
		$view->shouldReceive('withItems')->andReturn($view);
		$view->shouldReceive('render')->andReturn(self::STRING);
		$this->beConstructedWith($view, ['enabled' => true, 'key' => self::STRING, 'region' => self::REGION, 'language' => self::LANGUAGE]);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType('Cornford\Googlmapper\Mapper');
	}

	public function it_throws_an_exception_with_incorrect_options()
	{
		$view = Mockery::mock('Illuminate\View\Factory');
		$this->shouldThrow('Cornford\Googlmapper\Exceptions\MapperArgumentException')
			->during('__construct', [$view]);
	}

	public function it_can_render_map_code()
	{
		$this->render()->shouldReturn(self::STRING);
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

	public function it_can_be_set_and_get_user_option()
	{
		$this->enableUsers();
		$this->getUser()->shouldReturn(true);
		$this->disableUsers();
		$this->getUser()->shouldReturn(false);
	}

	public function it_can_be_set_and_get_marker_option()
	{
		$this->enableMarkers();
		$this->getMarker()->shouldReturn(true);
		$this->disableMarkers();
		$this->getMarker()->shouldReturn(false);
	}

	public function it_can_be_set_and_get_center_option()
	{
		$this->enableCenter();
		$this->getCenter()->shouldReturn(true);
		$this->disableCenter();
		$this->getCenter()->shouldReturn(false);
	}

	public function it_can_be_set_and_get_ui_option()
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

}

<?php namespace spec\Cornford\Googlmapper\Models;

use Cornford\Googlmapper\Models\Location;
use PhpSpec\ObjectBehavior;
use Mockery;
use Illuminate\View\Factory;

class LocationSpec extends ObjectBehavior
{

	const INTEGER = 1;
	const STRING = 'string';

	public function let()
	{
		$mapper = Mockery::mock('Cornford\Googlmapper\Mapper');
		$mapper->shouldReceive('map')->andReturn($mapper);
		$mapper->shouldReceive('streetview')->andReturn($mapper);

		$this->beConstructedWith([
			'mapper' => $mapper,
			'search' => self::STRING,
			'address' => self::STRING,
			'type' => self::STRING,
			'latitude' => self::INTEGER,
			'longitude' => self::INTEGER,
			'placeId' => self::STRING
		]);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType('Cornford\Googlmapper\Models\Location');
	}

	public function it_can_create_a_map()
	{
		$this->map()->shouldReturnAnInstanceOf('Cornford\Googlmapper\Mapper');
	}

	public function it_can_create_a_streetview()
	{
		$this->streetview(self::INTEGER, self::INTEGER)->shouldReturnAnInstanceOf('Cornford\Googlmapper\Mapper');
	}

}

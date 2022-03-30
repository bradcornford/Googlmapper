<?php

namespace spec\FifyIO\Googlmapper\Models;

use FifyIO\Googlmapper\Mapper;
use FifyIO\Googlmapper\Models\Location;
use Mockery;
use PhpSpec\ObjectBehavior;

class LocationSpec extends ObjectBehavior
{
    private const INTEGER = 1;
    private const STRING = 'string';

    public function let()
    {
        $mapper = Mockery::mock(Mapper::class);
        $mapper->shouldReceive('map')->andReturn($mapper);
        $mapper->shouldReceive('streetview')->andReturn($mapper);

        $this->beConstructedWith([
            'mapper' => $mapper,
            'search' => self::STRING,
            'address' => self::STRING,
            'postalCode' => self::STRING,
            'type' => self::STRING,
            'latitude' => self::INTEGER,
            'longitude' => self::INTEGER,
            'placeId' => self::STRING
        ]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Location::class);
    }

    public function it_can_create_a_map()
    {
        $this->map()->shouldReturnAnInstanceOf(Mapper::class);
    }

    public function it_can_create_a_streetview()
    {
        $this->streetview(self::INTEGER, self::INTEGER)->shouldReturnAnInstanceOf(Mapper::class);
    }
}

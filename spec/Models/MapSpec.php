<?php

namespace spec\Cornford\Googlmapper\Models;

use Cornford\Googlmapper\Models\Map;
use Illuminate\View\Factory as View;
use PhpSpec\ObjectBehavior;
use Mockery;

class MapSpec extends ObjectBehavior
{
    private const STRING = 'test';
    private const INTEGER = 10;

    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Map::class);
    }

    public function it_can_create_a_maker()
    {
        $this->marker(self::INTEGER, self::INTEGER);
        $this->getMarkers()->shouldHaveCount(1);
    }

    public function it_can_create_a_shape()
    {
        $this->shape(
            Map::SHAPE_POLYLINE,
            [
                ['latitude' => self::INTEGER, 'longitude' => self::INTEGER],
                ['latitude' => self::INTEGER, 'longitude' => self::INTEGER]
            ]
        );
        $this->getShapes()->shouldHaveCount(1);
    }

    public function it_can_render_a_map()
    {
        $this->marker(self::INTEGER, self::INTEGER);
        $this->getMarkers()->shouldHaveCount(1);
        $view = Mockery::mock(View::class);
        $view->shouldReceive('make')->andReturn($view);
        $view->shouldReceive('withOptions')->andReturn($view);
        $view->shouldReceive('withId')->andReturn($view);
        $view->shouldReceive('withView')->andReturn($view);
        $view->shouldReceive('render')->andReturn(self::STRING);
        $this->render(self::INTEGER, $view)->shouldReturn(self::STRING);
    }
}

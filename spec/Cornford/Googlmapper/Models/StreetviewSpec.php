<?php namespace spec\Cornford\Googlmapper\Models;

use Cornford\Googlmapper\Models\Map;
use PhpSpec\ObjectBehavior;
use Mockery;
use Illuminate\View\Factory;

class StreetviewSpec extends ObjectBehavior
{

	const STRING = 'test';
	const INTEGER = 10;

	public function let()
	{
		$this->beConstructedWith();
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType('Cornford\Googlmapper\Models\Streetview');
	}

	public function it_can_render_a_maker()
	{
		$view = Mockery::mock('Illuminate\View\Factory');
		$view->shouldReceive('make')->andReturn($view);
		$view->shouldReceive('withOptions')->andReturn($view);
		$view->shouldReceive('withId')->andReturn($view);
		$view->shouldReceive('withView')->andReturn($view);
		$view->shouldReceive('render')->andReturn(self::STRING);
		$this->render(self::INTEGER, $view)->shouldReturn(self::STRING);
	}

}

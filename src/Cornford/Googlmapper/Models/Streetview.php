<?php namespace Cornford\Googlmapper\Models;

use Cornford\Googlmapper\Contracts\ModelingInterface;

use Illuminate\View\Factory as View;

class Streetview implements ModelingInterface {

	/**
	 * Options.
	 *
	 * @var array
	 */
	protected $options = [];

	/**
	 * Public constructor.
	 *
	 * @param array $parameters
	 */
	public function __construct(array $parameters = [])
	{
		$this->options['latitude'] = isset($parameters['latitude']) ? $parameters['latitude'] : null;
		$this->options['longitude'] = isset($parameters['longitude']) ? $parameters['longitude'] : null;
		$this->options['user'] = isset($parameters['user']) ? $parameters['user'] : null;
		$this->options['marker'] = isset($parameters['marker']) ? $parameters['marker'] : null;
		$this->options['center'] = isset($parameters['center']) ? $parameters['center'] : null;
		$this->options['ui'] = isset($parameters['ui']) ? $parameters['ui'] : null;
		$this->options['zoom'] = isset($parameters['zoom']) ? $parameters['zoom'] : null;
		$this->options['type'] = isset($parameters['type']) ? $parameters['type'] : null;
		$this->options['tilt'] = isset($parameters['tilt']) ? $parameters['tilt'] : null;
		$this->options['heading'] = isset($parameters['heading']) ? $parameters['heading'] : null;
		$this->options['pitch'] = isset($parameters['pitch']) ? $parameters['pitch'] : null;
	}

	/**
	 * Render the model item.
	 *
	 * @param integer $identifier
	 * @param View    $view
	 *
	 * @return string
	 */
	public function render($identifier, View $view)
	{
		return $view->make('googlmapper::streetview')
			->withOptions($this->options)
			->withId($identifier)
			->withView($view)
			->render();
	}

}
 
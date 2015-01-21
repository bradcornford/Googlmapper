<?php namespace Cornford\Googlmapper\Models;

use Cornford\Googlmapper\Contracts\ModelingInterface;
use Illuminate\View\Factory as View;

class Polyline implements ModelingInterface {

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
		$this->options['map'] = isset($parameters['shapes']['map']) ? $parameters['shapes']['map'] : null;
		$this->options['coordinates'] = isset($parameters['coordinates']) ? $parameters['coordinates'] : null;
		$this->options['geodesic'] = isset($parameters['geodesic']) ? $parameters['geodesic'] : null;
		$this->options['strokeColor'] = isset($parameters['strokeColor']) ? $parameters['strokeColor'] : null;
		$this->options['strokeOpacity'] = isset($parameters['strokeOpacity']) ? $parameters['strokeOpacity'] : null;
		$this->options['strokeWeight'] = isset($parameters['strokeWeight']) ? $parameters['strokeWeight'] : null;
		$this->options['editable'] = isset($parameters['editable']) ? $parameters['editable'] : null;
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
		return $view->make('googlmapper::polyline')
			->withOptions($this->options)
			->withId($identifier)
			->render();
	}

}

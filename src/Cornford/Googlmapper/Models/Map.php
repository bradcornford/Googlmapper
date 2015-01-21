<?php namespace Cornford\Googlmapper\Models;

use Cornford\Googlmapper\Contracts\ModelingInterface;
use Illuminate\View\Factory as View;

class Map implements ModelingInterface {

	/**
	 * Options.
	 *
	 * @var array
	 */
	protected $options = [];

	/**
	 * Markers.
	 *
	 * @var array
	 */
	protected $markers = [];

	/**
	 * Shapes.
	 *
	 * @var array
	 */
	protected $shapes = [];

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
		$this->options['overlay'] = isset($parameters['overlay']) ? $parameters['overlay'] : null;
		$this->options['markers']['title'] = isset($parameters['markers']['title']) ? $parameters['markers']['title'] : null;
		$this->options['markers']['map'] = isset($parameters['map']) ? $parameters['map'] : null;
		$this->options['markers']['content'] = isset($parameters['markers']['content']) ? $parameters['markers']['content'] : null;
		$this->options['markers']['icon'] = isset($parameters['markers']['icon']) ? $parameters['markers']['icon'] : null;
		$this->options['markers']['place'] = isset($parameters['markers']['place']) ? $parameters['markers']['place'] : null;
		$this->options['markers']['animation'] = isset($parameters['markers']['animation']) ? $parameters['markers']['animation'] : null;
		$this->options['markers']['symbol'] = isset($parameters['markers']['symbol']) ? $parameters['markers']['symbol'] : null;
		$this->options['markers']['scale'] = isset($parameters['markers']['scale']) ? $parameters['markers']['scale'] : null;
		$this->options['shapes']['map'] = isset($parameters['map']) ? $parameters['map'] : null;

		if (isset($this->options['marker']) && $this->options['marker']) {
			$this->marker($this->options['latitude'], $this->options['longitude'], $this->options);
		}
	}

	/**
	 * Add a map marker to the markers bag.
	 *
	 * @param float $latitude
	 * @param float $longitude
	 * @param array $options
	 *
	 * @return void
	 */
	public function marker($latitude, $longitude, array $options = [])
	{
		$parameters = [
			'latitude' => $latitude,
			'longitude' => $longitude,
		];

		$parameters = array_replace_recursive(
			$this->options,
			$parameters,
			$options
		);

		$this->markers[] = new Marker($parameters);
	}

	/**
	 * Add a map shape to the shapes bag.
	 *
	 * @param string $type
	 * @param array  $coordinates
	 * @param array  $options
	 *
	 * @return void
	 */
	public function shape($type, $coordinates, array $options = [])
	{
		$parameters = [
			'coordinates' => $coordinates
		];

		$parameters = array_replace_recursive(
			$this->options,
			$parameters,
			$options
		);

		switch ($type) {
			case 'polyline':
				$this->shapes[] = new Polyline($parameters);
				break;
			case 'polygon':
				$this->shapes[] = new Polygon($parameters);
				break;
			case 'rectangle':
				$this->shapes[] = new Rectangle($parameters);
				break;
			case 'circle':
				$this->shapes[] = new Circle($parameters);
				break;
		}

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
		$options = $this->options;
		$options['markers'] = $this->getMarkers();
		$options['shapes'] = $this->getShapes();

		return $view->make('googlmapper::map')
			->withOptions($options)
			->withId($identifier)
			->withView($view)
			->render();
	}

	/**
	 * Return marker items.
	 *
	 * @return array
	 */
	public function getMarkers()
	{
		return $this->markers;
	}

	/**
	 * Return shape items.
	 *
	 * @return array
	 */
	public function getShapes()
	{
		return $this->shapes;
	}

}

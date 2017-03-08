<?php namespace Cornford\Googlmapper;

use Cornford\Googlmapper\Contracts\MappingInterface;
use Cornford\Googlmapper\Exceptions\MapperArgumentException;
use Cornford\Googlmapper\Exceptions\MapperException;
use Cornford\Googlmapper\Exceptions\MapperSearchException;
use Cornford\Googlmapper\Exceptions\MapperSearchKeyException;
use Cornford\Googlmapper\Exceptions\MapperSearchLimitException;
use Cornford\Googlmapper\Exceptions\MapperSearchResponseException;
use Cornford\Googlmapper\Exceptions\MapperSearchResultException;
use Cornford\Googlmapper\Models\Location;
use Cornford\Googlmapper\Models\Map;
use Cornford\Googlmapper\Models\Streetview;
use Exception;

class Mapper extends MapperBase implements MappingInterface {

	const GOOGLE_RESPONSE_OK = 'OK';
	const GOOGLE_RESPONSE_ZERO_RESULTS = 'ZERO_RESULTS';
	const GOOGLE_RESPONSE_QUERY_LIMIT = 'OVER_QUERY_LIMIT';
	const GOOGLE_RESPONSE_DENIED = 'REQUEST_DENIED';
	const GOOGLE_RESPONSE_INVALID = 'INVALID_REQUEST';
	const GOOGLE_RESPONSE_UNKNOWN = 'UNKNOWN_ERROR';

	/**
	 * Renders and returns Google Map code.
	 *
	 * @param integer $item
	 *
	 * @return string
	 */
	public function render($item = -1)
	{
		if (!$this->isEnabled()) {
			return;
		}

		return $this->view->make('googlmapper::mapper')
			->withView($this->view)
			->withOptions($this->generateRenderOptions($item))
			->withItems($item > -1 ? [$item => $this->getItem($item)] : $this->getItems())
			->render();
	}

	/**
	 * Renders and returns Google Map javascript code.
	 *
	 * @return string
	 */
	public function renderJavascript()
	{
		if (!$this->isEnabled()) {
			return;
		}

		return $this->view->make('googlmapper::javascript')
			->withView($this->view)
			->withOptions($this->generateRenderOptions())
			->render();
	}

	/**
	 * Generates the render options for Google Map.
	 *
	 * @param integer $item
	 *
	 * @return string
	 */
	protected function generateRenderOptions($item = -1)
	{
		$options = $this->getOptions();

		foreach (($item > -1 ? [$this->getItem($item)] : $this->getItems()) as $model) {
			foreach ($model->getOptions() as $key => $option) {
				if (array_key_exists($key, $this->getOptions()) && $this->getOptions()[$key] !== $option) {
					$options[$key] = $option;
				}
			}
		}

		return $options;
	}

	/**
	 * Search for a location against Google Maps Api.
	 *
	 * @param string $location
	 *
	 * @return mixed
	 */
	protected function searchLocation($location)
	{
		$request = file_get_contents(
			sprintf(
				'https://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false&key=%s',
				urlencode($location),
				$this->getKey()
			)
		);

		return json_decode($request);
	}

	/**
	 * Locate a location and return a Location instance.
	 *
	 * @param string $location
	 *
	 * @throws MapperArgumentException
	 * @throws MapperSearchException
	 * @throws MapperSearchResponseException
	 * @throws MapperSearchResultException
	 * @throws MapperSearchKeyException
	 * @throws MapperSearchLimitException
	 * @throws MapperException
	 *
	 * @return Location
	 */
	public function location($location)
	{
		if (empty($location)) {
			throw new MapperArgumentException('Invalid location search term provided.');
		}

		try {
			$resultObject = $this->searchLocation($location);
		} catch (Exception $exception) {
			throw new MapperSearchException('Unable to perform location search, the error was: "' . $exception->getMessage() .  '".');
		}

		if (isset($resultObject->status) &&
			$resultObject->status == self::GOOGLE_RESPONSE_DENIED &&
			property_exists($resultObject, 'error_message') &&
			$resultObject->error_message == 'The provided API key is invalid.'
		) {
			throw new MapperSearchKeyException('Unable to perform location search, provided API key is invalid.');
		}

		if (isset($resultObject->status) && $resultObject->status == self::GOOGLE_RESPONSE_QUERY_LIMIT) {
			throw new MapperSearchLimitException('Unable to perform location search, your API key is over your quota.');
		}

		if (isset($resultObject->status) &&
			in_array(
				$resultObject->status,
				[
					self::GOOGLE_RESPONSE_DENIED,
					self::GOOGLE_RESPONSE_INVALID,
					self::GOOGLE_RESPONSE_UNKNOWN
				]
			)
		) {
			throw new MapperSearchResponseException('An error occurred performing the location search, the error was: "' . (property_exists($resultObject, 'error_message') ? $resultObject->error_message : 'Unknown') .  '".');
		}

		if ((isset($resultObject->status) && $resultObject->status == self::GOOGLE_RESPONSE_ZERO_RESULTS) ||
			!isset($resultObject->results) ||
			(isset($resultObject->results) && count($resultObject->results) == 0)
		) {
			throw new MapperSearchResultException('No results found for the location search.');
		}

		if (!isset($resultObject->results[0]->formatted_address) ||
			!isset($resultObject->results[0]->address_components[0]->types[0]) ||
			!isset($resultObject->results[0]->geometry->location->lat) ||
			!isset($resultObject->results[0]->geometry->location->lng) ||
			!isset($resultObject->results[0]->place_id) ||
			isset($resultObject->status) && $resultObject->status != self::GOOGLE_RESPONSE_OK
		) {
			throw new MapperException('The location search return invalid result data.');
		}

		return new Location([
			'mapper'    => $this,
			'search'    => $location,
			'address'   => $resultObject->results[0]->formatted_address,
			'type'      => $resultObject->results[0]->address_components[0]->types[0],
			'latitude'  => $resultObject->results[0]->geometry->location->lat,
			'longitude' => $resultObject->results[0]->geometry->location->lng,
			'placeId'   => $resultObject->results[0]->place_id,
		]);
	}

	/**
	 * Add a new map.
	 *
	 * @param float $latitude
	 * @param float $longitude
	 * @param array $options
	 *
	 * @return self
	 */
	public function map($latitude, $longitude, array $options = [])
	{
		$parameters = array_replace_recursive(
			$this->getOptions(),
			[
				'latitude' => $latitude,
				'longitude' => $longitude,
				'map' => 'map_' . count($this->getItems())
			],
			$options
		);

		$item = new Map($parameters);
		$this->addItem($item);

		return $this;
	}

	/**
	 * Add a new street view map.
	 *
	 * @param float   $latitude
	 * @param float   $longitude
	 * @param integer $heading
	 * @param integer $pitch
	 * @param array   $options
	 *
	 * @return self
	 */
	public function streetview($latitude, $longitude, $heading, $pitch, array $options = [])
	{
		$parameters = array_replace_recursive(
			$this->getOptions(),
			[
				'latitude' => $latitude,
				'longitude' => $longitude,
				'heading' => $heading,
				'pitch' => $pitch,
				'map' => 'map_' . count($this->getItems())
			],
			$options
		);

		$item = new Streetview($parameters);
		$this->addItem($item);

		return $this;
	}

	/**
	 * Add a new map marker.
	 *
	 * @param float $latitude
	 * @param float $longitude
	 * @param array $options
	 *
	 * @throws MapperException
	 *
	 * @return self
	 */
	public function marker($latitude, $longitude, array $options = [])
	{
		$items = $this->getItems();

		if (empty($items)) {
			throw new MapperException('No map found to add a marker to.');
		}
        $item = end($items);
        $parameters = $this->getOptions();
		$options = array_replace_recursive(
			['user' => $parameters['user']],
			['markers' => $parameters['markers']],
			$item->getOptions()['markers'],
			$options
		);

		$item->marker($latitude, $longitude, $options);

		return $this;
	}

	/**
	 * Add a new map information window.
	 *
	 * @param float  $latitude
	 * @param float  $longitude
	 * @param string $content
	 * @param array  $options
	 *
	 * @throws MapperException
	 *
	 * @return self
	 */
	public function informationWindow($latitude, $longitude, $content = '', array $options = [])
	{
		$items = $this->getItems();

		if (empty($items)) {
			throw new MapperException('No map found to add a information window to.');
		}

		$item = end($items);

		$parameters = $this->getOptions();
		$options = array_replace_recursive(
			['user' => $parameters['user']],
			['markers' => $parameters['markers']],
			$item->getOptions()['markers'],
			$options,
			($content !== '' ? ['markers' => ['content' => $content]] : [])
		);

		$item->marker($latitude, $longitude, $options);

		return $this;
	}

	/**
	 * Add a new map polyline.
	 *
	 * @param array $coordinates
	 * @param array $options
	 *
	 * @throws MapperException
	 *
	 * @return self
	 */
	public function polyline(array $coordinates = [], array $options = [])
	{
		$items = $this->getItems();

		if (empty($items)) {
			throw new MapperException('No map found to add a polyline to.');
		}

		$defaults = [
			'coordinates' => $coordinates,
			'geodesic' => false,
			'strokeColor' => '#FF0000',
			'strokeOpacity' => 0.8,
			'strokeWeight' => 2,
			'editable' => false
		];

		$item = end($items);
		$parameters = $this->getOptions();
		$options = array_replace_recursive(
			['user' => $parameters['user']],
			$defaults,
			['user' => $item->getOptions()['user']],
			$options
		);

		$item->shape('polyline', $coordinates, $options);

		return $this;
	}

	/**
	 * Add a new map polygon.
	 *
	 * @param array $coordinates
	 * @param array $options
	 *
	 * @throws MapperException
	 *
	 * @return self
	 */
	public function polygon(array $coordinates = [], array $options = [])
	{
		$items = $this->getItems();

		if (empty($items)) {
			throw new MapperException('No map found to add a polygon to.');
		}

		$defaults = [
			'coordinates' => $coordinates,
			'strokeColor' => '#FF0000',
			'strokeOpacity' => 0.8,
			'strokeWeight' => 2,
			'fillColor' => '#FF0000',
			'fillOpacity' => 0.35,
			'editable' => false
		];

		$item = end($items);
		$parameters = $this->getOptions();
		$options = array_replace_recursive(
			['user' => $parameters['user']],
			$defaults,
			['user' => $item->getOptions()['user']],
			$options
		);

		$item->shape('polygon', $coordinates, $options);

		return $this;
	}

	/**
	 * Add a new map rectangle.
	 *
	 * @param array $coordinates
	 * @param array $options
	 *
	 * @throws MapperException
	 *
	 * @return self
	 */
	public function rectangle(array $coordinates = [], array $options = [])
	{
		$items = $this->getItems();

		if (empty($items)) {
			throw new MapperException('No map found to add a rectangle to.');
		}

		$defaults = [
			'coordinates' => $coordinates,
			'strokeColor' => '#FF0000',
			'strokeOpacity' => 0.8,
			'strokeWeight' => 2,
			'fillColor' => '#FF0000',
			'fillOpacity' => 0.35,
			'editable' => false
		];

		$item = end($items);
		$parameters = $this->getOptions();
		$options = array_replace_recursive(
			['user' => $parameters['user']],
			$defaults,
			['user' => $item->getOptions()['user']],
			$options
		);

		$item->shape('rectangle', $coordinates, $options);

		return $this;
	}

	/**
	 * Add a new map circle.
	 *
	 * @param array $coordinates
	 * @param array $options
	 *
	 * @throws MapperException
	 *
	 * @return self
	 */
	public function circle(array $coordinates = [], array $options = [])
	{
		$items = $this->getItems();

		if (empty($items)) {
			throw new MapperException('No map found to add a circle to.');
		}

		$defaults = [
			'coordinates' => $coordinates,
			'strokeColor' => '#FF0000',
			'strokeOpacity' => 0.8,
			'strokeWeight' => 2,
			'fillColor' => '#FF0000',
			'fillOpacity' => 0.35,
			'radius' => 100000,
			'editable' => false
		];

		$item = end($items);
		$parameters = $this->getOptions();
		$options = array_replace_recursive(
			['user' => $parameters['user']],
			$defaults,
			['user' => $item->getOptions()['user']],
			$options
		);

		$item->shape('circle', $coordinates, $options);

		return $this;
	}

}

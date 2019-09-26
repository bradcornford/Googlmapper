<?php namespace Cornford\Googlmapper\Models;

use Cornford\Googlmapper\Contracts\ModelingInterface;
use Cornford\Googlmapper\Contracts\ObjectableInterface;
use Cornford\Googlmapper\Mapper;
use Illuminate\View\Factory as View;

class Location implements ObjectableInterface {

	/**
	 * Mapper instance.
	 *
	 * @var Mapper
	 */
	protected static $mapper;

	/**
	 * Search.
	 *
	 * @var string
	 */
	protected $search;

	/**
	 * Address.
	 *
	 * @var string
	 */
	protected $address;

    /**
     * Postal Code.
     *
     * @var string
     */
    protected $postalCode;

	/**
	 * Type.
	 *
	 * @var string
	 */
	protected $type;

	/**
	 * Latitude.
	 *
	 * @var float
	 */
	public $latitude;

	/**
	 * Longitude.
	 *
	 * @var float
	 */
	public $longitude;

	/**
	 * Place Id.
	 *
	 * @var string
	 */
	protected $placeId;

	/**
	 * Public constructor.
	 *
	 * @param array $parameters
	 */
	public function __construct(array $parameters = [])
	{
		$this->setMapper($parameters['mapper']);
		$this->setSearch($parameters['search']);
		$this->setAddress($parameters['address']);
        $this->setPostalCode($parameters['postalCode']);
		$this->setType($parameters['type']);
		$this->setLatitude($parameters['latitude']);
		$this->setLongitude($parameters['longitude']);
		$this->setPlaceId($parameters['placeId']);
	}

	/**
	 * Get the mapper instance.
	 *
	 * @return Mapper
	 */
	protected function getMapper()
	{
		return self::$mapper;
	}

	/**
	 * Set the mapper instance.
	 *
	 * @param Mapper $mapper
	 *
	 * @return void
	 */
	protected function setMapper(Mapper $mapper)
	{
		self::$mapper = $mapper;
	}

	/**
	 * Get the locations search.
	 *
	 * @return string
	 */
	public function getSearch()
	{
		return $this->search;
	}

	/**
	 * Set the locations search.
	 *
	 * @param string $search
	 *
	 * @return void
	 */
	protected function setSearch($search)
	{
		$this->search = $search;
	}

	/**
	 * Get the locations address.
	 *
	 * @return string
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * Set the locations address.
	 *
	 * @param string $address
	 *
	 * @return void
	 */
	protected function setAddress($address)
	{
		$this->address = $address;
	}

    /**
     * Get the locations postal code.
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set the locations postal code.
     *
     * @param string $postalCode
     *
     * @return void
     */
    protected function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

	/**
	 * Get the locations type.
	 *
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Set the locations type.
	 *
	 * @param string $type
	 *
	 * @return void
	 */
	protected function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * Get the locations latitude.
	 *
	 * @return float
	 */
	public function getLatitude()
	{
		return $this->latitude;
	}

	/**
	 * Set the locations latitude.
	 *
	 * @param float $latitude
	 *
	 * @return void
	 */
	protected function setLatitude($latitude)
	{
		$this->latitude = $latitude;
	}

	/**
	 * Get the locations longitude.
	 *
	 * @return float
	 */
	public function getLongitude()
	{
		return $this->longitude;
	}

	/**
	 * Set the locations longitude.
	 *
	 * @param float $longitude
	 *
	 * @return void
	 */
	protected function setLongitude($longitude)
	{
		$this->longitude = $longitude;
	}

	/**
	 * Get the place id.
	 *
	 * @return string
	 *
	 * @return string
	 */
	public function getPlaceId()
	{
		return $this->placeId;
	}

	/**
	 * Set the place id.
	 *
	 * @param string $placeId
	 *
	 * @return void
	 */
	protected function setPlaceId($placeId)
	{
		$this->placeId = $placeId;
	}

	/**
	 * Create a new map from location.
	 *
	 * @param array $options
	 *
	 * @return Mapper
	 */
	public function map(array $options = [])
	{
		return self::$mapper->map($this->getLatitude(), $this->getLongitude(), $options);
	}

	/**
	 * Create a new street view map from location.
	 *
	 * @param integer $heading
	 * @param integer $pitch
	 * @param array   $options
	 *
	 * @return Mapper
	 */
	public function streetview($heading, $pitch, array $options = [])
	{
		return self::$mapper->streetview($this->getLatitude(), $this->getLongitude(), $heading, $pitch, $options);
	}

}

<?php namespace Cornford\Googlmapper;

use Cornford\Googlmapper\Contracts\MappingBaseInterface;
use Cornford\Googlmapper\Exceptions\MapperArgumentException;
use Illuminate\View\Factory as View;

abstract class MapperBase implements MappingBaseInterface
{

	const REGION = 'GB';

	const LANGUAGE = 'en-gb';

	const TYPE_ROADMAP = 'ROADMAP';
	const TYPE_SATELLITE = 'SATELLITE';
	const TYPE_HYBRID = 'HYBRID';
	const TYPE_TERRAIN = 'TERRAIN';

	const ZOOM = 8;

	const TILT = 90;

	const ANIMATION_NONE = 'NONE';
	const ANIMATION_DROP = 'DROP';
	const ANIMATION_BOUNCE = 'BOUNCE';

	const OVERLAY_NONE = 'NONE';
	const OVERLAY_BIKE = 'BIKE';
	const OVERLAY_TRANSIT = 'TRANSIT';
	const OVERLAY_TRAFFIC = 'TRAFFIC';

	const SYMBOL_CIRCLE = 'CIRCLE';
	const SYMBOL_BACKWARD_CLOSED_ARROW = 'BACKWARD_CLOSED_ARROW';
	const SYMBOL_FORWARD_CLOSED_ARROW = 'FORWARD_CLOSED_ARROW';
	const SYMBOL_BACKWARD_OPEN_ARROW = 'BACKWARD_OPEN_ARROW';
	const SYMBOL_FORWARD_OPEN_ARROW = 'FORWARD_OPEN_ARROW';

	/**
	 * View.
	 *
	 * @var \Illuminate\View\Factory
	 */
	protected $view;

	/**
	 * Mapping enabled.
	 *
	 * @var boolean
	 */
	protected $enabled;

	/**
	 * API Key.
	 *
	 * @var string
	 */
	protected $key;

	/**
	 * API Version.
	 *
	 * @var integer
	 */
	protected $version = '3.exp';

	/**
	 * API region.
	 *
	 * @var string
	 */
	protected $region;

	/**
	 * API regions.
	 *
	 * @var array
	 */
	protected $regions = [
		'AF',
		'AX',
		'AL',
		'DZ',
		'AS',
		'AD',
		'AO',
		'AI',
		'AQ',
		'AG',
		'AR',
		'AM',
		'AW',
		'AU',
		'AT',
		'AZ',
		'BS',
		'BH',
		'BD',
		'BB',
		'BY',
		'BE',
		'BZ',
		'BJ',
		'BM',
		'BT',
		'BO',
		'BQ',
		'BA',
		'BW',
		'BV',
		'BR',
		'IO',
		'BN',
		'BG',
		'BF',
		'BI',
		'KH',
		'CM',
		'CA',
		'CV',
		'KY',
		'CF',
		'TD',
		'CL',
		'CN',
		'CX',
		'CC',
		'CO',
		'KM',
		'CG',
		'CD',
		'CK',
		'CR',
		'CI',
		'HR',
		'CU',
		'CW',
		'CY',
		'CZ',
		'DK',
		'DJ',
		'DM',
		'DO',
		'EC',
		'EG',
		'SV',
		'GQ',
		'ER',
		'EE',
		'ET',
		'FK',
		'FO',
		'FJ',
		'FI',
		'FR',
		'GF',
		'PF',
		'TF',
		'GA',
		'GM',
		'GE',
		'DE',
		'GH',
		'GI',
		'GR',
		'GL',
		'GD',
		'GP',
		'GU',
		'GT',
		'GG',
		'GN',
		'GW',
		'GY',
		'HT',
		'HM',
		'VA',
		'HN',
		'HK',
		'HU',
		'IS',
		'IN',
		'ID',
		'IR',
		'IQ',
		'IE',
		'IM',
		'IL',
		'IT',
		'JM',
		'JP',
		'JE',
		'JO',
		'KZ',
		'KE',
		'KI',
		'KP',
		'KR',
		'KW',
		'KG',
		'LA',
		'LV',
		'LB',
		'LS',
		'LR',
		'LY',
		'LI',
		'LT',
		'LU',
		'MO',
		'MK',
		'MG',
		'MW',
		'MY',
		'MV',
		'ML',
		'MT',
		'MH',
		'MQ',
		'MR',
		'MU',
		'YT',
		'MX',
		'FM',
		'MD',
		'MC',
		'MN',
		'ME',
		'MS',
		'MA',
		'MZ',
		'MM',
		'NA',
		'NR',
		'NP',
		'NL',
		'NC',
		'NZ',
		'NI',
		'NE',
		'NG',
		'NU',
		'NF',
		'MP',
		'NO',
		'OM',
		'PK',
		'PW',
		'PS',
		'PA',
		'PG',
		'PY',
		'PE',
		'PH',
		'PN',
		'PL',
		'PT',
		'PR',
		'QA',
		'RE',
		'RO',
		'RU',
		'RW',
		'BL',
		'SH',
		'KN',
		'LC',
		'MF',
		'PM',
		'VC',
		'WS',
		'SM',
		'ST',
		'SA',
		'SN',
		'RS',
		'SC',
		'SL',
		'SG',
		'SX',
		'SK',
		'SI',
		'SB',
		'SO',
		'ZA',
		'GS',
		'SS',
		'ES',
		'LK',
		'SD',
		'SR',
		'SJ',
		'SZ',
		'SE',
		'CH',
		'SY',
		'TW',
		'TJ',
		'TZ',
		'TH',
		'TL',
		'TG',
		'TK',
		'TO',
		'TT',
		'TN',
		'TR',
		'TM',
		'TC',
		'TV',
		'UG',
		'UA',
		'AE',
		'GB',
		'US',
		'UM',
		'UY',
		'UZ',
		'VU',
		'VE',
		'VN',
		'VG',
		'VI',
		'WF',
		'EH',
		'YE',
		'ZM',
		'ZW'
	];

	/**
	 * API Language.
	 *
	 * @var string
	 */
	protected $language;

	/**
	 * API Languages.
	 *
	 * @var array
	 */
	protected $languages = [
		'af',
		'ar-ae',
		'ar-bh',
		'ar-dz',
		'ar-eg',
		'ar-iq',
		'ar-jo',
		'ar-kw',
		'ar-lb',
		'ar-ly',
		'ar-ma',
		'ar-om',
		'ar-qa',
		'ar-sa',
		'ar-sy',
		'ar-tn',
		'ar-ye',
		'be',
		'bg',
		'ca',
		'cs',
		'da',
		'de',
		'de-at',
		'de-ch',
		'de-li',
		'de-lu',
		'el',
		'en',
		'en-au',
		'en-bz',
		'en-ca',
		'en-gb',
		'en-ie',
		'en-jm',
		'en-nz',
		'en-tt',
		'en-us',
		'en-za',
		'es',
		'es-ar',
		'es-bo',
		'es-cl',
		'es-co',
		'es-cr',
		'es-do',
		'es-ec',
		'es-gt',
		'es-hn',
		'es-mx',
		'es-ni',
		'es-pa',
		'es-pe',
		'es-pr',
		'es-py',
		'es-sv',
		'es-uy',
		'es-ve',
		'et',
		'eu',
		'fa',
		'fi',
		'fo',
		'fr',
		'fr-be',
		'fr-ca',
		'fr-ch',
		'fr-lu',
		'ga',
		'gd',
		'he',
		'hi',
		'hr',
		'hu',
		'id',
		'is',
		'it',
		'it-ch',
		'ja',
		'ji',
		'ko',
		'ko',
		'ku',
		'lt',
		'lv',
		'mk',
		'ml',
		'ms',
		'mt',
		'nl',
		'nl-be',
		'nb',
		'nn',
		'no',
		'pa',
		'pl',
		'pt',
		'pt-br',
		'rm',
		'ro',
		'ro-md',
		'ru',
		'ru-md',
		'sb',
		'sk',
		'sl',
		'sq',
		'sr',
		'sv',
		'sv-fi',
		'th',
		'tn',
		'tr',
		'ts',
		'uk',
		'ur',
		've',
		'vi',
		'xh',
		'zh-cn',
		'zh-hk',
		'zh-sg',
		'zh-tw',
		'zu'
	];

	/**
	 * User custom maps.
	 *
	 * @var boolean
	 */
	protected $user;

	/**
	 * Automatic map marker.
	 *
	 * @var boolean
	 */
	protected $marker;

	/**
	 * Center map automatically.
	 *
	 * @var boolean
	 */
	protected $center;

	/**
	 * Show map UI.
	 *
	 * @var boolean
	 */
	protected $ui;

	/**
	 * Map zoom level.
	 *
	 * @var integer
	 */
	protected $zoom;

	/**
	 * Map type.
	 *
	 * @var string
	 */
	protected $type;

	/**
	 * Available map types.
	 *
	 * @var array
	 */
	protected $types = [
		'ROADMAP',
		'SATELLITE',
		'HYBRID',
		'TERRAIN'
	];

	/**
	 * Map tilt.
	 *
	 * @var integer
	 */
	protected $tilt;

	/**
	 * Map marker icon.
	 *
	 * @var string
	 */
	protected $icon;

	/**
	 * Map marker animation.
	 *
	 * @var string
	 */
	protected $animation;

	/**
	 * Available map marker animations.
	 *
	 * @var array
	 */
	protected $animations = [
		'NONE',
		'DROP',
		'BOUNCE',
	];

	/**
	 * Map marker cluster.
	 *
	 * @var boolean
	 */
	protected $cluster;

	/**
	 * Mapping items.
	 *
	 * @var array
	 */
	public $items = [];

	/**
	 * Construct Googlmapper.
	 *
	 * @param View  $view
	 * @param array $options
	 *
	 * @throws MapperArgumentException
	 */
	public function __construct(View $view, array $options = [])
	{
		$this->view = $view;

		if (!isset($options['key'])) {
			throw new MapperArgumentException('Google maps API key is required.');
		}

		if (!isset($options['region'])) {
			throw new MapperArgumentException('Region is required.');
		}

		if (!in_array($options['region'], $this->regions)) {
			throw new MapperArgumentException('Region is required in ISO 3166-1 code format.');
		}

		if (!isset($options['language']) || !in_array($options['language'], $this->languages)) {
			throw new MapperArgumentException('Language is required.');
		}

		if (!in_array($options['language'], $this->languages)) {
			throw new MapperArgumentException('Language is required in ISO 639-1 code format.');
		}

		$this->setEnabled(isset($options['enabled']) ? $options['enabled'] : true);
		$this->setKey($options['key']);
		$this->setRegion(isset($options['region']) ? $options['region'] : self::REGION);
		$this->setLanguage(isset($options['language']) ? $options['language'] : self::LANGUAGE);
		$this->setUser(isset($options['user']) ? $options['user'] : false);
		$this->setMarker(isset($options['marker']) ? $options['marker'] : true);
		$this->setCenter(isset($options['centre']) ? $options['centre'] : true);
		$this->setZoom(isset($options['zoom']) ? $options['zoom'] : self::ZOOM);
		$this->setType(isset($options['type']) ? $options['type'] : self::TYPE_ROADMAP);
		$this->setTilt(isset($options['tilt']) ? $options['tilt'] : self::TILT);
		$this->setUi(isset($options['ui']) ? $options['ui'] : true);
		$this->setIcon(isset($options['markers']['icon']) ? $options['markers']['icon'] : '');
		$this->setAnimation(isset($options['markers']['animation']) ? $options['markers']['animation'] : self::ANIMATION_NONE);
		$this->setCluster(isset($options['cluster']) ? $options['cluster'] : true);
	}

	/**
	 * Is mapping enabled?
	 *
	 * @return boolean
	 */
	public function isEnabled()
	{
		return $this->getEnabled();
	}

	/**
	 * Set enabled status.
	 *
	 * @param boolean $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	protected function setEnabled($value)
	{
		if (!is_bool($value)) {
			throw new MapperArgumentException('Invalid map enabled setting.');
		}

		$this->enabled = $value;
	}

	/**
	 * Get the enabled status.
	 *
	 * @return boolean
	 */
	protected function getEnabled()
	{
		return $this->enabled;
	}

	/**
	 * Enable mapping.
	 *
	 * @return void
	 */
	public function enableMapping()
	{
		$this->setEnabled(true);
	}

	/**
	 * Disable mapping.
	 *
	 * @return void
	 */
	public function disableMapping()
	{
		$this->setEnabled(false);
	}

	/**
	 * Set the Google Maps key.
	 *
	 * @param string $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setKey($value)
	{
		if (!is_string($value)) {
			throw new MapperArgumentException('Invalid Google Map\'s API key.');
		}

		$this->key = $value;
	}

	/**
	 * Get the Google Maps key.
	 *
	 * @return string
	 */
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * Set the Google Maps region.
	 *
	 * @param string $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setRegion($value)
	{
		if (!is_string($value)) {
			throw new MapperArgumentException('Invalid map region.');
		}

		if (!in_array($value, $this->regions)) {
			throw new MapperArgumentException('Region is required in ISO 3166-1 code format.');
		}

		$this->region = $value;
	}

	/**
	 * Get the Google Maps region.
	 *
	 * @return string
	 */
	public function getRegion()
	{
		return $this->region;
	}

	/**
	 * Set the Google Maps language.
	 *
	 * @param string $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setLanguage($value)
	{
		if (!is_string($value)) {
			throw new MapperArgumentException('Invalid map language.');
		}

		if (!in_array($value, $this->languages)) {
			throw new MapperArgumentException('Language is required in ISO 639-1 code format.');
		}

		$this->language = $value;
	}

	/**
	 * Get the Google Maps language.
	 *
	 * @return string
	 */
	public function getLanguage()
	{
		return $this->language;
	}

	/**
	 * Set the map user status.
	 *
	 * @param boolean $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	protected function setUser($value)
	{
		if (!is_bool($value)) {
			throw new MapperArgumentException('Invalid map user status.');
		}

		$this->user = $value;
	}

	/**
	 * Get the map user status.
	 *
	 * @return boolean
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * Enable users for maps.
	 *
	 * @return void
	 */
	public function enableUsers()
	{
		$this->setUser(true);
	}

	/**
	 * Disable users for maps.
	 *
	 * @return void
	 */
	public function disableUsers()
	{
		$this->setUser(false);
	}

	/**
	 * Set the marker status.
	 *
	 * @param boolean $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	protected function setMarker($value)
	{
		if (!is_bool($value)) {
			throw new MapperArgumentException('Invalid map marker setting.');
		}

		$this->marker = $value;
	}

	/**
	 * Get the marker status.
	 *
	 * @return boolean
	 */
	public function getMarker()
	{
		return $this->marker;
	}

	/**
	 * Enable markers for maps.
	 *
	 * @return void
	 */
	public function enableMarkers()
	{
		$this->setMarker(true);
	}

	/**
	 * Disable markers for maps.
	 *
	 * @return void
	 */
	public function disableMarkers()
	{
		$this->setMarker(false);
	}

	/**
	 * Set the map center status.
	 *
	 * @param boolean $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	protected function setCenter($value)
	{
		if (!is_bool($value)) {
			throw new MapperArgumentException('Invalid map center setting.');
		}

		$this->center = $value;
	}

	/**
	 * Get the map center status.
	 *
	 * @return boolean
	 */
	public function getCenter()
	{
		return $this->center;
	}

	/**
	 * Enable center of maps.
	 *
	 * @return void
	 */
	public function enableCenter()
	{
		$this->setCenter(true);
	}

	/**
	 * Disable center of maps.
	 *
	 * @return void
	 */
	public function disableCenter()
	{
		$this->setCenter(false);
	}

	/**
	 * Set the map UI status.
	 *
	 * @param boolean $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	protected function setUi($value)
	{
		if (!is_bool($value)) {
			throw new MapperArgumentException('Invalid map ui setting.');
		}

		$this->ui = $value;
	}

	/**
	 * Get the map UI status.
	 *
	 * @return boolean
	 */
	public function getUi()
	{
		return $this->ui;
	}

	/**
	 * Enable maps ui.
	 *
	 * @return void
	 */
	public function enableUi()
	{
		$this->setUi(false);
	}

	/**
	 * Disable maps ui.
	 *
	 * @return void
	 */
	public function disableUi()
	{
		$this->setUi(true);
	}

	/**
	 * Set map zoom level.
	 *
	 * @param integer $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setZoom($value)
	{
		if (!is_numeric($value)) {
			throw new MapperArgumentException('Zoom level must be an integer.');
		}

		if ($value < 1 || $value > 20) {
			throw new MapperArgumentException('A zoom level must be between 1 and 20.');
		}

		$this->zoom = $value;
	}

	/**
	 * Get map zoom level.
	 *
	 * @return integer
	 */
	public function getZoom()
	{
		return $this->zoom;
	}

	/**
	 * Set map type.
	 *
	 * @param string $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setType($value)
	{
		if (!in_array($value, $this->types)) {
			throw new MapperArgumentException('Invalid map type.');
		}

		$this->type = $value;
	}

	/**
	 * Get map type.
	 *
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Set map tilt.
	 *
	 * @param integer|double $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setTilt($value)
	{
		if (!is_numeric($value)) {
			throw new MapperArgumentException('Invalid map tilt.');
		}

		$this->tilt = $value;
	}

	/**
	 * Get map $tilt.
	 *
	 * @return integer
	 */
	public function getTilt()
	{
		return $this->tilt;
	}

	/**
	 * Set map marker icon.
	 *
	 * @param string $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setIcon($value)
	{
		if (!is_string($value)) {
			throw new MapperArgumentException('Invalid map marker icon.');
		}

		$this->icon = $value;
	}

	/**
	 * Get map marker icon.
	 *
	 * @return string
	 */
	public function getIcon()
	{
		return $this->icon;
	}

	/**
	 * Set map marker animation.
	 *
	 * @param string $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	public function setAnimation($value)
	{
		if (!in_array($value, $this->animations)) {
			throw new MapperArgumentException('Invalid map marker animation.');
		}

		$this->animation = $value;
	}

	/**
	 * Get map marker animation.
	 *
	 * @return string
	 */
	public function getAnimation()
	{
		return $this->animation;
	}

	/**
	 * Get mapper options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			'key' => $this->getKey(),
			'version' => $this->version,
			'region' => $this->getRegion(),
			'language' => $this->getLanguage(),
			'user' => $this->getUser(),
			'marker' => $this->getMarker(),
			'center' => $this->getCenter(),
			'zoom' => $this->getZoom(),
			'type' => $this->getType(),
			'tilt' => $this->getTilt(),
			'ui' => $this->getUi(),
			'overlay' => '',
			'markers' => [
				'title' => '',
				'content' => '',
				'icon' => $this->getIcon(),
				'place' => '',
				'animation' => $this->getAnimation(),
				'symbol' => '',
			],
			'cluster' => $this->getCluster()
		];
	}

	/**
	 * Add mapping item.
	 *
	 * @param object $value
	 *
	 * @return void
	 */
	protected function addItem($value)
	{
		$this->items[] = $value;
	}

	/**
	 * Set mapping items.
	 *
	 * @param array $array
	 *
	 * @return void
	 */
	protected function setItems(array $array)
	{
		$this->items = $array;
	}

	/**
	 * Get the mapping items.
	 *
	 * @return array
	 */
	public function getItems()
	{
		return $this->items;
	}

	/**
	 * Get a mapping item by reference.
	 *
	 * @param integer $item
	 *
	 * @return array|boolean
	 */
	public function getItem($item)
	{
		return isset($this->items[$item]) ? $this->items[$item] : false;
	}

	/**
	 * Set cluster status.
	 *
	 * @param boolean $value
	 *
	 * @throws MapperArgumentException
	 *
	 * @return void
	 */
	protected function setCluster($value)
	{
		if (!is_bool($value)) {
			throw new MapperArgumentException('Invalid map cluster setting.');
		}

		$this->cluster = $value;
	}

	/**
	 * Get the cluster status.
	 *
	 * @return boolean
	 */
	protected function getCluster()
	{
		return $this->cluster;
	}

	/**
	 * Enable cluster.
	 *
	 * @return void
	 */
	public function enableCluster()
	{
		$this->setCluster(true);
	}

	/**
	 * Disable cluster.
	 *
	 * @return void
	 */
	public function disableCluster()
	{
		$this->setCluster(false);
	}

}
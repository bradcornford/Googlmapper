<?php namespace Cornford\Googlmapper\Contracts;

use Illuminate\View\Factory as View;

interface ObjectableInterface {

	/**
	 * Public constructor.
	 *
	 * @param array $parameters
	 */
	public function __construct(array $parameters = array());

}
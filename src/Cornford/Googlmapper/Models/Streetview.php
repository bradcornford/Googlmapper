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
		$this->options = $parameters;
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

	/**
	 * Get the model options.
	 *
	 * @return array
	 */
	public function getOptions()
	{
		return $this->options;
	}

}
 
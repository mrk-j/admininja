<?php namespace Mrkj\Admininja;

class Admininja {

	protected $namespace = null;

	protected $model = null;

	protected $instance = null;

	public function __construct($namespace, $model)
	{
		$this->namespace = $namespace;
		$this->model = $this->namespace . '\\' . $model;
		$this->instance = new $this->model;
	}

	/**
	 * @return Admininjable
	 */
	public function getInstance()
	{
		return $this->instance;
	}

}

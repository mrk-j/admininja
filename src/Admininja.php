<?php namespace Mrkj\Admininja;

use Illuminate\Support\Facades\Config;

class Admininja {

	protected $model = null;

	protected $instance = null;

	public function __construct($model)
	{
		$this->model = Config::get('admininja.model_namespace') . '\\' . $model;

		$this->instance = new $this->model;
	}

	public function getInstance()
	{
		return $this->instance;
	}

}

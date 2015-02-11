<?php namespace Mrkj\Admininja\Http\Controllers;

use Illuminate\Routing\Controller;
use Mrkj\Admininja\Admininja;

class ModelController extends Controller {

	public function index($model)
	{
		$admin = new Admininja($this->getModelClassName($model));
	}

	protected function getModelClassName($routeModelName)
	{
		return ucfirst(camel_case($routeModelName));
	}

}

<?php namespace Mrkj\Admininja\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Mrkj\Admininja\Admininja;

class ModelController extends Controller {

	public function index($modelName)
	{
		$admin = new Admininja(Config::get('admininja.model_namespace'), $this->getModelClassName($modelName));

		$model = $admin->getInstance();

		$config = $model->getAdmininjaConfig();

		$title = $config['title'];

		$columns = [];

		$fields = [];

		foreach($config['columns'] as $column)
		{
			if(is_array($column))
			{

			}
			else
			{
				$columns[] = ucfirst($column);
				$fields[] = $column;
			}
		}

		$rows = $model->all($fields);

		return view('admininja::model.index', compact('modelName', 'title', 'columns', 'rows', 'fields'));
	}

	public function create($modelName)
	{
		$admin = new Admininja(Config::get('admininja.model_namespace'), $this->getModelClassName($modelName));

		$model = $admin->getInstance();

		$config = $model->getAdmininjaConfig();

		$title = $config['title'];

		$fields = [];

		foreach($config['edit_fields'] as $field => $options)
		{
			if(is_array($options))
			{
				$fields[$field] = $options;
			}
			else
			{
				$fields[] = $field;
			}
		}

		return view('admininja::model.create_edit', compact('modelName', 'title', 'fields'));
	}

	public function store($modelName)
	{
		$admin = new Admininja(Config::get('admininja.model_namespace'), $this->getModelClassName($modelName));

		$model = $admin->getInstance();

		$config = $model->getAdmininjaConfig();

		$object = $model->create(Input::all());

		return redirect(route('admininja.model.index', ['model' => $modelName]));
	}

	public function edit($modelName, $id)
	{
		$admin = new Admininja(Config::get('admininja.model_namespace'), $this->getModelClassName($modelName));

		$model = $admin->getInstance();

		$config = $model->getAdmininjaConfig();

		$title = $config['title'];

		$object = $model->findOrFail($id);

		$fields = [];

		foreach($config['edit_fields'] as $field => $options)
		{
			if(is_array($options))
			{
				$fields[$field] = $options;
			}
			else
			{
				$fields[] = $field;
			}
		}

		return view('admininja::model.create_edit', compact('modelName', 'title', 'object', 'fields'));
	}

	public function update($modelName, $id)
	{
		$admin = new Admininja(Config::get('admininja.model_namespace'), $this->getModelClassName($modelName));

		$model = $admin->getInstance();

		$config = $model->getAdmininjaConfig();

		$object = $model->findOrFail($id)->update(Input::all());

		return redirect(route('admininja.model.index', ['model' => $modelName]));
	}

	public function destroy($modelName, $id)
	{
		$admin = new Admininja(Config::get('admininja.model_namespace'), $this->getModelClassName($modelName));

		$model = $admin->getInstance();

		$config = $model->getAdmininjaConfig();

		$object = $model->findOrFail($id)->delete();

		return redirect(route('admininja.model.index', ['model' => $modelName]));
	}

	protected function getModelClassName($routeModelName)
	{
		return ucfirst(camel_case($routeModelName));
	}

}

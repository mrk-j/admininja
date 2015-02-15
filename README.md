[![Build Status](https://travis-ci.org/mrk-j/admininja.svg?branch=master)](https://travis-ci.org/mrk-j/admininja)
<img align="right" src="https://cloud.githubusercontent.com/assets/1250622/6046044/ed8e5746-ac9e-11e4-9672-7d16d5c0ff5c.png" alt="admininja" />

Welcome to admininja
===

I use `admininja` as my sideproject to learn more about Laravel 5 and package development. You are always welcome to contribute to my journey. Feel free to point out mistakes or ask questions.

Work in progress
===

This is my current task list:

- [x] Add basic config and publish command for assets
- [x] Create simple GUI
- [x] CRUD for basic Eloquent model
- [ ] Manage relationships

Installation
===

This package is under construction and not available through Packagist yet. You can download the source follow the steps below:

1. Unzip the package in your vendor directory manually in the folder `mrkj/admininja`.
2. Add the following line to the PSR-4 autoloading section in the `composer.json` file of your project: `"Mrkj\\Admininja\\": "vendor/mrkj/admininja/src/"`.
3. Add the service provider to `config/app.php`: `'Mrkj\Admininja\AdmininjaServiceProvider'`.
4. Run `php artisan vendor:publish` to publish the config.
5. Run `php artisan admininja:publish` to publish the assets to your public directory.

Update your model to support `admininja`
===

To use `admininja` with your `Eloquent` model you can use this snippet:

``` php
<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Mrkj\Admininja\Traits\Admininjable as Admininjable;

class Post extends Model {

	use Admininjable;

	/**
	 * Holds the admininja config for this Eloquent model
	 * @var array
	 */
	protected $admininjaConfig = [
		'title' => 'Posts',
		'columns' => [
			'id',
			'title',
		],
		'edit_fields' => [
			'title' => [
				'type' => 'text',
			],
			'content' => [
				'type' => 'text',
			],
		]
	];

	protected $fillable = array('title', 'content');

}
```

What will `admininja` become?
===

* Easy to integrate
* Provide an easy CRUD interface for your existing models and relations
* Looks based on Twitter Bootstrap
* Tests with PHPUnit
* Much more!

License
===

This package is available under the [MIT license](https://github.com/mrk-j/blob/master/LICENSE).

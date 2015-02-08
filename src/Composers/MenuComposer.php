<?php namespace Mrkj\Admininja\Composers;

use Illuminate\Contracts\View\View;

class MenuComposer {

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose($view)
	{
		$view->with('menu', ['Users', 'Posts']);
	}

}

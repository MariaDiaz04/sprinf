<?php

namespace App\middlewares;

use Controllers\controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class logged_in extends controller
{

	public $CONTROLLER;

	function __construct()
	{
		$this->CONTROLLER = new controller();
	}

	public function logged_in()
	{

		if (isset($_SESSION['token'])) {
			return  new RedirectResponse('/' . $_ENV['HOME']);

			exit();
		}
	}
}

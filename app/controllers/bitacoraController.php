<?php

use Model\bitacora;
use Controllers\controller;

class bitacoraController extends controller
{
	public $BITACORA;

	function __construct () {	
		$this->tokenExist();
		$this->BITACORA = new bitacora();
	}

	public function index()
	{

		$bitacora = $this->BITACORA->bitacora_all();

		return $this->view('security/bitacora', ['bitacora' => $bitacora]);
	}
}

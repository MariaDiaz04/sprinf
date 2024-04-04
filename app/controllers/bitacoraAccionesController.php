<?php

namespace Controllers;
use Model\bitacoraAcciones;


class bitacoraAccionesController extends controller
{
	public $BITACORAACCIONES;

	function __construct () {	
		$this->tokenExist();
		$this->BITACORAACCIONES = new bitacoraAcciones();
	}

	public function index()
	{
		$bitacora_acciones = $this->BITACORAACCIONES->bitacoraAcciones_all();
		return $this->view('security/bitacoraAcciones', ['bitacora_acciones' => $bitacora_acciones]);
	}

	

}

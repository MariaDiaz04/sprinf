<?php
namespace App\controllers;

use App\proyecto;

class proyectoController extends controller{

    private $proyecto;

    function __construct() {
        $this->proyecto = new proyecto();
    }

    public function index() {      

        $proyectos = $this->proyecto->all();

        return $this->view('proyectos/gestionar', ['proyectos'=>$proyectos]);
    }

    public function E501() {
    	
    	return $this->page('errors/501');
    }

}
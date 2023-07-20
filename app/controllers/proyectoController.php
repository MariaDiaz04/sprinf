<?php
namespace App\controllers;

use App\proyecto;
use App\estudiante;

class proyectoController extends controller{

    private $proyecto;
    private $estudiantes;

    function __construct() {
        $this->proyecto = new proyecto();
        $this->estudiantes = new estudiante();
    }

    public function index() {      

        $proyectos = $this->proyecto->all();

        $estudiantes = $this->estudiantes->listPendingForProject();


        return $this->view('proyectos/gestionar', ['proyectos'=>$proyectos]);
    }

    public function E501() {
    	
    	return $this->page('errors/501');
    }

}
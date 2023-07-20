<?php
namespace App\controllers;

use App\proyecto;
use App\estudiante;
use App\tutor;

class proyectoController extends controller{

    private $proyecto;
    private $estudiantes;
    private $tutores;

    function __construct() {
        $this->proyecto = new proyecto();
        $this->estudiantes = new estudiante();
        $this->tutores = new tutor();
    }

    public function index() {      

        $proyectos = $this->proyecto->all();

        $tutores = $this->tutores->all();

        $estudiantes = $this->estudiantes->listPendingForProject();


        return $this->view('proyectos/gestionar', [
            'proyectos'=>$proyectos,
            'estudiantes'=>$estudiantes,
            'tutores'=>$tutores
        ]);
    }

    public function E501() {
    	
    	return $this->page('errors/501');
    }

}
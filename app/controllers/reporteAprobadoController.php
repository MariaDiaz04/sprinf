<?php

namespace Controllers;
use Model\usuario;
use Model\proyecto;



class reporteAprobadoController extends controller
{
    public $USUARIO;
    public $PROYECTO;


	function __construct () {	
        $this->tokenExist();
        $this->USUARIO = new usuario();
        $this->PROYECTO = new proyecto();
	}

    public function index()
    {

        $Aprobados = $this->PROYECTO->findActive();
        $Desaprobados = $this->PROYECTO->findDesaprobados();


        return $this->view('reportesn/reporte_aprobado', [
             'Aprobados' => $Aprobados["COUNT(*)"], 'Desaprobados' => $Desaprobados["COUNT(*)"]
        ]);
    }

}

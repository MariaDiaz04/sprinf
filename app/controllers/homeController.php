<?php

namespace Controllers;

use Model\usuario;
use Model\proyecto;
use Model\bitacoraAcciones;


class homeController extends controller
{


    public $USUARIO;
    public $PROYECTO;
    public $ACCIONES;



    function __construct()
    {
        $this->tokenExist();
        $this->USUARIO = new usuario();
        $this->PROYECTO = new proyecto();
        $this->ACCIONES = new bitacoraAcciones();

    }
    public function index()
    {

        $usuarios = count($this->USUARIO->all());
        $activos = count($this->USUARIO->users_activos());
        $inactivos = count($this->USUARIO->users_inactivos());
        $proyectosMunicipios = $this->PROYECTO->findByMunicipios();
        $Aprobados = $this->PROYECTO->findActive();
        $Desaprobados = $this->PROYECTO->findDesaprobados();


        $Crespo = $proyectosMunicipios['Crespo'];
        $Iribarren = $proyectosMunicipios['Iribarren'];
        $Jimenez = $proyectosMunicipios['Jimenez'];
        $Moran = $proyectosMunicipios['Moran'];
        $Palavecino = $proyectosMunicipios['Palavecino'];
        $SimonPlanas = $proyectosMunicipios['SimonPlanas'];
        $Torres = $proyectosMunicipios['Torres'];
        $Urdaneta = $proyectosMunicipios['Urdaneta'];

        $this->ACCIONES->lastSave($this->modulo_inicio,$this->accion_consultar);

        return $this->view('home/home', [
            'usuarios' => $usuarios, 'activos' => $activos, 'inactivos' => $inactivos,
            'Crespo' => $Crespo, 'Iribarren' => $Iribarren, 'Jimenez' => $Jimenez, 'Moran' => $Moran, 'Palavecino' => $Palavecino,
            'SimonPlanas' => $SimonPlanas, 'Torres' => $Torres, 'Urdaneta' => $Urdaneta, 'Aprobados' => $Aprobados["COUNT(*)"], 'Desaprobados' => $Desaprobados["COUNT(*)"]
        ]);
    }

    public function E501()
    {

        return $this->page('errors/501');
    }
}

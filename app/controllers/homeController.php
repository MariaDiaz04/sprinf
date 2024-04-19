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

        $this->ACCIONES->lastSave($this->modulo_inicio,$this->accion_consultar);

        return $this->view('home/home', [
            'usuarios' => $usuarios, 'activos' => $activos, 'inactivos' => $inactivos,
        ]);
    }

    public function E501()
    {

        return $this->page('errors/501');
    }
}

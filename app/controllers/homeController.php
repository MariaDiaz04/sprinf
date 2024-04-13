<?php

namespace Controllers;

use Model\usuario;
use Model\proyecto;


class homeController extends controller
{


    public $USUARIO;
    public $PROYECTO;



    function __construct()
    {
        $this->tokenExist();
        $this->USUARIO = new usuario();
        $this->PROYECTO = new proyecto();
    }
    public function index()
    {

        $usuarios = count($this->USUARIO->all());
        $activos = count($this->USUARIO->users_activos());
        $inactivos = count($this->USUARIO->users_inactivos());

        return $this->view('home/home', [
            'usuarios' => $usuarios, 'activos' => $activos, 'inactivos' => $inactivos,
        ]);
    }

    public function E501()
    {

        return $this->page('errors/501');
    }
}

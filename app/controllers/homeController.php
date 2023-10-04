<?php

namespace Controllers;

use Model\usuario;


class homeController extends controller
{


    public $USUARIO;



    function __construct()
    {

        $this->USUARIO = new usuario();
    }
    public function index()
    {

        $usuarios = count($this->USUARIO->all());
        $activos = count($this->USUARIO->users_activos());
        $inactivos = count($this->USUARIO->users_inactivos());


        return $this->view('home/home', ['usuarios' => $usuarios, 'activos' => $activos, 'inactivos' => $inactivos]);
    }

    public function E501()
    {

        return $this->page('errors/501');
    }
}

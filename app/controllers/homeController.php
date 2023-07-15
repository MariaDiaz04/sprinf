<?php
namespace App\controllers;

use App\usuario;


class homeController extends controller{


    public $USUARIO;
 
  

    function __construct()
    {

        $this->USUARIO = new usuario();
     
      
    }
    public function index() {

        $usuarios = count($this->USUARIO->all());
      
        return $this->view('home/home', ['usuarios'=>$usuarios]);
    }

    public function E501() {
    	
    	return $this->page('errors/501');
    }

}
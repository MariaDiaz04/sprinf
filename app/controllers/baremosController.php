<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use App\baremos;
use App\estudiante;
use App\tutor;
use App\trayectos;
use Exception;

class baremosController extends controller
{

  public $baremos;

  function __construct()
  {
    $this->baremos = new baremos();
  }

  public function index()
  {

    $baremos = $this->baremos->all();




    return $this->view('baremos/gestionar', [
      'baremos' => $baremos,
    ]);
  }


  public function E501()
  {

    return $this->page('errors/501');
  }
}

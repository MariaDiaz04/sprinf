<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use App\baremos;
use App\dimension;
use App\estudiante;
use App\tutor;
use App\trayectos;
use Exception;

class dimensionController extends controller
{

  public $baremos;
  public $trayectos;
  public $dimension;

  function __construct()
  {
    $this->baremos = new baremos();
    $this->dimension = new dimension();
    $this->trayectos = new trayectos();
  }

  public function index()
  {
    $dimensiones = $this->dimension->all();

    return $this->view('dimensiones/gestionar', [
      'dimensiones' => $dimensiones,
    ]);
  }


  public function E501()
  {

    return $this->page('errors/501');
  }
}

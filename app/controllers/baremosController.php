<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use App\baremos;
use App\materias;
use App\estudiante;
use App\tutor;
use App\trayectos;
use Exception;

class baremosController extends controller
{

  public $baremos;
  public $trayectos;
  public $materias;

  function __construct()
  {
    $this->baremos = new baremos();
    $this->materias = new materias();
    $this->trayectos = new trayectos();
  }

  public function index()
  {

    $baremos = $this->baremos->all();

    return $this->view('baremos/gestionar', [
      'baremos' => $baremos,
    ]);
  }

  public function edit(Request $request, $id)
  {
    $baremos = $this->baremos->find($id);
    $trayectos = $this->trayectos->all();
    $materias = $this->materias->all();


    return $this->view('baremos/edit', [
      'baremos' => $baremos,
      'trayectos' => $trayectos,
      'materias' => $materias,
    ]);
  }


  public function E501()
  {

    return $this->page('errors/501');
  }
}

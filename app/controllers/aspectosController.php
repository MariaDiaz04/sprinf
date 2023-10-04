<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Model\baremos;
use Model\materias;
use Model\aspectos;
use Model\estudiante;
use Model\tutor;
use Model\trayectos;
use Exception;

class aspectosController extends controller
{

  public $baremos;
  public $trayectos;
  public $materias;
  public $aspectos;

  function __construct()
  {
    $this->baremos = new baremos();
    $this->materias = new materias();
    $this->trayectos = new trayectos();
    $this->aspectos = new aspectos();
  }

  public function index()
  {

    $aspectos = $this->aspectos->all();

    return $this->view('aspectos/gestionar', [
      'aspectos' => $aspectos,
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

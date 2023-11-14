<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Model\baremos;
use Model\estudiante;
use Model\tutor;
use Model\trayectos;
use Exception;

class baremosController extends controller
{

  public $baremos;
  public $trayectos;
  public $materias;

  function __construct()
  {
    $this->tokenExist();
    $this->baremos = new baremos();
  }

  public function index(Request $dimension, $idTrayecto)
  {


    return $this->view('baremos/gestionar', [
      'idTrayecto' => $idTrayecto,
    ]);
  }

  function ssp(Request $query, $idTrayecto): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->baremos->generarComplexSSP($idTrayecto));
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  public function E501()
  {
    return $this->page('errors/501');
  }
}

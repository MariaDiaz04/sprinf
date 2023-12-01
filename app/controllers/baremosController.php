<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Model\baremos;
use Model\fase;
use Exception;

class baremosController extends controller
{

  public $baremos;
  public $fase;
  public $materias;

  function __construct()
  {
    $this->tokenExist();
    $this->baremos = new baremos();
    $this->fase = new fase();
  }

  public function index(Request $dimension, $idTrayecto)
  {
    $detallesFase = $this->fase->getByTrayecto($idTrayecto);
    // echo json_encode($detallesFase);
    // exit();
    return $this->view('baremos/gestionar', [
      'idTrayecto' => $idTrayecto,
      'fases' => $detallesFase,
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

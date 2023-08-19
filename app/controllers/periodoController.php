<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;

use App\periodo;
use Exception;

class periodoController extends controller
{

  private $periodo;

  function __construct()
  {
    $this->periodo = new periodo();
  }

  public function index()
  {

    $periodos = $this->periodo->all();

    return $this->view('periodos/gestionar', [
      'periodos' => $periodos,
    ]);
  }

  function ssp(Request $query): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->periodo->generarSSP());
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

<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\indicadores;
use Exception;
use Utils\DateValidator;
use Utils\Sanitizer;

class indicadoresController extends controller
{

  private $indicadores;

  function __construct()
  {
    $this->tokenExist();
    $this->indicadores = new indicadores();
  }

  public function index(Request $indicador, $idDimension)
  {

    $indicadores = $this->indicadores->findByDimension($idDimension);

    return $this->view('indicadores/gestionar', [
      'indicadores' => $indicadores,
      'idDimension' => $idDimension,
    ]);
  }

  function ssp(Request $query, $idDimension): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->indicadores->generarComplexSSP($idDimension));
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

<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Exception;
use Model\historico;
use Utils\DateValidator;
use Utils\Sanitizer;

class historicoController extends controller
{

  public $historico;
  function __construct()
  {
    $this->tokenExist();
    $this->historico = new historico();
  }

  public function index(Request $historico)
  {
    $estudiante_id = $historico->query->get('id');
    $proyecto_id = $historico->query->get('proyecto-id');
    echo json_encode($estudiante_id);
    exit();
    return $this->view('indicadores/gestionar', [
      'idDimension' => true
    ]);
  }

  function ssp(Request $historico): void
  {
    try {
      $cedula = (int)$historico->query->get('cedula') != 0 ? (int)$historico->query->get('cedula') : null;
      $id_proyecto = (int)$historico->query->get('id_proyecto') != 0 ? (int)$historico->query->get('id_proyecto') : null;
      http_response_code(200);

      echo json_encode($this->historico->generarComplexSSP($cedula, $id_proyecto));
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

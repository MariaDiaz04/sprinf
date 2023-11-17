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
    $cedula = $historico->query->get('cedula');
    $proyecto_id = $historico->query->get('proyecto-id');

    $filtro = (int)$historico->query->get('cedula') != 0 ? '?cedula=' . (int)$historico->query->get('cedula') : null;

    if (is_null($filtro)) {
      $filtro = (int)$historico->query->get('id_proyecto') != 0 ? '?id_proyecto=' . (int)$historico->query->get('id_proyecto') : null;
    }
    return $this->view('historico/gestionar', [
      'filtro' => $filtro
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

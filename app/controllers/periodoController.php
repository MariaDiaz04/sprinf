<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\periodo;
use Exception;
use Utils\dateValidator;
use Utils\sanitizer;

class periodoController extends controller
{

  private $periodo;

  function __construct()
  {
    $this->tokenExist();
    $this->periodo = new periodo();
  }

  public function index()
  {

    $periodos = $this->periodo->all();

    return $this->view('periodos/gestionar', [
      'periodo' => $periodos,
    ]);
  }

  public function store(Request $periodo)
  {
    try {
      DateValidator::checkPeriodDates($periodo->get('fecha_inicio'), $periodo->get('fecha_cierre'));

      $this->periodo->setData($periodo->request->all());

      $id = $this->periodo->save();

      http_response_code(200);
      echo json_encode($id);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
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

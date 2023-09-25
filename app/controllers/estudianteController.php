<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;

use App\estudiante;
use Exception;
use Utils\DateValidator;
use Utils\Sanitizer;

class estudianteController extends controller
{

  private $estudiante;

  function __construct()
  {
    $this->estudiante = new estudiante();
  }

  public function index()
  {

    $estudiantes = $this->estudiante->all();

    return $this->view('estudiantes/gestionar', [
      'estudiante' => $estudiantes,
    ]);
  }

  public function store(Request $estudiante)
  {
    try {
      DateValidator::checkPeriodDates($estudiante->get('fecha_inicio'), $estudiante->get('fecha_cierre'));

      // $this->estudiante->setData($estudiante->request->all());

      // $id = $this->estudiante->save();

      http_response_code(200);
      // echo json_encode($id);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function ssp(Request $query): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->estudiante->generarSSP());
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

<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;

use App\clases;
use Exception;
use Utils\DateValidator;
use Utils\Sanitizer;

class clasesController extends controller
{

  private $clases;

  function __construct()
  {
    $this->clases = new clases();
  }

  public function index()
  {

    $clases = $this->clases->all();

    return $this->view('clases/gestionar', [
      'clases' => $clases,
    ]);
  }

  public function store(Request $clases)
  {
    try {
      DateValidator::checkPeriodDates($clases->get('fecha_inicio'), $clases->get('fecha_cierre'));

      $this->clases->setData($clases->request->all());

      $id = $this->clases->save();

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
      echo json_encode($this->clases->generarSSP());
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

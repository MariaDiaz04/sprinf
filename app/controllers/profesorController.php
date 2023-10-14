<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;

use App\profesor;
use Exception;
use Utils\DateValidator;
use Utils\Sanitizer;

class profesorController extends controller
{

  private $profesor;

  function __construct()
  {
    $this->tokenExist();
    $this->profesor = new profesor();
  }

  public function index()
  {

    $profesores = $this->profesor->all();

    return $this->view('profesor/gestionar', [
      'profesor' => $profesores,
    ]);
  }

  public function store(Request $profesor)
  {
    try {
      DateValidator::checkPeriodDates($profesor->get('fecha_inicio'), $profesor->get('fecha_cierre'));

      // $this->estudiante->setData($profesor->request->all());

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
      echo json_encode($this->profesor->generarSSP());
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

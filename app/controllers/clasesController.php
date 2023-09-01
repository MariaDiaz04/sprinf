<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;

use App\clases;
use App\profesor;
use App\materias;
use App\seccion;
use App\estudiante;
use Exception;
use Utils\DateValidator;
use Utils\Sanitizer;

class clasesController extends controller
{

  private $clases;
  private $profesores;
  private $materias;
  private $secciones;
  private $estudiantes;

  function __construct()
  {
    $this->clases = new clases();
    $this->profesores = new profesor();
    $this->materias = new materias();
    $this->secciones = new seccion();
    $this->estudiantes = new estudiante();
  }

  public function index()
  {

    $clases = $this->clases->all();

    $profesores = $this->profesores->all();
    $materias = $this->materias->all();
    $secciones = $this->secciones->all();
    $estudiantes = $this->estudiantes->all();



    return $this->view('clases/gestionar', [
      'clases' => $clases,
      'profesores' => $profesores,
      'materias' => $materias,
      'secciones' => $secciones,
      'estudiantes' => $estudiantes,
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

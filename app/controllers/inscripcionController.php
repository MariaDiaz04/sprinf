<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;

use App\inscripcion;
use App\materias;
use App\periodo;
use Exception;
use Utils\DateValidator;
use Utils\Sanitizer;

class inscripcionController extends controller
{

  private $inscripciones;
  private $periodo;
  private $materias;

  function __construct()
  {
    $this->periodo = new periodo();
    $this->inscripciones = new inscripcion();
    $this->materias = new materias();
  }

  public function index(Request $materia, $idMateria)
  {

    $materia = $this->materias->find($idMateria);
    $inscripciones = $this->inscripciones->all();
    $periodo = $this->periodo->get();

    return $this->view('inscripcion/gestionar', [
      'periodo' => $periodo,
      'materia' => $materia,
      'inscripciones' => $inscripciones,
      'idMateria' => $idMateria,
    ]);
  }

  function ssp(Request $query, $idMateria): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->inscripciones->generarComplexSSP($idMateria));
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

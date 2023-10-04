<?php

namespace Controllers;

use Model\periodo;
use Symfony\Component\HttpFoundation\Request;

use Model\trayectos;
use Exception;

class trayectosController extends controller
{

  private $trayecto;
  private $periodo;

  function __construct()
  {
    $this->trayecto = new trayectos();
    $this->periodo = new periodo();
  }

  public function index()
  {

    $trayectos = $this->trayecto->all();
    $periodos = $this->periodo->all();


    return $this->view('trayectos/gestionar', [
      'trayectos' => $trayectos,
      'periodo' => $periodos,
    ]);
  }

  public function store(Request $trayecto)
  {
    try {


      $this->trayecto->setData($trayecto->request->all());

      $id = $this->trayecto->save();

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
      echo json_encode($this->trayecto->generarSSP());
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

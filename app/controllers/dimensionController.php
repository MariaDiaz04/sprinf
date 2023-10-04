<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Model\baremos;
use Model\dimension;
use Model\materias;
use Model\malla;
use Model\tutor;
use Model\trayectos;
use Exception;

class dimensionController extends controller
{

  public $baremos;
  public $trayectos;
  public $dimension;
  public $malla;
  public $materias;

  function __construct()
  {
    $this->baremos = new baremos();
    $this->dimension = new dimension();
    $this->trayectos = new trayectos();
    $this->materias = new materias();
    $this->malla = new malla();
  }

  public function index(Request $dimension, $idTrayecto)
  {
    $dimensiones = $this->dimension->all();
    $materias = $this->malla->findByTrayecto($idTrayecto);
    $trayecto = $this->trayectos->find($idTrayecto);

    return $this->view('dimensiones/gestionar', [
      'trayecto' => $trayecto,
      'idTrayecto' => $idTrayecto,
      'dimensiones' => $dimensiones,
      'materias' => $materias,
    ]);
  }


  public function store(Request $dimension)
  {
    try {

      $this->dimension->setData($dimension->request->all());

      $id = $this->dimension->save();
      $id = $this->dimension->saveItems();

      http_response_code(200);
      echo json_encode($id);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function ssp(Request $query, $idTrayecto): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->dimension->generarComplexSSP($idTrayecto));
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

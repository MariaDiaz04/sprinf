<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use App\baremos;
use App\dimension;
use App\materias;
use App\estudiante;
use App\tutor;
use App\trayectos;
use Exception;

class dimensionController extends controller
{

  public $baremos;
  public $trayectos;
  public $dimension;
  public $materias;

  function __construct()
  {
    $this->baremos = new baremos();
    $this->dimension = new dimension();
    $this->trayectos = new trayectos();
    $this->materias = new materias();
  }

  public function index()
  {
    $dimensiones = $this->dimension->all();
    $materias = $this->materias->all();

    return $this->view('dimensiones/gestionar', [
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

  function ssp(Request $query): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->dimension->generarSSP());
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

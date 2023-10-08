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

      $unidad_id = $dimension->request->get('unidad_id');
      $nombre = $dimension->request->get('nombre');
      $grupal = $dimension->request->get('grupal');
      $indicadores = isset($dimension->request->all()['indicadores']) ? $dimension->request->all()['indicadores'] : [];


      $this->dimension->setData([
        'unidad_id' => $unidad_id,
        'nombre' => $nombre,
        'grupal' => $grupal,
        'indicadores' => $indicadores
      ]);

      $resultado = $this->dimension->insertTransaction();

      if (!$resultado) throw new Exception($this->dimension->error['message'], $this->dimension->error['code']);

      $dimensionCreada = $this->dimension->find($this->dimension->id);

      http_response_code(200);
      echo json_encode(['data' => $dimensionCreada]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode(['error' => [
        'code' => $e->getCode(),
        'message' => $e->getMessage(),
        'stackTrace' => $e->getTraceAsString()
      ]]);
    }
  }

  function update(Request $dimension): void
  {
    try {

      $id = $dimension->request->get('id');
      $unidad_id = $dimension->request->get('unidad_id');
      $nombre = $dimension->request->get('nombre');
      $grupal = $dimension->request->get('grupal');
      $indicadores = isset($dimension->request->all()['indicadores']) ? $dimension->request->all()['indicadores'] : [];


      $this->dimension->setData([
        'id' => $id,
        'unidad_id' => $unidad_id,
        'nombre' => $nombre,
        'grupal' => $grupal,
        'indicadores' => $indicadores
      ]);
      $resultado = $this->dimension->actualizar();

      if (!$resultado) throw new Exception($this->dimension->error['message'], $this->dimension->error['code']);

      $resultado = $this->dimension->actualizarIndicadores();

      $dimensionCreada = $this->dimension->find($this->dimension->id);
      $indicadoresActualizados = $this->dimension->obtenerIndicadores($this->dimension->id);

      http_response_code(200);
      echo json_encode([
        'data' => [
          'dimension' => $dimensionCreada,
          'indicadores' => $indicadoresActualizados
        ]
      ]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode(['error' => [
        'code' => $e->getCode(),
        'message' => $e->getMessage(),
        'stackTrace' => $e->getTraceAsString()
      ]]);
    }
  }

  function obtener(Request $request, $id): void
  {
    try {

      $idDimension = trim($id);
      $dimension = $this->dimension->find($idDimension);

      $indicadores = $this->dimension->obtenerInidicadores($idDimension);

      http_response_code(200);
      echo json_encode([
        'dimension' => $dimension,
        'indicadores' => $indicadores
      ]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function borrar(Request $dimension): void
  {
    try {

      $idDimension = $dimension->request->get('id');

      $this->dimension->setData(['id' => $idDimension]);

      $verificarDimension = $this->dimension->find($idDimension);

      if (!$verificarDimension) throw new Exception('Dimension no encontrada', 404);

      $resultado = $this->dimension->remover($idDimension);

      if (!$resultado) {
        throw new Exception($this->dimension->error['message'], (int)$this->dimension->error['code']);
      }

      http_response_code(200);
      echo json_encode(true);
    } catch (Exception $e) {
      http_response_code($e->getCode() ?? 500);
      echo json_encode(['error' => [
        'code' => $e->getCode(),
        'message' => $e->getMessage(),
        'stackTrace' => $e->getTraceAsString()
      ]]);
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

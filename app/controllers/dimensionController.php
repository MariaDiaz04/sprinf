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
    $this->tokenExist();
    $this->baremos = new baremos();
    $this->dimension = new dimension();
    $this->trayectos = new trayectos();
    $this->materias = new materias();
    $this->malla = new malla();
  }

  public function index(Request $dimension, $codigoMateria)
  {
    $dimensiones = $this->dimension->all();
    $unidad_curricular = $this->malla->findMateria($codigoMateria);
    $trayecto = $this->trayectos->find($unidad_curricular['codigo_trayecto']);

    return $this->view('dimensiones/gestionar', [
      'codigoMateria' => $codigoMateria,
      'unidadCurricular' => $unidad_curricular,
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


      $this->dimension->setData([
        'id' => $id,
        'unidad_id' => $unidad_id,
        'nombre' => $nombre,
        'grupal' => $grupal,
      ]);

      $resultado = $this->dimension->actualizar();

      if (!$resultado) throw new Exception($this->dimension->error['message'], $this->dimension->error['code']);

      $dimensionActualizada = $this->dimension->find($this->dimension->id);

      http_response_code(200);
      echo json_encode([
        'data' => [
          'dimension' => $dimensionActualizada,
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

      $verificarDimension = $this->dimension->find($idDimension);
      if (!$verificarDimension) throw new Exception('Dimension no encontrada', 404);

      $this->dimension->setData(['id' => $idDimension]);
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

  function ssp(Request $query, $codigoMateria): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->dimension->generarComplexSSP($codigoMateria));
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

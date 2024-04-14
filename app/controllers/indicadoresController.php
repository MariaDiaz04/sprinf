<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\indicadores;
use Model\dimension;
use Model\malla;
use Model\fase;
use Model\trayectos;
use Exception;
use Utils\dateValidator;
use Utils\sanitizer;

class indicadoresController extends controller
{

  private $indicadores;
  private $dimensiones;
  private $malla;
  private $trayectos;
  private $fase;

  function __construct()
  {
    $this->tokenExist();
    $this->indicadores = new indicadores();
    $this->dimensiones = new dimension();
    $this->malla = new malla();
    $this->trayectos = new trayectos();
    $this->fase = new fase();
  }

  public function index(Request $indicador, $idDimension)
  {
    $dimension = $this->dimensiones->find($idDimension);
    $indicadores = $this->indicadores->findByDimension($idDimension);

    $unidad_curricular = $this->malla->findMateria($dimension['unidad_id']);

    $trayecto = $this->trayectos->find($unidad_curricular['codigo_trayecto']);

    $detallesFase = $this->fase->getByTrayecto($unidad_curricular['codigo_trayecto']);

    $ponderado = array_sum(array_map(function ($fase) {
      return $fase['ponderado_baremos'];
    }, $detallesFase));

    return $this->view('indicadores/gestionar', [
      'fases' => $detallesFase,
      'dimension' => $dimension,
      'ponderado' => $ponderado,
      'pendientePorPonderar' => 100 - $ponderado,
      'trayecto' => $trayecto,
      'indicadores' => $indicadores,
      'idDimension' => $idDimension,
      'unidadCurricular' => $unidad_curricular,
    ]);
  }

  public function store(Request $dimension)
  {
    try {

      $dimension_id = $dimension->request->get('dimension_id');
      $nombre = $dimension->request->get('nombre');
      $ponderacion = $dimension->request->get('ponderacion');


      $this->indicadores->setData([
        'dimension_id' => $dimension_id,
        'nombre' => $nombre,
        'ponderacion' => $ponderacion,
      ]);

      $resultado = $this->indicadores->save();

      if (!$resultado) throw new Exception($this->indicadores->error['message'], $this->indicadores->error['code']);

      $dimensionCreada = $this->indicadores->find($this->indicadores->id);

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

  public function update(Request $indicador)
  {
    try {

      $id = $indicador->request->get('id');
      $dimension_id = $indicador->request->get('dimension_id');
      $nombre = $indicador->request->get('nombre');
      $ponderacion = $indicador->request->get('ponderacion');


      $this->indicadores->setData([
        'id' => $id,
        'dimension_id' => $dimension_id,
        'nombre' => $nombre,
        'ponderacion' => $ponderacion,
      ]);

      $resultado = $this->indicadores->actualizar();
      $indicador = $this->indicadores->find($this->indicadores->id);
      if (empty($indicador)) {
        throw new Exception('Indicador no existe', 500);
      }

      http_response_code(200);
      echo json_encode(['data' => $indicador]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode(['error' => [
        'code' => $e->getCode(),
        'message' => $e->getMessage(),
        'stackTrace' => $e->getTraceAsString()
      ]]);
    }
  }

  function delete(Request $indicador): void
  {
    try {
      $idIndicador = $indicador->request->get('id');

      $verificar = $this->indicadores->find($idIndicador);
      if (!$verificar) throw new Exception('Indicador no encontrado', 404);

      $this->indicadores->setData(['id' => $idIndicador]);
      $resultado = $this->indicadores->remove($idIndicador);

      if (!$resultado) {
        throw new Exception($this->indicadores->error['message'], (int)$this->indicadores->error['code']);
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

  function obtener(Request $request, $id): void
  {
    try {

      $idIndicador = trim($id);
      $indicador = $this->indicadores->find($idIndicador);

      if (empty($indicador)) throw new Exception('Indicador no encontrado', 404);
      http_response_code(200);
      echo json_encode([
        'indicador' => $indicador
      ]);
    } catch (Exception $e) {
      http_response_code($e->getCode() ?? 500);
      echo json_encode(['error' => [
        'code' => $e->getCode(),
        'message' => $e->getMessage(),
        'stackTrace' => $e->getTraceAsString()
      ]]);
    }
  }

  function ssp(Request $query, $idDimension): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->indicadores->generarComplexSSP($idDimension));
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

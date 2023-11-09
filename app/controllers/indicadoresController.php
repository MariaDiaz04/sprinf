<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\indicadores;
use Exception;
use Utils\DateValidator;
use Utils\Sanitizer;

class indicadoresController extends controller
{

  private $indicadores;

  function __construct()
  {
    $this->tokenExist();
    $this->indicadores = new indicadores();
  }

  public function index(Request $indicador, $idDimension)
  {

    $indicadores = $this->indicadores->findByDimension($idDimension);

    return $this->view('indicadores/gestionar', [
      'indicadores' => $indicadores,
      'idDimension' => $idDimension,
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

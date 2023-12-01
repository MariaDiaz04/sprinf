<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\integrantes;
use Model\estudiante;
use Model\proyecto;
use Exception;
use Utils\Sanitizer;

class integrantesController extends controller
{

  private $integrantes;
  private $estudiantes;
  private $proyecto;

  function __construct()
  {
    $this->tokenExist();
    $this->integrantes = new integrantes();
    $this->estudiantes = new estudiante();
    $this->proyecto = new proyecto();
  }

  public function index(Request $query, $idProyecto)
  {

    $infoProyecto = $this->proyecto->find($idProyecto);

    return $this->view('integrantes/gestionar', [
      'idProyecto' => $idProyecto,
      'proyecto' => $infoProyecto,
    ]);
  }

  public function store(Request $query)
  {
    try {

      $estudiante_id = $query->request->get('estudiante_id');
      $proyecto_id = $query->request->get('proyecto_id');

      $this->integrantes->setData([
        'estudiante_id' => $estudiante_id,
        'proyecto_id' => $proyecto_id,
        'estatus' => 1, // por default todos están "aprobados"
      ]);

      $resultado = $this->integrantes->save();

      if (!$resultado) throw new Exception($this->integrantes->error['message'], $this->integrantes->error['code']);

      $integranteCreado = $this->integrantes->find($this->integrantes->id);

      http_response_code(200);
      echo json_encode(['data' => $integranteCreado]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode(['error' => [
        'code' => $e->getCode(),
        'message' => $e->getMessage(),
        'stackTrace' => $e->getTraceAsString()
      ]]);
    }
  }


  function delete(Request $query): void
  {
    try {
      $idIntegrante = $query->request->get('id');

      $verificar = $this->integrantes->find($idIntegrante);
      if (!$verificar) throw new Exception('Indicador no encontrado', 404);

      $this->integrantes->setData(['id' => $idIntegrante]);
      $resultado = $this->integrantes->remove($idIntegrante);

      if (!$resultado) {
        throw new Exception($this->integrantes->error['message'], (int)$this->integrantes->error['code']);
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

  function obtener(Request $query, $id): void
  {
    try {

      $idIntegrante = trim($id);
      $integrante = $this->integrantes->find($idIntegrante);

      if (empty($integrante)) throw new Exception('Integrante no encontrado', 404);
      http_response_code(200);
      echo json_encode([
        'integrante' => $integrante
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

  function ssp(Request $query, $idProyecto): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->integrantes->generarComplexSSP($idProyecto));
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

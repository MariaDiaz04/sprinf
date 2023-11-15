<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\inscripcion;
use Model\materias;
use Model\malla;
use Model\periodo;
use Exception;
use Utils\DateValidator;
use Utils\Sanitizer;

class inscripcionController extends controller
{

  private $inscripciones;
  private $periodo;
  private $materias;
  private $malla;

  function __construct()
  {
    $this->tokenExist();
    $this->periodo = new periodo();
    $this->malla = new malla();
    $this->inscripciones = new inscripcion();
    $this->materias = new materias();
  }

  public function index(Request $materia, $codigoTrayecto, $idMateria)
  {

    $materia = $this->materias->findDetalles($idMateria);
    $inscripciones = $this->inscripciones->all();
    $periodo = $this->periodo->get();

    return $this->view('inscripcion/gestionar', [
      'periodo' => $periodo,
      'materia' => $materia,
      'inscripciones' => $inscripciones,
      'idMateria' => $idMateria,
    ]);
  }

  public function store(Request $inscripcion)
  {
    try {

      $profesor_id = $inscripcion->request->get('profesor_id');
      $seccion_id = $inscripcion->request->get('seccion_id');
      $unidad_curricular_id = $inscripcion->request->get('unidad_curricular_id');
      $estudiante_id = $inscripcion->request->get('estudiante_id');

      $mallas = $this->malla->findByMateria($unidad_curricular_id);

      if (empty($mallas)) throw new Exception('Materia no encontrada');

      $checkInscripcion = $this->inscripciones->usuarioCursaMateria($estudiante_id, $mallas[0]['codigo']);


      if (!empty($checkInscripcion)) throw new Exception('Usuario ya cursa materia');

      foreach ($mallas as $malla) {
        # code...
        $this->inscripciones->setData([
          'profesor_id' => $profesor_id,
          'seccion_id' => $seccion_id,
          'unidad_curricular_id' => $malla['codigo'],
          'estudiante_id' => $estudiante_id,
        ]);

        $resultado = $this->inscripciones->save();

        if (!$resultado) throw new Exception('Error inesperado al crear inscripcion');
      }


      $inscripcionInfo = $this->inscripciones->find($this->inscripciones->id);

      http_response_code(200);
      echo json_encode(['data' => $inscripcionInfo]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode(['error' => [
        'code' => $e->getCode(),
        'message' => $e->getMessage(),
        'stackTrace' => $e->getTraceAsString()
      ]]);
    }
  }

  public function evaluar(Request $indicador)
  {
    try {

      $inscripcion = $indicador->request->all()['inscripcion'];

      foreach ($inscripcion as $inscripcion) {
        $resultado = $this->inscripciones->evaluar($inscripcion['id'], $inscripcion['calificacion']);
        if (!$resultado) throw new Exception('Error inesperado calificando el usuario');
      }

      http_response_code(200);
      echo json_encode(['data' => 'success']);
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

      $verificar = $this->inscripciones->find($idIndicador);
      if (!$verificar) throw new Exception('Inscripción no encontrada', 404);

      $resultado = $this->inscripciones->remove($idIndicador);

      if (!$resultado) {
        throw new Exception($this->inscripciones->error['message'], (int)$this->inscripciones->error['code']);
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

  function obtener(Request $request): void
  {
    try {
      $cedula = $request->request->get('cedula');
      $unidadId = $request->request->get('unidad_id');



      $inscripcion = $this->inscripciones->findByMateria($cedula, $unidadId);

      if (empty($inscripcion)) throw new Exception('Inscripción no encontrada', 404);
      http_response_code(200);
      echo json_encode([
        'indicador' => $inscripcion
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

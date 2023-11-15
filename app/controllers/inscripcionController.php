<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\inscripcion;
use Model\materias;
use Model\malla;
use Model\periodo;
use Model\profesor;
use Model\estudiante;
use Model\seccion;
use Exception;
use Utils\DateValidator;
use Utils\Sanitizer;

class inscripcionController extends controller
{

  private $inscripciones;
  private $periodo;
  private $seccion;
  private $profesor;
  private $estudiante;
  private $materias;
  private $malla;

  function __construct()
  {
    $this->tokenExist();
    $this->periodo = new periodo();
    $this->profesor = new profesor();
    $this->estudiante = new estudiante();
    $this->seccion = new seccion();
    $this->malla = new malla();
    $this->inscripciones = new inscripcion();
    $this->materias = new materias();
  }

  public function index(Request $materia, $codigoTrayecto, $idMateria)
  {

    $materia = $this->materias->findDetalles($idMateria);
    $inscripciones = $this->inscripciones->all();
    $pendientes = $this->inscripciones->findPendingEnrollment($idMateria);
    $secciones  = $this->seccion->all();
    $profesores  = $this->profesor->all();
    $periodo = $this->periodo->get();

    $dataEstudiantes = [];
    if (isset($pendientes)) {
      foreach ($pendientes as $estudiante) {
        $info = [
          'nombre' => $estudiante['cedula'] . ' - ' . $estudiante['nombre'] . ' ' . $estudiante['apellido'],
          'value' => $estudiante['cedula']
        ];
        array_push($dataEstudiantes, $info);
      }
    }
    return $this->view('inscripcion/gestionar', [
      'periodo' => $periodo,
      'materia' => $materia,
      'pendientes' => $dataEstudiantes,
      'secciones' => $secciones,
      'profesores' => $profesores,
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
      $inscripcionesId = $indicador->request->all()['id'];

      foreach ($inscripcionesId as $inscripcionId) {
        $verificar = $this->inscripciones->find($inscripcionId);
        if (!$verificar) throw new Exception('Inscripción ' . $inscripcionId . ' no encontrada', 404);

        $resultado = $this->inscripciones->remove($inscripcionId);

        if (!$resultado) {
          throw new Exception($this->inscripciones->error['message'], (int)$this->inscripciones->error['code']);
        }
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
      $estudiante_id = $request->request->get('estudiante_id');
      $unidadId = $request->request->get('unidad_id');


      $inscripciones = [];

      $mallas = $this->malla->findByMateria($unidadId);

      if (empty($mallas)) throw new Exception('Materia no encontrada');

      foreach ($mallas as $malla) {

        $inscripcionInfo = $this->inscripciones->findByMateria($estudiante_id, $malla['codigo']);
        array_push($inscripciones, $inscripcionInfo);
      }


      if (empty($inscripciones)) throw new Exception('Inscripción no encontrada');
      http_response_code(200);
      echo json_encode([
        'inscripciones' => $inscripciones
      ]);
    } catch (Exception $e) {
      http_response_code($e->getCode() && intval($e->getCode()) ?? 500);
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

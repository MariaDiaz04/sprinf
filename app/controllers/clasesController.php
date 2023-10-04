<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\clases;
use Model\profesor;
use Model\materias;
use Model\seccion;
use Model\inscripcion;
use Model\estudiante;
use Exception;
use Utils\DateValidator;
use Utils\Sanitizer;

class clasesController extends controller
{

  private $clases;
  private $profesores;
  private $materias;
  private $secciones;
  private $estudiantes;
  private $inscripcion;

  function __construct()
  {
    $this->clases = new clases();
    $this->profesores = new profesor();
    $this->materias = new materias();
    $this->secciones = new seccion();
    $this->estudiantes = new estudiante();
    $this->inscripcion = new inscripcion();
  }

  public function index()
  {

    $clases = $this->clases->all();

    $profesores = $this->profesores->all();
    $materias = $this->materias->all();
    $secciones = $this->secciones->all();
    $estudiantes = $this->estudiantes->all();



    return $this->view('clases/gestionar', [
      'clases' => $clases,
      'profesores' => $profesores,
      'materias' => $materias,
      'secciones' => $secciones,
      'estudiantes' => $estudiantes,
    ]);
  }

  public function store(Request $clases): void
  {
    try {
      $idUnidadCurricular = $clases->get('unidad_curricular_id');
      $idSeccion = $clases->get('seccion_id');
      $estudiantes = ($clases->get('estudiantes') == null) ? [] : $clases->get('estudiantes');

      // *************************
      // INICIO DE VALIDACIONES
      // *************************

      // verificar que la materia pertenezca al trayecto de la seccion
      $detallesMateria = $this->materias->findByUnidadCurricularId($idUnidadCurricular);
      $detallesSeccion = $this->secciones->find($idSeccion);

      if ($detallesMateria['codigo_trayecto'] != $detallesSeccion['trayecto_id']) throw new Exception('La materia y el trayecto pertenecen a trayectos distintos');

      // Validaciones de estudiante. son 2 en tontal
      // -- Que no pertenezca a una seccion distinta
      // -- Que el estudiante no esté cursando dos veces la misma materia
      foreach ($estudiantes as $estudiante) {

        // verificar que los estudiantes pertenezcan a la seccion
        // hacer un select a inscripcion de un estudiante
        // en caso de que un estudiante no este inscrito a ninguna clase, o se este
        // inscribiendo a una clase de la seccion que el estudiante ya pertenece
        // entonces permitir inscripcion, de lo contrario, cancelar.
        $datosDeInscripcion = $this->inscripcion->find($estudiante);

        // si el estudiante no ha sido inscrito a ninguna clase
        // entonces puede ser inscrito a la clase por crear, por lo que 
        // continuamos a evaluar al siguiente estudiante.
        if (empty($datosDeInscripcion)) continue;

        // si conseguimos una inscripcion a una clase de otra sección entonces detenemos proceso de creacion de clase
        // ya que un estudiante no puede pertenecer a clases de distintas secciones.
        if ($datosDeInscripcion['seccion_id'] != $idSeccion) throw new Exception("Un estudiante no pertenece a la sección $idSeccion");

        // luego verificamos si el estudiante ya está cursando la materia en cuestion
        $inscripcion = $this->inscripcion->usuarioCursaMateria($estudiante, $idUnidadCurricular);
        if (!empty($inscripcion)) throw new Exception('Un estudiante ya cursa la materia');
      }

      // verificar si ya esa seccion tiene una clase con esa unidad curricular
      $claseDeSeccion = $this->clases->getBySubjectAndSection($idUnidadCurricular, $idSeccion);
      if (!empty($claseDeSeccion)) throw new Exception('La sección ya cuenta con una clase para esa unidad');

      // *************************
      // FINAL DE VALIDACIONES
      // *************************

      // crear clase
      $this->clases->setData($clases->request->all());
      $this->clases->crearCodigoClase();

      $codigo = $this->clases->save();
      // crear inscripcion
      foreach ($estudiantes as $estudiante) {
        $this->inscripcion->setData([
          'clase_id' => $codigo,
          'estudiante_id' => $estudiante,
        ]);

        $this->inscripcion->save();
      }

      http_response_code(200);
      echo json_encode($codigo);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function show(Request $clase): void
  {
    try {
      $data = [];
      $codigoClase = $clase->get('codigo');

      // obtener clase
      $data['clase'] = $this->clases->find($codigoClase);

      if (empty($data['clase'])) throw new Exception('Clase no encontrada');

      // obtener lista de integrantes
      $data['inscritos'] = $this->inscripcion->findByClass($codigoClase);

      http_response_code(200);
      echo json_encode($data);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function evaluar(Request $clase): void
  {
    try {
      $inscripciones = $clase->get('inscritos');
      $codigoClase = $clase->get('codigo');

      $clase = $this->clases->find($codigoClase);

      if (empty($clase)) throw new Exception('Clase no encontrada');

      foreach ($inscripciones as $inscripcion) {
        $this->clases->grade($inscripcion['id'], $inscripcion['calificacion']);
      }

      http_response_code(200);
      echo json_encode(true);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function ssp(Request $query): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->clases->generarSSP());
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

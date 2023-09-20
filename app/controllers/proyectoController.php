<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use App\proyecto;
use App\estudiante;
use App\inscripcion;
use App\baremos;
use App\fase;
use App\dimension;
use App\tutor;
use App\trayectos;
use Exception;
use PDOException;

class proyectoController extends controller
{

    public $proyecto;
    private $estudiantes;
    private $dimension;
    private $tutores;
    private $baremos;
    private $fase;
    private $trayectos;
    private $inscripcion;

    function __construct()
    {
        $this->proyecto = new proyecto();
        $this->estudiantes = new estudiante();
        $this->dimension = new dimension();
        $this->tutores = new tutor();
        $this->trayectos = new trayectos();
        $this->baremos = new baremos();
        $this->fase = new fase();
        $this->inscripcion = new inscripcion();
    }

    public function index()
    {

        $proyectos = $this->proyecto->all();
        $pendientes = $this->proyecto->pendientesACerrar();

        $tutores = $this->tutores->all();

        $fases = $this->fase->getPrimerFaseDeTrayectos();

        return $this->view('proyectos/gestionar', [
            'proyectos' => $proyectos,
            'fases' => $fases,
            'cerrarFase' => empty($pendientes) && !empty($proyectos),
            'tutores' => $tutores
        ]);
    }

    public function create()
    {
        $tutores = $this->tutores->all();
        $trayectos = $this->trayectos->all();

        return $this->view('proyectos/crear', [
            'tutores' => $tutores,
            'trayectos' => $trayectos
        ]);
    }

    public function store(Request $nuevoProyecto)
    {
        try {
            if (!array_key_exists('integrantes', $nuevoProyecto->request->all())) throw new Exception('No puede crear proyecto sin integrantes');
            $integrantes = $nuevoProyecto->request->all()['integrantes'];
            $fase = $nuevoProyecto->get('fase_id');
            $trayecto = $this->trayectos->findByFase($fase);
            // VALIDACIONES

            foreach ($integrantes as $codigoEstudiante) {
                $dataEstudiante = $this->estudiantes->find($codigoEstudiante);
                // VERIFICAR QUE UN ESTUDIANTE NO PERTENEZCA A OTRO GRUPO DE PROYECTO
                if ($dataEstudiante['proyecto_id'] != null) {
                    throw new Exception("Estudiante " . $dataEstudiante['nombre'] . " " . $dataEstudiante['apellido'] . " ya pertenece a un proyecto");
                }
                // VERIFICAR QUE UN ESTUDIANTE PERTENEZCA A LA FASE ESPECIFICADA EN LA CREACION DEL PROYECTO
                if (!is_null($dataEstudiante['trayecto_id']) && $dataEstudiante['trayecto_id'] != $trayecto['codigo_trayecto']) {
                    throw new Exception("Estudiante " . $dataEstudiante['nombre'] . " " . $dataEstudiante['apellido'] . " No pertenece al trayecto especificado en la creación del proyecto");
                }
            }

            $this->proyecto->setProyectData($nuevoProyecto->request->all());
            $this->proyecto->insertTransaction();

            http_response_code(200);
            echo json_encode($this->proyecto);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    function pendingStudents(Request $request): void
    {
        try {
            $idFase = $request->get('idFase');
            $trayecto = $this->trayectos->findByFase($idFase);

            $estudiantes = $this->estudiantes->listPendingForProject($trayecto['codigo_trayecto']);

            http_response_code(200);
            echo json_encode($estudiantes);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $proyecto = $this->proyecto->find($id);
            $estudiantes = $this->estudiantes->byProject($id);

            return $this->view('proyectos/show', [
                'proyecto' => $proyecto,
                'estudiantes' => $estudiantes
            ]);
        } catch (PDOException $pdoe) {
            return $this->view('errors/501', [
                'message' => 'Error inesperado',
            ]);
        } catch (Exception $e) {
            return $this->view('errors/501', [
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit(Request $request, $id)
    {
        try {

            $proyecto = $this->proyecto->find($id);
            $estudiantesPendientes = $this->estudiantes->listPendingForProject();
            $estudiantes = $this->estudiantes->byProject($id);
            $tutores = $this->tutores->all();
            $trayectos = $this->trayectos->all();


            return $this->view('proyectos/edit', [
                'proyecto' => $proyecto,
                'estudiantes' => $estudiantes,
                'estudiantesPendientes' => $estudiantesPendientes ?? [],
                'tutores' => $tutores,
                'trayectos' => $trayectos
            ]);
        } catch (PDOException $pdoe) {
            return $this->view('errors/501', [
                'message' => 'Error inesperado',
            ]);
        } catch (Exception $e) {
            return $this->view('errors/501', [
                'message' => $e->getMessage(),
            ]);
        }
    }

    function update(Request $proyecto): void
    {
        try {
            if (!array_key_exists('estudiantes', $proyecto->request->all())) throw new Exception('No puede crear proyecto sin integrantes');

            $estudiantes = $proyecto->request->all()['estudiantes'];
            $idProyecto = $proyecto->request->get('id');

            $this->proyecto->setProyectData($proyecto->request->all());
            $this->proyecto->save($idProyecto);

            $estudiantes = $proyecto->request->all()['estudiantes'];
            $this->proyecto->updateTeam($idProyecto, $estudiantes);

            http_response_code(200);
            echo json_encode($this->proyecto);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    function delete(Request $proyecto): void
    {
        try {

            $idProyecto = $proyecto->request->get('id');

            $this->proyecto->remove($idProyecto);

            http_response_code(200);
            echo json_encode($this->proyecto);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    function assessment(Request $request, $id)
    {
        // verificacion de datos de usuario
        $errors = [];
        try {
            $proyecto = $this->proyecto->find($id);
            $integrantes = $this->proyecto->obtenerIntegrantes($id);

            if (empty($proyecto)) {
                throw new Exception('Proyecto no existe');
            }
            if (empty($integrantes)) {
                throw new Exception('Proyecto no cuenta con estudiantes');
            }

            $fase = $this->fase->find($proyecto['codigo_fase']);
            $materiasDeDimension = $this->dimension->materiasDeBaremos($proyecto['codigo_fase']);
            $baremos = [];

            if (empty($materiasDeDimension)) {
                throw new Exception('Baremos no cuenta con dimensiones');
            }

            foreach ($integrantes as $key => $integrante) {
                foreach ($materiasDeDimension as $key => $materia) {
                    $inscripcion = $this->inscripcion->usuarioCursaMateria($integrante['estudiante_id'], $materia['codigo']);

                    if (empty($inscripcion)) {
                        if (!str_contains($materia['codigo'], 'ASESOR')) {
                            $errors['warning'][] = "Integrante " . $integrante['nombre'] . ' - ' . $integrante['cedula'] . " no está cursando la materia " . $materia['nombre'] . "";
                        } else {
                            // do nothing
                        }
                    } else {

                        if ($inscripcion['calificacion'] == null) {
                            // usuario no cuenta con calificación suficiente como para ser evaluado
                            $errors['danger'][] = "Integrante " . $integrante['nombre'] . ' - ' . $integrante['cedula'] . " no ha sido evaluado en la unidad curricular: " . $materia['nombre'] . "";
                        }
                    }
                }
            }

            foreach ($materiasDeDimension as $key => $materia) {
                $dimensiones = $this->dimension->findBySubject($materia['codigo']);

                $baremos[$materia['codigo']]['nombre'] = $materia['nombre'];

                foreach ($dimensiones as $key => $dimension) {

                    $indicadores = $this->dimension->obtenerIndicadores($dimension['id']);


                    if (empty($indicadores)) {
                        $errors['danger'][] = 'Dimension ' . $dimension['nombre_materia'] . ' - ' . $dimension['nombre'] . ' no cuenta con indicadores!';
                    } else {
                        // configurar informacion de indicador
                        if ($dimension['grupal'] == 1) {
                            $baremos[$materia['codigo']]['dimension']['grupal'][$dimension['id']]['nombre'] = $dimension['nombre'];
                            $baremos[$materia['codigo']]['dimension']['grupal'][$dimension['id']]['indicadores'] = $indicadores;
                        } else {

                            $baremos[$materia['codigo']]['dimension']['individual'][$dimension['id']]['nombre'] = $dimension['nombre'];
                            foreach ($integrantes as $key => $integrante) {

                                foreach ($indicadores as $key => $indicador) {
                                    $itemEstudiante = $this->baremos->findStudentItem($indicador['id'], $integrante['id']);
                                    if (!empty($itemEstudiante)) $indicadores[$key]['calificacion'] = $itemEstudiante['calificacion'];
                                }
                                $baremos[$materia['codigo']]['dimension']['individual'][$dimension['id']]['integrantes'][$integrante['estudiante_id']]['indicadores'] = $indicadores;
                            }
                        }
                    }
                }
            }


            return $this->view('proyectos/assessment', [
                'proyecto_id' => $id,
                'fase' => $fase,
                'integrantes' => $integrantes,
                'baremos' => $baremos,
                'errors' => $errors,
            ]);
        } catch (Exception $e) {

            return $this->view('errors/501', [
                'message' => $e->getMessage(),
            ]);
        }
    }

    function evaluar(Request $request): void
    {
        try {
            // como gestionar las fases
            $proyectoId = $request->get('proyecto_id');
            $proyecto = $this->proyecto->find($proyectoId);


            $baremos = $this->baremos->findByFase($proyecto['fase_id']);

            $integrantes = $this->proyecto->obtenerIntegrantes($proyectoId);

            // verifica que todos los estudiantes hayan sido evaluados
            foreach ($integrantes as $integrante) {

                foreach ($baremos as $indicador) {
                    $calificacion = $this->baremos->findStudentItem($indicador['id'], $integrante['id']);
                    if (empty($calificacion)) throw new Exception("El integrante " . $integrante['nombre'] . " C.I. " . $integrante['cedula'] . " No ha sido evaluado en el item " . $indicador['nombre_indicador'] . " que pertenece a la dimension " . $indicador['nombre_dimension'] . " de la materia " . $indicador['nombre_materia']);
                }
            }

            // verificar si existe una siguiente fase

            $fase = $this->fase->find($proyecto['fase_id']);

            $msg = '';
            if ($fase['siguiente_fase']) {
                // actualizar proyecto
                $this->proyecto->updateFase($proyecto['id'], $fase['siguiente_fase']);
                $msg = 'Fase actualizada';
            } else {
                $this->proyecto->cerrar($proyecto['id']);
                $msg = 'Proyecto cerrado';
            }

            http_response_code(200);
            echo json_encode($msg);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    function subirNotas(Request $request): void
    {
        try {
            $proyectoId = $request->get('proyecto_id');
            // se recorreran todos los integrantes del proyecto
            $integrantes = $this->proyecto->obtenerIntegrantes($proyectoId);

            $indicadoresGrupales = $request->get('indicador_grupal');
            $indicadoresIndividuales = $request->get('indicador_individual');

            foreach ($integrantes as $integrante) {
                // indicadores grupales
                foreach ($indicadoresGrupales as $id => $value) {
                    $value = floatval($value);
                    $this->baremos->evaluarIndicador($id, $integrante['id'], $value);
                }

                foreach ($indicadoresIndividuales[$integrante['id']] as $id => $value) {
                    $value = floatval($value);
                    $this->baremos->evaluarIndicador($id, $integrante['id'], $value);
                }
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
            echo json_encode($this->proyecto->generarSSP());
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

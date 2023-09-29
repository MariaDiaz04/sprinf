<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\proyectoHistorico;
use App\proyecto;
use App\periodo;
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
    public $proyectoHistorico;
    public $proyecto;
    private $estudiantes;
    private $dimension;
    private $tutores;
    private $baremos;
    private $fase;
    private $periodo;
    private $trayectos;
    private $inscripcion;

    function __construct()
    {
        $this->proyectoHistorico = new proyectoHistorico();
        $this->proyecto = new proyecto();
        $this->estudiantes = new estudiante();
        $this->dimension = new dimension();
        $this->tutores = new tutor();
        $this->trayectos = new trayectos();
        $this->baremos = new baremos();
        $this->fase = new fase();
        $this->periodo = new periodo();
        $this->inscripcion = new inscripcion();
    }

    public function index()
    {

        $proyectos = $this->proyecto->all();
        $pendientes = $this->proyecto->pendientesACerrar();
        $tutores = $this->tutores->all();
        $trayectos = $this->trayectos->all();

        $fases = $this->fase->getPrimerFaseDeTrayectos();

        $periodo = $this->periodo->get();

        $historicoEstudiantes = $this->historicoEstudiantes();
        $historicoProyecto = $this->historicoProyecto();

        // echo json_encode($historicoEstudiantes);
        // exit();

        return $this->view('proyectos/gestionar', [
            'proyectos' => $proyectos,
            'periodo' => $periodo,
            'fases' => $fases,
            'cerrarFase' => empty($pendientes) && !empty($proyectos),
            'tutores' => $tutores,
            'trayectos' => $trayectos,
            'historicoEstudiantes' => $historicoEstudiantes,

        ]);
    }

    function historicoProyecto(): array
    {

        $historico = $this->proyectoHistorico->all();

        $group = [];
        foreach ($historico as $item) {
            if (!isset($group[$item['id_proyecto']])) {
                if (!isset($group[$item['id_proyecto']][$item['periodo_inicio']])) {
                    $group[$item['id_proyecto']][$item['periodo_inicio']] = [];
                    $group[$item['id_proyecto']][$item['periodo_inicio']]['nombre'] = $item['nombre_proyecto'];
                    $group[$item['id_proyecto']][$item['periodo_inicio']]['comunidad'] = $item['comunidad'];
                    $group[$item['id_proyecto']][$item['periodo_inicio']]['tutor_in'] = $item['tutor_in'];
                    $group[$item['id_proyecto']][$item['periodo_inicio']]['tutor_ex'] = $item['tutor_ex'];
                    $group[$item['id_proyecto']][$item['periodo_inicio']]['motor_productivo'] = $item['motor_productivo'];
                    $group[$item['id_proyecto']][$item['periodo_inicio']]['resumen'] = $item['resumen'];
                    $group[$item['id_proyecto']][$item['periodo_inicio']]['direccion'] = $item['direccion'];
                    $group[$item['id_proyecto']][$item['periodo_inicio']]['municipio'] = $item['municipio'];
                    $group[$item['id_proyecto']][$item['periodo_inicio']]['parroquia'] = $item['parroquia'];
                }
            }
            foreach ($item as $key => $value) {
                if ($key == 'id_proyecto') continue;
                $group[$item['id_proyecto']][$item['periodo_inicio']]['integrantes'][$item['cedula_estudiante']][$key] = $value;
            }
        }
        return $group;
    }

    function historicoEstudiantes(): array
    {
        try {
            $historico = $this->proyectoHistorico->all();

            $group = [];
            foreach ($historico as $item) {
                if (!isset($group[$item['id_proyecto']])) {
                    $group[$item['id_proyecto']] = [];
                    $group[$item['id_proyecto']]['id'] = $item['id_proyecto'];
                    $group[$item['id_proyecto']]['nombre'] = $item['nombre_proyecto'];
                }
                foreach ($item as $key => $value) {
                    if ($key == 'id_proyecto') continue;
                    $group[$item['id_proyecto']]['integrantes'][$item['cedula_estudiante']][$key] = $value;
                }
            }

            $response = [];

            foreach ($group as $key => $proyecto) {
                $integrantes = [];
                foreach ($proyecto['integrantes'] as $key => $value) {
                    $info = ['nombre' => $value['nombre_estudiante'] . ' - ' . $value['cedula_estudiante'], 'value' => $value['cedula_estudiante']];
                    $integrantes[] = (object)$info;
                    # code...
                }
                $informacionProyecto = [
                    'nombre' => $proyecto['nombre'],
                    'integrantes' => $integrantes
                ];
                $response[] = (object)$informacionProyecto;
            }

            return $response;
        } catch (Exception $e) {
            return [];
        }
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

            foreach ($integrantes as $cedula) {
                $dataEstudiante = $this->estudiantes->findByCedula($cedula);
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
            $estudiantes = $this->estudiantes->byProject($id);
            $tutores = $this->tutores->all();


            return $this->view('proyectos/edit', [
                'proyecto' => $proyecto,
                'estudiantes' => $estudiantes,
                'tutores' => $tutores
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
                            foreach ($indicadores as $key => $indicador) {
                                $itemEstudiante = $this->baremos->findStudentItem($indicador['id'], $integrantes[0]['id']);
                                if (!empty($itemEstudiante)) $indicadores[$key]['calificacion'] = $itemEstudiante['calificacion'];
                            }
                            $baremos[$materia['codigo']]['dimension']['grupal'][$dimension['id']]['indicadores'] = $indicadores;
                        } else {

                            $baremos[$materia['codigo']]['dimension']['individual'][$dimension['id']]['nombre'] = $dimension['nombre'];
                            foreach ($integrantes as $key => $integrante) {

                                foreach ($indicadores as $key => $indicador) {
                                    $itemEstudiante = $this->baremos->findStudentItem($indicador['id'], $integrante['id']);
                                    if (!empty($itemEstudiante)) $indicadores[$key]['calificacion'] = $itemEstudiante['calificacion'];
                                    $indicadores[$key]['nombre_integrante'] = $integrante['nombre'];
                                    $indicadores[$key]['cedula_integrante'] = $integrante['cedula'];
                                }
                                $baremos[$materia['codigo']]['dimension']['individual'][$dimension['id']]['integrantes'][$integrante['id']]['indicadores'] = $indicadores;
                            }
                        }
                    }
                }
            }

            // echo json_encode($baremos);
            // exit();


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
                if (!empty($indicadoresGrupales)) {
                    foreach ($indicadoresGrupales as $id => $value) {
                        $value = floatval($value);
                        $this->baremos->evaluarIndicador($id, $integrante['id'], $value);
                    }
                }
                if (!empty($indicadoresIndividuales)) {

                    foreach ($indicadoresIndividuales[$integrante['id']] as $id => $value) {
                        $value = floatval($value);
                        $this->baremos->evaluarIndicador($id, $integrante['id'], $value);
                    }
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

    function exportExcel(Request $request): void
    {
        try {
            $trayectoId = $request->get('trayecto_id');
            $integrantes = $this->proyecto->IntegrastesPorTrayecto($trayectoId);
            $spreadsheet = new Spreadsheet();
            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'top' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM
                    ],
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM
                    ],
                    'left' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM
                    ],
                    'right' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM
                    ],
                ],

            ];

            $spreadsheet->getActiveSheet()->setCellValue('H1', 'MATRIZ DE PROYECTOS');
            $spreadsheet->getActiveSheet()->getStyle('H1')->getFont()->setBold(true)->setSize(20);
            $spreadsheet->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A2:N2')->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->setCellValue('A2', 'Sección');
            $spreadsheet->getActiveSheet()->setCellValue('B2', 'Cedula de identidad');
            $spreadsheet->getActiveSheet()->setCellValue('C2', 'Apellidos');
            $spreadsheet->getActiveSheet()->setCellValue('D2', 'Nombres');
            $spreadsheet->getActiveSheet()->setCellValue('E2', 'Telefonos');
            $spreadsheet->getActiveSheet()->setCellValue('F2', 'Correo Electrónico');
            $spreadsheet->getActiveSheet()->setCellValue('G2', 'Lugar');
            $spreadsheet->getActiveSheet()->setCellValue('H2', 'Nombre del Proyecto');
            $spreadsheet->getActiveSheet()->setCellValue('I2', 'Municipio donde se ejecuta el proyecto');
            $spreadsheet->getActiveSheet()->setCellValue('J2', 'Motor Productivo');
            $spreadsheet->getActiveSheet()->setCellValue('K2', 'Breve Descripción (Resumen)');
            $spreadsheet->getActiveSheet()->setCellValue('L2', 'Dirección');
            $spreadsheet->getActiveSheet()->setCellValue('M2', 'Parroquia');
            if (!is_null($integrantes)) {
                $spreadsheet->getActiveSheet()
                    ->fromArray(
                        $integrantes,  // The data to set
                        NULL,        // Array values with this value will not be set
                        'A3'         // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
                    );
            } else {
                $spreadsheet->getActiveSheet()->setCellValue('H3', 'SIN DATOS');
                $spreadsheet->getActiveSheet()->getStyle('H3')->getFont()->setBold(true)->setSize(16);
                $spreadsheet->getActiveSheet()->getStyle('H3')->getAlignment()->setHorizontal('center');
            }
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="matriz de proyectos.xlsx"');
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');

            http_response_code(200);
            echo json_encode(true);
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

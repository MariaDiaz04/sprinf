<?php

namespace App\controllers;

use App\permisos;
use App\materias;
use App\trayectos;
use App\fase;
use App\malla;
use App\controllers\controller;
use Exception;

use Symfony\Component\HttpFoundation\Request;

class materiasController extends controller
{
    public $MATERIAS;
    public $PERMISOS;
    public $TRAYECTO;
    public $FASE;
    public $MALLA;

    function __construct()
    {
        $this->MATERIAS = new materias();
        $this->PERMISOS = new permisos();
        $this->TRAYECTO = new trayectos();
        $this->FASE = new fase();
        $this->MALLA = new malla();
    }

    public function index()
    {

        $materias = $this->MATERIAS->all();
        $trayectos = $this->TRAYECTO->all();


        return $this->view('materias/gestionar', [
            'materias' => $materias,
            'trayectos' => $trayectos
        ]);
    }

    public function create($request)
    {
        $materias = $this->MATERIAS->Selectcod();
        $trayectos = $this->TRAYECTO->all();
        return $this->view('materias/crear', ['materias' => $materias, 'trayectos' => $trayectos]);
    }

    public function store(Request $materia)
    {
        try {
            $malla = [];
            $codigo_materia = $materia->get('codigo');

            $fase1 = $this->FASE->getFaseDeTrayecto('1', $materia->get('trayecto_id'));
            $fase2 = $this->FASE->getFaseDeTrayecto('2', $materia->get('trayecto_id'));

            switch ($materia->get('periodo')) {
                case 'anual':
                    $mallaFase1 = [
                        'codigo' => $codigo_materia . '_1',
                        'fase_id' => $fase1['codigo_fase'],
                        'materia_id' => $codigo_materia
                    ];
                    $mallaFase2 = [
                        'codigo' => $codigo_materia . '_2',
                        'fase_id' => $fase2['codigo_fase'],
                        'materia_id' => $codigo_materia
                    ];

                    $malla[] = $mallaFase1;
                    $malla[] = $mallaFase2;

                    break;

                case 'fase_1':
                    $mallaFase1 = [
                        'codigo' => $materia->get('codigo') . '_1',
                        'fase_id' => $fase1['codigo_fase'],
                        'materia_id' => $materia->get('codigo')
                    ];
                    $malla[] = $mallaFase1;
                    break;

                case 'fase_2':
                    $mallaFase2 = [
                        'codigo' => $materia->get('codigo') . '_2',
                        'fase_id' => $fase2['codigo_fase'],
                        'materia_id' => $materia->get('codigo')
                    ];
                    $malla[] = $mallaFase2;
                    break;

                default:
                    throw new Exception('Error al generar malla de unidad curricular');
                    break;
            }


            // chequear vinculacion a proyecto
            $this->MATERIAS->setData($materia->request->all());
            $this->MATERIAS->setMalla($malla);

            $this->MATERIAS->insertTransaction();

            throw new Exception('Unimplemented Error');

            $id = $this->MATERIAS->save();

            http_response_code(200);
            echo json_encode($id);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    public function edit($request)
    {
        $materias = $this->MATERIAS->find($request['materias']);
        if ($materias) {
            return $this->view('materias/editar', ['materias' => $materias->fillable]);
        } else {

            return $this->page('errors/404');
        }
    }
    public function update($request)
    {


        if (!$materias = $this->MATERIAS->find($_GET['id'])) {
            return $this->page('errors/404');
        }
        $materias->actualizar([
            'nombre' => '"' . $request['nombre'] . '"',
            'estatus' => '"' . $request['estatus'] . '"',
        ]);
        return $this->redirect('materias');
    }

    function ssp(): void
    {
        try {
            http_response_code(200);
            echo json_encode($this->MATERIAS->generarSSP());
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }


    public function delete($request)
    {
        $materias = $this->MATERIAS->find($request['id']);
        return $materias ? $materias->eliminar() : $this->page('errors/404');
    }
}

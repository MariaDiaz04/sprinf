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

    /**
     * Creacion o actualización de materias y de su malla [fase1, fase2 o anual]
     *
     * @param Request $materia
     * @return void
     */
    public function store(Request $materia)
    {
        try {
            $malla = [];
            $codigo_materia = $materia->get('codigo');
            $periodo = $materia->get('periodo');

            $fase1 = $this->FASE->getFaseDeTrayecto('1', $materia->get('trayecto_id'));
            $fase2 = $this->FASE->getFaseDeTrayecto('2', $materia->get('trayecto_id'));

            if ($periodo == 'fase_1' || $periodo == 'anual') {

                $malla[] = [
                    'codigo' => $codigo_materia . '_1',
                    'fase_id' => $fase1['codigo_fase'],
                    'materia_id' => $codigo_materia
                ];
            } else if ($periodo == 'fase_2' || $periodo == 'anual') {

                $malla[] = [
                    'codigo' => $codigo_materia . '_2',
                    'fase_id' => $fase2['codigo_fase'],
                    'materia_id' => $codigo_materia
                ];
            }

            // en caso de que no se hayan cumplido condiciones que generen mallas a la materia
            if (empty($malla)) throw new Exception('Error inesperado al crear malla de unidad curricular.');


            // asignar valores de materia
            $this->MATERIAS->setData($materia->request->all());
            // asignar valores de malla asignada a esa materia
            $this->MATERIAS->setMalla($malla);

            // ejecutar transacción de insert
            $codigo = $this->MATERIAS->insertTransaction();

            if (empty($codigo)) throw new Exception('Error inesperado al crear materia.');

            http_response_code(200);
            echo json_encode($codigo);
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

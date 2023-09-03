<?php

namespace App\controllers;

use App\permisos;
use App\materias;
use App\trayectos;
use App\clases;
use App\fase;
use App\malla;
use App\controllers\controller;
use Exception;

use Symfony\Component\HttpFoundation\Request;

class materiasController extends controller
{
    public $MATERIAS;
    public $CLASES;
    public $PERMISOS;
    public $TRAYECTO;
    public $FASE;
    public $MALLA;

    function __construct()
    {
        $this->MATERIAS = new materias();
        $this->CLASES = new clases();
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
            $codigo_materia = $materia->get('codigo');
            $periodo = $materia->get('periodo');
            $trayectoId = $materia->get('trayecto_id');


            $malla = $this->obtenerMallasDePeriodo($codigo_materia, $periodo, $trayectoId);

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

    public function update($request)
    {
        try {
            $codigo = $request->get('codigo');
            // verificar que no cuente con clases ya creadas

            $this->checkMateria($codigo, 'actualizar');
            // realizar update

            $codigo_materia = $request->get('codigo');
            $periodo = $request->get('periodo');
            $trayectoId = $request->get('trayecto_id');

            $malla = $this->obtenerMallasDePeriodo($codigo_materia, $periodo, $trayectoId);
            // en caso de que no se hayan cumplido condiciones que generen mallas a la materia


            // asignar valores de materia
            $this->MATERIAS->setData($request->request->all());
            // asignar valores de malla asignada a esa materia
            $this->MATERIAS->setMalla($malla);

            $codigo = $this->MATERIAS->updateTransaction();

            if (empty($codigo)) throw new Exception('Error inesperado al actualizar materia.');

            http_response_code(200);
            echo json_encode($codigo);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    public function delete($request)
    {

        try {
            $codigo = $request->get('codigo');
            // verificar que no cuente con clases ya creadas

            $this->checkMateria($codigo, 'eliminar');
            // realizar update

            $result = $this->MATERIAS->deleteTransaction($codigo);

            if (!$result) throw new Exception('Error inesperado al borrar materia.');

            http_response_code(200);
            echo json_encode($codigo);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    /**
     * Dependiendo del periodo y del trayecto,
     * genera un array de la malla curricular de la materia
     * es decir, si es anual, genera un array donde define un
     * array de datos con codigo unico para esa materia en fase 1, y un 
     * array de datos con codigo unico para esa materia en fase 2.
     *
     * @param string $codigo_materia
     * @param string $periodo
     * @param integer $trayectoId
     * @return array
     */
    private function obtenerMallasDePeriodo(string $codigo_materia, string $periodo, int $trayectoId): array
    {
        $malla = [];

        $fase1 = $this->FASE->getFaseDeTrayecto('1', $trayectoId);
        $fase2 = $this->FASE->getFaseDeTrayecto('2', $trayectoId);

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

        if (empty($malla)) throw new Exception('Error inesperado al crear malla de unidad curricular.');

        return $malla;
    }

    function checkMateria(string $codigo, string $action): bool
    {
        $clases = $this->CLASES->getAllBySubject($codigo);

        if (!empty($clases)) throw new Exception("No puede $action datos de materia que cuenta con clases ya creadas");

        // verificar que no cuente con dimensiones
        $detallesMateria = $this->MATERIAS->find($codigo);

        if (intval($detallesMateria['dimensiones_proyecto']) > 0) throw new Exception("No puede $action datos de materia que cuenta dimensiones de proyecto");

        return true;
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
}

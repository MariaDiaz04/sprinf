<?php

namespace App\controllers;

use App\permisos;
use App\materias;
use App\trayectos;
use App\controllers\controller;
use Exception;

use Symfony\Component\HttpFoundation\Request;

class materiasController extends controller
{
    public $MATERIAS;
    public $PERMISOS;
    public $TRAYECTO;

    function __construct()
    {
        $this->MATERIAS = new materias();
        $this->PERMISOS = new permisos();
        $this->TRAYECTO = new trayectos();
    }

    public function index()
    {

        $materias = $this->MATERIAS->all();

        return $this->view('materias/gestionar', ['materias' => $materias]);
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
            // chequear vinculacion a proyecto
            $this->MATERIAS->setData($materia->request->all());

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

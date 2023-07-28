<?php

use App\permisos;
use App\materias;
use App\trayectos;
use App\controllers\controller;

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
        $trayectos = $this->TRAYECTO->all();
        return $this->view('materias/materias', ['materias' => $materias, 'trayectos' => $trayectos]);
    }

    public function create($request)
    {
        $materias = $this->MATERIAS->Selectcod();
        $trayectos = $this->TRAYECTO->all();
        return $this->view('materias/crear', ['materias' => $materias, 'trayectos' => $trayectos]);
    }

    public function store($materias)
    {

        $guardar = $this->MATERIAS->create([
            'nombre' => $materias['nombre'],
            'trayecto_id' => $materias['trayecto_id'],
            'tipo' => $materias['tipo'],

        ])->save();

        if ($guardar == null) {
            echo '
        <script> 
            window.alert(" La Materia  ya esta registrada")
        </script>';
            header("refresh:1 http://localhost/sprinfbd/public/?r=materias");
        } else {
            return $this->redirect('materias');
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


    public function delete($request)
    {
        $materias = $this->MATERIAS->find($request['id']);
        return $materias ? $materias->eliminar() : $this->page('errors/404');
    }
}

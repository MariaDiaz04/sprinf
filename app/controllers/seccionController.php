<?php

use App\permisos;
use App\trayectos;
use App\seccion;
use App\controllers\controller;

class seccionController extends controller
{
    public $SECCION;
    public $PERMISOS;
    public $TRAYECTO;


    function __construct()
    {
        $this->SECCION = new seccion();
        $this->PERMISOS = new permisos();
        $this->TRAYECTO = new trayectos();
    }

    public function index()
    {

        $seccion = $this->SECCION->all();
        return $this->view('seccion/seccion', ['seccion' => $seccion]);
    }

    public function create($request)
    {
        $seccion = $this->SECCION->all();
        $trayectos = $this->TRAYECTO->all();
        return $this->view('seccion/crear', ['seccion' => $seccion, 'trayecto' => $trayectos]);
    }

    public function store($seccion)
    {

        $guardar = $this->SECCION->create([
            'nombre' => $seccion->request->get('nombre'),
            'trayecto_id' => $seccion->request->get('trayecto_id'),
        ])->save();

       // return var_dump($guardar);

        if ($guardar == null) {
            echo '
        <script> 
            window.alert(" La Seccion  ya esta registrada")
        </script>';
            header("refresh:1 http://localhost/sprinfbd/public/?r=seccion");
        } else {
            return $this->redirect('seccion');
        }
    }

    public function edit($request)
    {
        $seccion = $this->SECCION->find($request['seccion']);
        if ($seccion) {
            return $this->view('seccion/editar', ['seccion' => $seccion->fillable]);
        } else {

            return $this->page('errors/404');
        }
    }
    public function update($request)
    {


        if (!$seccion = $this->SECCION->find($_GET['id'])) {
            return $this->page('errors/404');
        }
        $seccion->actualizar([
            'nombre' => '"' . $request['nombre'] . '"',
            'estatus' => '"' . $request['estatus'] . '"',
        ]);
        return $this->redirect('seccion');
    }


    public function delete($request)
    {
        $seccion = $this->SECCION->find($request['id']);
        return $seccion ? $seccion->eliminar() : $this->page('errors/404');
    }
}

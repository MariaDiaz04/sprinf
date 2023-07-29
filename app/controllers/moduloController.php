<?php

namespace App\controllers;

use App\modulo;
use Exception;

class moduloController extends controller
{
    public $MODULO;

    function __construct()
    {
        $this->MODULO = new modulo();
    }

    public function index()
    {
        $modulo = $this->MODULO->all();
        return $this->view('modulo/modulo', ['modulo' => $modulo]);
    }

    public function create($request)
    {
        return $this->view('modulo/crear');
    }

    public function store($modulo)
    {
        try {
            $guardar = $this->MODULO->create([
                'nombre' => $modulo->request->get('nombre')
            ])->save();


            if ($guardar == null) {
                echo '
                <script> 
                    window.alert("Modulo ya registrado")
                </script>';
                header('refresh:1 '.APP_URL.'modulos');
            } else {
                return $this->redirect(APP_URL.'modulos');
            }
            http_response_code(200);
            echo json_encode($this->MODULO);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    public function edit($request)
    {
        $modulo = $this->MODULO->find($request['modulo']);
        if ($modulo) {
            return $this->view('modulo/editar', ['modulo' => $modulo->fillable]);
        } else {
            return $this->page('errors/404');
        }
    }

    public function update($request)
    {
        if (!$modulo = $this->MODULO->find($_GET['idmodulo'])) {
            return $this->page('errors/404');
        }
        $modulo->actualizar([
            'nombre' => '"' . $request['nombre'] . '"',
        ]);
        return $this->redirect('modulo');
    }

    public function delete($request)
    {

        $modulo = $this->MODULO->find($request['idmodulo']);
        return $modulo ? $modulo->eliminar() : $this->page('errors/404');
    }
}

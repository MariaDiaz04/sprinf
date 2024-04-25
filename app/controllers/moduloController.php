<?php

namespace Controllers;

use Model\modulo;
use Symfony\Component\HttpFoundation\Request;
use Model\bitacoraAcciones;
use App\enums\acciones;
use App\enums\modulos;

use Exception;

class moduloController extends controller
{
    public $MODULO;
    public $ACCIONES;
 

    function __construct()
    {
        $this->tokenExist();
        $this->MODULO = new modulo();
        $this->ACCIONES = new bitacoraAcciones();

    }

    public function index()
    {
        $modulo = $this->MODULO->all();
        $this->ACCIONES->lastSave($this->modulo_modulos,$this->accion_consultar);
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
                header('refresh:1 ' . APP_URL . 'modulos');
            } else {
                 $this->ACCIONES->lastSave($this->modulo_modulos,$this->accion_insertar);
                return $this->redirect(APP_URL . 'modulos');
            }  
            http_response_code(200);
            echo json_encode($this->MODULO);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        $modulo = $this->MODULO->find($id);
        if ($modulo) {
            return $this->view('modulo/editar', ['modulo' => $modulo->fillable]);
        } else {
            return $this->page('errors/404');
        }
    }

    public function update($request, $id)
    {
        if (!$modulo = $this->MODULO->find($id)) {
            return $this->page('errors/404');
        }
        $modulo->actualizar([
            'nombre' => '"' .  $request->request->get('nombre') . '"',
        ]);
        if (!is_null($modulo)) {
        $this->ACCIONES->lastSave($this->modulo_modulos,$this->accion_actualizar);
        }


        return $this->redirect(APP_URL . 'modulos');
    }

    public function delete($request)
    {

        $modulo = $this->MODULO->find($request['idmodulo']);
        return $modulo ? $modulo->eliminar() : $this->page('errors/404');
    }
}

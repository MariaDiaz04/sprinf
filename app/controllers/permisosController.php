<?php

use App\rol;
use App\modulo;
use App\permisos;
use App\controllers\controller;
use Symfony\Component\HttpFoundation\Request;

class permisosController extends controller
{
    public $PERMISOS;
    public $ROL;
    public $MODULO;

    function __construct()
    {
        $this->PERMISOS = new permisos();
        $this->ROL = new rol();
        $this->MODULO = new modulo();
    }

    // ======================== INDEX=========================
    public function index()
    {
        $permisos = $this->PERMISOS->all();
        return $this->view('permisos/permisos', ['permisos' => $permisos]);
    }

    // ======================== CREATE=========================
    public function create($request)
    {
        $roles = $this->ROL->all();
        $modulos = $this->MODULO->all();
        return $this->view('permisos/crear', ['roles' => $roles, 'modulos' => $modulos]);
    }

    // ======================== STORE=========================
    public function store($permisos)
    {
        try {

            $this->PERMISOS->create([
                'consultar' => $permisos->request->get('consultar'),
                'actualizar' => $permisos->request->get('actualizar'),
                'crear' => $permisos->request->get('crear'),
                'eliminar' => $permisos->request->get('eliminar'),
                'rol_id' => $permisos->request->get('rol_id'),
                'modulo_id' => $permisos->request->get('modulo_id'),
            ])->save();

            return $this->redirect(APP_URL . 'permisos');
            http_response_code(200);
            echo json_encode($this->PERMISOS);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    // ======================== EDIT=========================
    public function edit(Request $request, $id)
    {
        $roles = $this->ROL->all();
        $permisos = $this->PERMISOS->find($id);
        $modulos = $this->MODULO->all();
       // return var_dump($modulos);

        if ($permisos) {
            return $this->view('permisos/editar', ['permisos' => $permisos->fillable, 'roles' => $roles, 'modulos'=>$modulos]);
        } else {
            return $this->page('errors/404');
        }
    }

    // ======================== UPDATE=========================
    public function update($request, $id)
    {
        if (!$permisos = $this->PERMISOS->find($id)) {
            return $this->page('errors/404');
        }
       $permisos->actualizar([
            'consultar' => '"' . $request->request->get('consultar'). '"',
            'actualizar' => '"' . $request->request->get('actualizar'). '"',
            'crear' => '"' . $request->request->get('crear') . '"',
            'eliminar' => '"' .  $request->request->get('eliminar')  . '"',
            'rol_id' => '"' . $request->request->get('rol_id') . '"',
            'modulo_id'=> '"'.$request->request->get('modulo_id') .'"',  
        ]);
        return $this->redirect(APP_URL.'permisos');
    }

    // ======================== DELETE=========================
    public function delete($request)
    {

        $permisos = $this->PERMISOS->find($request->query->get('idpermisos'));
        return $permisos ? $permisos->eliminar() : $this->page('errors/404');
    }
}// ========================/ CLASS=========================

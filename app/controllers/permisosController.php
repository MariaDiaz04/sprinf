<?php
namespace Controllers;

use Model\rol;
use Model\modulo;
use Model\permisos;
use Symfony\Component\HttpFoundation\Request;

class permisosController extends controller
{
    public $PERMISOS;
    public $ROL;
    public $MODULO;

    function __construct()
    {
        $this->tokenExist();
        $this->PERMISOS = new permisos();
        $this->ROL = new rol();
        $this->MODULO = new modulo();
    }

    // ======================== INDEX=========================
    public function index()
    {
        $roles = $this->ROL->all();
        return $this->view('permisos/index', ['roles' => $roles]);
    }

    // ======================== CREATE=========================
    public function create(Request $request, $id)
    {
        $rol = $this->ROL->find($id);
        $modulos = $this->MODULO->all();
        return $this->view('permisos/crear', ['rol' => $rol->fillable, 'modulos' => $modulos]);
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
                'evaluar' => $permisos->request->get('evaluar'),
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
    public function edit(Request $request, $id, $rol)
    {
        $permisos = $this->PERMISOS->find($id);
        $rol = $this->ROL->find($rol);

        $modulos = $this->MODULO->all();
        if ($permisos) {
            return $this->view('permisos/editar', ['permisos' => $permisos->fillable, 'rol' => $rol->fillable, 'modulos' => $modulos]);
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
            'consultar' => '"' . $request->request->get('consultar') . '"',
            'actualizar' => '"' . $request->request->get('actualizar') . '"',
            'crear' => '"' . $request->request->get('crear') . '"',
            'eliminar' => '"' .  $request->request->get('eliminar')  . '"',
            'evaluar' => '"' .  $request->request->get('evaluar')  . '"',
            'rol_id' => '"' . $request->request->get('rol_id') . '"',
            'modulo_id' => '"' . $request->request->get('modulo_id') . '"',
        ]);
        return $this->redirect(APP_URL . 'permisos');
    }

    // ======================== DELETE=========================
    public function delete($request)
    {

        $permisos = $this->PERMISOS->find($request->query->get('idpermisos'));
        return $permisos ? $permisos->eliminar() : $this->page('errors/404');
    }

     // ========================Show =========================
     public function consultar(Request $request, $id)
     {
         $permisos = $this->PERMISOS->findPermisionbyRol($id);
         $rol = $this->ROL->find($id);


             return $this->view('permisos/permisos', ['permisos' => $permisos,'rol' => $rol->fillable]);
      
     }
}
// ========================/ CLASS=========================

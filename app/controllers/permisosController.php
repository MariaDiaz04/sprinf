<?php 
    require '../app/permisos.php';
    require '../app/modulo.php';
    require '../app/usuario.php';

    class permisosController extends controller
    {
        public $PERMISOS;
        public $USUARIO;
        public $MODULO;

        function __construct () {   
            $this->PERMISOS = new permisos();
            $this->USUARIO = new usuario();
            $this->MODULO = new modulo();
        }

        // ======================== INDEX=========================
        public function index() {
            $permisos = $this->PERMISOS->all();
            return $this->view('permisos/permisos', ['permisos'=>$permisos]); 
        }

        // ======================== CREATE=========================
        public function create($request) {
            $usuarios = $this->USUARIO->all();
            $modulos = $this->MODULO->all();
            return $this->view('permisos/crear',['usuarios'=>$usuarios,'modulos'=>$modulos]);
        }

        // ======================== STORE=========================
        public function store($permisos) {
            $this->PERMISOS->create([
                'consultar'=>$permisos['consultar'],
                'actualizar'=>$permisos['actualizar'],
                'crear'=>$permisos['crear'],
                'eliminar'=>$permisos['eliminar'],
                'idusuario'=>$permisos['idusuario'],
                'idmodulo'=>$permisos['idmodulo'],
            ])->save();
            return $this->redirect('permisos');
        }

        // ======================== EDIT=========================
        public function edit($request){
            $usuarios = $this->USUARIO->usersname();
            $permisos = $this->PERMISOS->find($request['permisos']);
            if ($permisos) {
                return $this->view('permisos/editar', ['permisos' => $permisos->fillable, 'usuarios'=>$usuarios]);
            } else {
                return $this->page('errors/404');
            }
        }

        // ======================== UPDATE=========================
        public function update($request) {
            if(!$permisos = $this->PERMISOS->find($_GET['idpermisos'])){ return $this->page('errors/404'); }
                $permisos->actualizar([
                    'consultar'=> '"'.$request['consultar'].'"', 
                    'actualizar'=> '"'.$request['actualizar'].'"', 
                    'crear'=> '"'.$request['crear'].'"', 
                    'eliminar'=> '"'.$request['eliminar'].'"', 
                    'idusuario'=> '"'.$request['idusuario'].'"', 
                    //'idmodulo'=> '"'.$request['idmodulo'].'"',  
                ]);
                return $this->redirect('permisos');
            }

        // ======================== DELETE=========================
        public function delete($request)
        {
        
            $permisos = $this->PERMISOS->find($request['idpermisos']);
             return $permisos ? $permisos->eliminar() : $this->page('errors/404');
        }
        
            




  

    }// ========================/ CLASS=========================
?>
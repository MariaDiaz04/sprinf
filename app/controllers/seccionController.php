<?php 
use App\controllers\controller;
use App\permisos;
use App\seccion;

class seccionController extends controller
{
	public $SECCION;
    public $PERMISOS;

	function __construct () {	
		$this->SECCION = new seccion ();
        $this->PERMISOS = new permisos();


	}

    public function index() {
   

		$seccion = $this->SECCION->all();
		return $this->view('seccion/seccion', ['seccion'=>$seccion]); 

}

public function create($request)
{
    return $this->view('seccion/crear');
}

public function store($seccion) {

    $guardar =$this->SECCION->create([
    'nombre'=>$seccion['nombre'],
    
    ])->save();

    if ($guardar == null) {
        echo '
        <script> 
            window.alert(" La Sección  ya esta registrada")
        </script>';
        header("refresh:1 http://localhost/mbca/public/?r=seccion");


    }else{
        return $this->redirect('seccion');

    }

}

public function edit($request){
    $seccion = $this->SECCION->find($request['seccion']);
    if ($seccion) {
        return $this->view('seccion/editar', ['seccion' => $seccion->fillable]);

        } else {

        return $this->page('errors/404');

    }


}
public function update($request) {


    if(!$seccion = $this->SECCION->find($_GET['idseccion'])){ return $this->page('errors/404'); }
    $seccion->actualizar([
        'nombre'=> '"'.$request['nombre'].'"',
        'estatus'=> '"'.$request['estatus'].'"',  
    ]);
    return $this->redirect('seccion');
}


public function delete($request)
{
    $seccion = $this->SECCION->find($request['idse$seccion']);
    return $seccion ? $seccion->eliminar() : $this->page('errors/404');
}
<?php 
require '../app/bitacora.php';

class bitacoraController extends controller
{
	public $BITACORA;

	function __construct () {	
		$this->BITACORA = new bitacora();


	}

	public function index() {

		$bitacora = $this->BITACORA->bitacora_all();


		return $this->view('security/bitacora', ['bitacora'=>$bitacora]); 

}

  

}
 ?>
<?php

namespace Controllers;
use Model\usuario;
use Model\proyecto;



class reporteMunicipioController extends controller
{
    public $USUARIO;
    public $PROYECTO;


	function __construct () {	
        $this->tokenExist();
        $this->USUARIO = new usuario();
        $this->PROYECTO = new proyecto();
	}

    public function index()
    {

        $proyectosMunicipios = $this->PROYECTO->findByMunicipios();
        $Crespo = $proyectosMunicipios['Crespo'];
        $Iribarren = $proyectosMunicipios['Iribarren'];
        $Jimenez = $proyectosMunicipios['Jimenez'];
        $Moran = $proyectosMunicipios['Moran'];
        $Palavecino = $proyectosMunicipios['Palavecino'];
        $SimonPlanas = $proyectosMunicipios['SimonPlanas'];
        $Torres = $proyectosMunicipios['Torres'];
        $Urdaneta = $proyectosMunicipios['Urdaneta'];

        return $this->view('reportesn/reporte_municipio', [
            'Crespo' => $Crespo, 'Iribarren' => $Iribarren, 'Jimenez' => $Jimenez, 'Moran' => $Moran, 'Palavecino' => $Palavecino,
            'SimonPlanas' => $SimonPlanas, 'Torres' => $Torres, 'Urdaneta' => $Urdaneta,
        ]);
    }

}

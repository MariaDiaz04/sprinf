<?php

use Symfony\Component\Routing\Route;
use Controllers\reporteMunicipioController;


$listaDeRutas['reporte_municipio'] =  new Route(

  '/reporte-municipio',
  [
    'controller' => reporteMunicipioController::class,
    'method' => 'index',
  ], 
);
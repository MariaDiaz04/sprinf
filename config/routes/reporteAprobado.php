<?php

use Symfony\Component\Routing\Route;
use Controllers\reporteAprobadoController;


$listaDeRutas['reporte_aprobado'] =  new Route(

  '/reporte-aprobado',
  [
    'controller' => reporteAprobadoController::class,
    'method' => 'index',
  ], 
);
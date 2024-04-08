<?php

use Symfony\Component\Routing\Route;
use Controllers\reportesnController;


$listaDeRutas['reportesn'] =  new Route(

  '/reportesn',
  [
    'controller' => reportesnController::class,
    'method' => 'index',
  ], 
);

$listaDeRutas['listar_trayectos'] = new Route(
  '/reporte/listar-trayectos',
  [
    'controller' => reportesnController::class,
    'method' => 'listar_trayectos',
  ]
);

$listaDeRutas['listar_secciones'] = new Route(
  '/reporte/listar-secciones',
  [
    'controller' => reportesnController::class,
    'method' => 'listar_secciones',
  ]
);
<?php

use Symfony\Component\Routing\Route;
use Controllers\trayectosController;
# GESTION DE TRAYECTOS
$listaDeRutas['trayecto_manage'] =  new Route(

  '/trayectos',
  [
    'controller' => trayectosController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['trayecto_edit'] =  new Route(

  '/trayectos/edit/{id}',
  [
    'controller' => trayectosController::class,
    'method' => 'edit',
  ]
);

$listaDeRutas['/trayectos/guardar'] =  new Route(

  '/trayectos/guardar',
  [
    'controller' => trayectosController::class,
    'method' => 'store',
  ]
);

$listaDeRutas['trayecto_ssp'] =  new Route(

  '/trayectos/ssp',
  [
    'controller' => trayectosController::class,
    'method' => 'ssp',
  ]
);

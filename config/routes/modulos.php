<?php

use Symfony\Component\Routing\Route;
use Controllers\moduloController;

$listaDeRutas['modulos'] =  new Route(

  '/modulos',
  [
    'controller' => moduloController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['modulos/crear'] =  new Route(

  '/modulos/crear',
  [
    'controller' => moduloController::class,
    'method' => 'create',
  ]
);


$listaDeRutas['/modulos/guardar'] =  new Route(

  '/modulos/guardar',
  [
    'controller' => moduloController::class,
    'method' => 'store',
  ]
);

$listaDeRutas['modulos/editar/{id}'] =  new Route(

  '/modulos/editar/{id}',
  [
    'controller' => moduloController::class,
    'method' => 'edit',
  ]
);
$listaDeRutas['modulos/actualizar/{id}'] =  new Route(

  '/modulos/actualizar/{id}',
  [
    'controller' => moduloController::class,
    'method' => 'update',
  ]
);

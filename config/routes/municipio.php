<?php

use Symfony\Component\Routing\Route;
use Controllers\municipiosController;

$listaDeRutas['municipios'] =  new Route(

  '/municipios',
  [
    'controller' => municipiosController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['municipio/crear'] =  new Route(

  '/municipio/crear',
  [
    'controller' => municipiosController::class,
    'method' => 'create',
  ]
);


$listaDeRutas['/municipio/guardar'] =  new Route(

  '/municipio/guardar',
  [
    'controller' => municipiosController::class,
    'method' => 'store',
  ]
);

$listaDeRutas['municipio/editar/{id}'] =  new Route(

  '/municipio/editar/{id}',
  [
    'controller' => municipiosController::class,
    'method' => 'edit',
  ]
);
$listaDeRutas['municipio/actualizar/{id}'] =  new Route(

  '/municipio/actualizar/{id}',
  [
    'controller' => municipiosController::class,
    'method' => 'update',
  ]
);

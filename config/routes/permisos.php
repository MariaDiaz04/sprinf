<?php

use Symfony\Component\Routing\Route;
use Controllers\permisosController;

$listaDeRutas['/permisos'] = new Route(

  '/permisos',
  [
    'controller' => permisosController::class,
    'method' => 'index',
  ]
);
$listaDeRutas['/permisos/crear'] = new Route(

  '/permisos/crear',
  [
    'controller' => permisosController::class,
    'method' => 'create',
  ]
);
$listaDeRutas['/permisos/guardar'] = new Route(

  '/permisos/guardar',
  [
    'controller' => permisosController::class,
    'method' => 'store',
  ]
);
$listaDeRutas['/permisos/eliminar'] = new Route(

  '/permisos/eliminar',
  [
    'controller' => permisosController::class,
    'method' => 'delete',
  ]
);
$listaDeRutas['/permisos/editar/{id}'] = new Route(

  '/permisos/editar/{id}',
  [
    'controller' => permisosController::class,
    'method' => 'edit',
  ]
);
$listaDeRutas['/permisos/actualizar/{id}'] = new Route(

  '/permisos/actualizar/{id}',
  [
    'controller' => permisosController::class,
    'method' => 'update',
  ]
);

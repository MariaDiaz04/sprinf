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
$listaDeRutas['/permisos/crear/{id}'] = new Route(

  '/permisos/crear/{id}',
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
$listaDeRutas['/permisos/editar/{id}/rol/{rol}'] = new Route(

  '/permisos/editar/{id}/rol/{rol}',
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
$listaDeRutas['/permisos/consultar/{id}'] = new Route(

  '/permisos/consultar/{id}',
  [
    'controller' => permisosController::class,
    'method' => 'consultar',
  ]
);
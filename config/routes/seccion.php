<?php

use Symfony\Component\Routing\Route;
use Controllers\seccionController;

$listaDeRutas['seccion_manage'] = new Route(
  '/seccion',
  [
    'controller' => seccionController::class,
    'method' => 'index',
  ]
);
# GESTION DE Secciones
$listaDeRutas['seccion_edit'] = new Route(
  '/seccion/edit',
  [
    'controller' => seccionController::class,
    'method' => 'edit',
  ]
);

$listaDeRutas['/'] = new Route(
  '/seccion/guardar',
  [
    'controller' => seccionController::class,
    'method' => 'store',
  ]
);

$listaDeRutas['seccion_ssp'] = new Route(
  '/seccion/ssp',
  [
    'controller' => seccionController::class,
    'method' => 'ssp',
  ]
);

# GESTION DE Secciones
$listaDeRutas['seccion_update'] = new Route(
  '/seccion/update',
  [
    'controller' => seccionController::class,
    'method' => 'update',
  ]
);

# GESTION DE Secciones
$listaDeRutas['seccion_delete'] = new Route(
  '/seccion/delete',
  [
    'controller' => seccionController::class,
    'method' => 'delete',
  ]
);
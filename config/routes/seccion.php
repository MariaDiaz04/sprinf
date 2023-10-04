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
  '/seccion/edit/{id}',
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

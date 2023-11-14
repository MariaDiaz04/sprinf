<?php

use Symfony\Component\Routing\Route;
use Controllers\dimensionController;
use Controllers\indicadoresController;
use Model\indicadores;

$listaDeRutas['dimension_edit'] = new Route(

  '/dimensiones/obtener/{id}',
  [
    'controller' => dimensionController::class,
    'method' => 'obtener',
  ]
);

$listaDeRutas['dimension_delete'] = new Route(

  '/dimensiones/borrar',
  [
    'controller' => dimensionController::class,
    'method' => 'borrar',
  ]
);

$listaDeRutas['/dimensiones/guardar'] = new Route(

  '/dimensiones/guardar',
  [
    'controller' => dimensionController::class,
    'method' => 'store',
  ]
);
$listaDeRutas['/dimensiones/actualizar'] = new Route(

  '/dimensiones/actualizar',
  [
    'controller' => dimensionController::class,
    'method' => 'update',
  ]
);

$listaDeRutas['dimensiones/ssp/{codigoMateria}'] = new Route(

  '/dimensiones/ssp/{codigoMateria}',
  [
    'controller' => dimensionController::class,
    'method' => 'ssp',
  ]
);

$listaDeRutas['dimension_manage'] = new Route(

  '/dimensiones/{codigoMateria}',
  [
    'controller' => dimensionController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['indicadores_manage'] = new Route(

  '/indicadores/{idDimension}',
  [
    'controller' => indicadoresController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['indicadores_obtener'] = new Route(
  '/indicador/obtener/{id}',
  [
    'controller' => indicadoresController::class,
    'method' => 'obtener',
  ]
);

$listaDeRutas['indicadores_create'] = new Route(
  '/indicador/guardar',
  [
    'controller' => indicadoresController::class,
    'method' => 'store',
  ]
);

$listaDeRutas['indicadores_update'] = new Route(
  '/indicador/actualizar',
  [
    'controller' => indicadoresController::class,
    'method' => 'update',
  ]
);

$listaDeRutas['indicadores_borrar'] = new Route(
  '/indicador/borrar',
  [
    'controller' => indicadoresController::class,
    'method' => 'delete',
  ]
);

$listaDeRutas['indicadores_ssp'] = new Route(

  '/indicadores/ssp/{idDimension}',
  [
    'controller' => indicadoresController::class,
    'method' => 'ssp',
  ]
);

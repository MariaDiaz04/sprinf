<?php

use Symfony\Component\Routing\Route;
use Controllers\dimensionController;


$listaDeRutas['dimension_edit'] = new Route(

  '/dimension/edit/{id}',
  [
    'controller' => dimensionController::class,
    'method' => 'edit',
  ]
);

$listaDeRutas['/dimensiones/guardar'] = new Route(

  '/dimensiones/guardar',
  [
    'controller' => dimensionController::class,
    'method' => 'store',
  ]
);

$listaDeRutas['dimensiones/ssp/{idTrayecto}'] = new Route(

  '/dimensiones/ssp/{idTrayecto}',
  [
    'controller' => dimensionController::class,
    'method' => 'ssp',
  ]
);

$listaDeRutas['dimension_manage'] = new Route(

  '/dimensiones/{idTrayecto}',
  [
    'controller' => dimensionController::class,
    'method' => 'index',
  ]
);

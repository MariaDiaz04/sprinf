<?php

use Symfony\Component\Routing\Route;
use Controllers\baremosController;

$listaDeRutas['baremos_manage'] = new Route(
  '/baremos/{idTrayecto}',
  [
    'controller' => baremosController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['baremos/ssp/{idTrayecto}'] = new Route(

  '/baremos/ssp/{idTrayecto}',
  [
    'controller' => baremosController::class,
    'method' => 'ssp',
  ]
);

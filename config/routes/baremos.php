<?php

use Symfony\Component\Routing\Route;
use Controllers\baremosController;

$listaDeRutas['baremos_manage'] = new Route(
  '/baremos',
  [
    'controller' => baremosController::class,
    'method' => 'index',
  ]
);
$listaDeRutas['baremos_edit'] = new Route(
  '/baremos/edit/{id}',
  [
    'controller' => baremosController::class,
    'method' => 'edit',
  ]
);

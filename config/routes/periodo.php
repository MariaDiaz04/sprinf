<?php

use Symfony\Component\Routing\Route;
use App\controllers\periodoController;

# GESTION DE PERIODOS
$listaDeRutas['periodo_manage'] = new Route(

  '/periodos',
  [
    'controller' => periodoController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['periodo_edit'] = new Route(

  '/periodos/edit/{id}',
  [
    'controller' => periodoController::class,
    'method' => 'edit',
  ]
);

$listaDeRutas['/periodos/guardar'] = new Route(
  '/periodos/guardar',
  [
    'controller' => periodoController::class,
    'method' => 'store',
  ]
);

$listaDeRutas['periodo_ssp'] = new Route(

  '/periodos/ssp',
  [
    'controller' => periodoController::class,
    'method' => 'ssp',
  ]
);

<?php

use Symfony\Component\Routing\Route;
use Controllers\sectorController;

$listaDeRutas['sector_manage'] = new Route(
  '/sector',
  [
    'controller' => sectorController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['sector_edit'] = new Route(
  '/sector/edit',
  [
    'controller' => sectorController::class,
    'method' => 'edit',
  ]
);

$listaDeRutas['sector_guardar'] = new Route(
  '/sector/guardar',
  [
    'controller' => sectorController::class,
    'method' => 'store',
  ]
);

$listaDeRutas['sector_ssp'] = new Route(
  '/sector/ssp',
  [
    'controller' => sectorController::class,
    'method' => 'ssp',
  ]
);

# GESTION DE SECTOR
$listaDeRutas['sector_update'] = new Route(
  '/sector/update',
  [
    'controller' => sectorController::class,
    'method' => 'update',
  ]
);

# GESTION DE SECTOR
$listaDeRutas['sector_delete'] = new Route(
  '/sector/delete',
  [
    'controller' => sectorController::class,
    'method' => 'delete',
  ]
);
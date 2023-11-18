<?php

use Symfony\Component\Routing\Route;
use Controllers\consejoComunalController;

$listaDeRutas['consejoComunal_manage'] = new Route(
  '/consejoComunal',
  [
    'controller' => consejoComunalController::class,
    'method' => 'index',
  ]
);
# GESTION De Consejo Comunal
$listaDeRutas['consejoComunal_edit'] = new Route(
  '/consejoComunal/edit',
  [
    'controller' => consejoComunalController::class,
    'method' => 'edit',
  ]
);

$listaDeRutas['consejoComunal_guardar'] = new Route(
  '/consejoComunal/guardar',
  [
    'controller' => consejoComunalController::class,
    'method' => 'store',
  ]
);

$listaDeRutas['consejoComunal_ssp'] = new Route(
  '/consejoComunal/ssp',
  [
    'controller' => consejoComunalController::class,
    'method' => 'ssp',
  ]
);

# GESTION DE Consejo Comunal
$listaDeRutas['consejoComunal_update'] = new Route(
  '/consejoComunal/update',
  [
    'controller' => consejoComunalController::class,
    'method' => 'update',
  ]
);

# GESTION DE Consejo Comunal
$listaDeRutas['consejoComunal_delete'] = new Route(
  '/consejoComunal/delete',
  [
    'controller' => consejoComunalController::class,
    'method' => 'delete',
  ]
);
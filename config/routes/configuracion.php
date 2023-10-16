<?php

use Symfony\Component\Routing\Route;
use Controllers\configuracionController;
use Controllers\proyectoController;
use Controllers\respaldoController;

$listaDeRutas['configuracion/cerrar'] = new Route(
  '/configuracion/cerrar',
  [
    'controller' => configuracionController::class,
    'method' => 'cerrarPeriodo',
  ]
);

$listaDeRutas['configuracion/aperturar-periodo'] = new Route(
  '/configuracion/aperturar-periodo',
  [
    'controller' => configuracionController::class,
    'method' => 'periodo',
  ]
);

$listaDeRutas['configuracion/excel'] = new Route(
  '/configuracion/excel',
  [
    'controller' => proyectoController::class,
    'method' => 'exportExcel',
  ]
);

$listaDeRutas['respaldo'] = new Route(
  '/respaldo',
  [
    'controller' => respaldoController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['respaldar'] = new Route(
  '/respaldo/respaldar',
  [
    'controller' => respaldoController::class,
    'method' => 'respaldar',
  ]
);

$listaDeRutas['restaurar'] = new Route(
  '/respaldo/restaurar',
  [
    'controller' => respaldoController::class,
    'method' => 'restaurar',
  ]
);

$listaDeRutas['respaldar/verificarPassword'] = new Route(
  '/respaldo/verificarPassword',
  [
    'controller' => respaldoController::class,
    'method' => 'verificarPassword',
  ]
);

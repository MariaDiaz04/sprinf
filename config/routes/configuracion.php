<?php

use Symfony\Component\Routing\Route;
use Controllers\configuracionController;
use Controllers\proyectoController;

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

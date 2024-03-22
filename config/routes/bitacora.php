<?php

use Symfony\Component\Routing\Route;
use Controllers\bitacoraController;
use Controllers\bitacoraAccionesController;

# FIN DE GESTIÓN DE BAREMOS

$listaDeRutas['bitacora'] =  new Route(

  '/bitacora',
  [
    'controller' => bitacoraController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['acciones'] =  new Route(
  '/acciones',
  [
    'controller' => bitacoraAccionesController::class,
    'method' => 'index',
  ]
);

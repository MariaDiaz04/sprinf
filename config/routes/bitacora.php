<?php

use Symfony\Component\Routing\Route;
use Controllers\bitacoraController;
# FIN DE GESTIÓN DE BAREMOS

$listaDeRutas['bitacora'] =  new Route(

  '/bitacora',
  [
    'controller' => bitacoraController::class,
    'method' => 'index',
  ]
);

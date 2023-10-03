<?php

use Symfony\Component\Routing\Route;
use App\controllers\bitacoraController;
# FIN DE GESTIÓN DE BAREMOS

$listaDeRutas['bitacora'] =  new Route(

  '/bitacora',
  [
    'controller' => bitacoraController::class,
    'method' => 'index',
  ]
);

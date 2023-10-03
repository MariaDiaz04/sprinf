<?php

use Symfony\Component\Routing\Route;
use App\controllers\userController;

$listaDeRutas['usuarioCrear'] = new Route(
  '/usuarioCrear',
  [
    'controller' => userController::class,
    'method' => 'create',
  ]
);
$listaDeRutas['usuarioGuardar'] = new Route(
  '/usuarioGuardar',
  [
    'controller' => userController::class,
    'method' => 'store',
  ]
);
$listaDeRutas['/usuario/editar/{id}'] = new Route(
  '/usuario/editar/{id}',
  [
    'controller' => userController::class,
    'method' => 'edit',
  ]
);
$listaDeRutas['/usuario/actualizar/{id}'] = new Route(
  '/usuario/actualizar/{id}',
  [
    'controller' => userController::class,
    'method' => 'update',
  ]
);

<?php

use Symfony\Component\Routing\Route;
use Controllers\profesorController;
use Controllers\userController;


$listaDeRutas['profesor'] = new Route(

  '/profesor',
  [
    'controller' => userController::class,
    'method' => 'profesor',
  ]
);


// GESTION DE PROFESORES
$listaDeRutas['profesor_manage'] = new Route(

  '/profesores',
  [
    'controller' => profesorController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['profesor_details'] = new Route(

  '/profesores/showDetails',
  [
    'controller' => profesorController::class,
    'method' => 'showDetails',
  ]
);

$listaDeRutas['profesor_edit'] = new Route(

  '/profesores/edit',
  [
    'controller' => profesorController::class,
    'method' => 'edit',
  ]
);

$listaDeRutas['/profesores/guardar'] = new Route(

  '/profesores/guardar',
  [
    'controller' => profesorController::class,
    'method' => 'store',
  ]
);

$listaDeRutas['/profesorer_actualizar'] = new Route(

  '/profesores/actualizar',
  [
    'controller' => profesorController::class,
    'method' => 'update',
  ]
);

$listaDeRutas['/profesorer_delete'] = new Route(

  '/profesores/delete',
  [
    'controller' => profesorController::class,
    'method' => 'delete',
  ]
);

$listaDeRutas['profesor_ssp'] = new Route(

  '/profesores/ssp',
  [
    'controller' => profesorController::class,
    'method' => 'ssp',
  ]
);

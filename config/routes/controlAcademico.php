<?php

use Symfony\Component\Routing\Route;
use Controllers\controlAcademicoController;


$listaDeRutas['control_academico'] = new Route(

  '/control_academico',
  [
    'controller' => controlAcademicoController::class,
    'method' => 'index',
  ]
);


$listaDeRutas['control_academico/details'] = new Route(

  '/control_academico/showDetails',
  [
    'controller' => controlAcademicoController::class,
    'method' => 'showDetails',
  ]
);

$listaDeRutas['control_academico/edit'] = new Route(

  '/control_academico/edit',
  [
    'controller' => controlAcademicoController::class,
    'method' => 'edit',
  ]
);

$listaDeRutas['/control_academico/guardar'] = new Route(

  '/control_academico/guardar',
  [
    'controller' => controlAcademicoController::class,
    'method' => 'store',
  ]
);

$listaDeRutas['/control_academico/actualizar'] = new Route(

  '/control_academico/actualizar',
  [
    'controller' => controlAcademicoController::class,
    'method' => 'update',
  ]
);

$listaDeRutas['/profesorer_delete'] = new Route(

  '/profesores/delete',
  [
    'controller' => controlAcademicoController::class,
    'method' => 'delete',
  ]
);

$listaDeRutas['control_academico_ssp'] = new Route(

  '/control_academico/ssp',
  [
    'controller' => controlAcademicoController::class,
    'method' => 'ssp',
  ]
);

<?php

use Symfony\Component\Routing\Route;
use App\controllers\materiasController;


$listaDeRutas['materias'] = new Route(
  '/materias/{idTrayecto}',
  [
    'controller' => materiasController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['materia_guardar'] = new Route(
  '/materias/guardar',
  [
    'controller' => materiasController::class,
    'method' => 'store',
  ]
);

$listaDeRutas['materia_editar'] = new Route(
  '/materias/edit',
  [
    'controller' => materiasController::class,
    'method' => 'edit',
  ]
);

$listaDeRutas['materia_update'] = new Route(
  '/materias/update',
  [
    'controller' => materiasController::class,
    'method' => 'update',
  ]
);

$listaDeRutas['materia_delete'] = new Route(
  '/materias/delete',
  [
    'controller' => materiasController::class,
    'method' => 'delete',
  ]
);

$listaDeRutas['materia_ssp'] = new Route(
  '/materias/ssp/{idTrayecto}',
  [
    'controller' => materiasController::class,
    'method' => 'ssp',
  ]
);

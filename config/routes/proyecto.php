<?php

use Symfony\Component\Routing\Route;
use Controllers\proyectoController;
# FIN DE GESTIÓN DE BAREMOS

# GESTION DE PROYECTOS
$listaDeRutas['proyectos'] = new Route(
  '/proyectos',
  [
    'controller' => proyectoController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['proyectos_evaluar'] = new Route(
  '/proyectos/assessment/{id}',
  [
    'controller' => proyectoController::class,
    'method' => 'assessment'
  ]
);

$listaDeRutas['proyectos_actualizar'] = new Route(
  '/proyectos/actualizar',
  [
    'controller' => proyectoController::class,
    'method' => 'update',
  ]
);

$listaDeRutas['/proyectos/crear'] = new Route(
  '/proyectos/crear',
  [
    'controller' => proyectoController::class,
    'method' => 'create',
  ]
);

$listaDeRutas['/proyectos/guardar'] = new Route(
  '/proyectos/guardar',
  [
    'controller' => proyectoController::class,
    'method' => 'store',
  ]
);
$listaDeRutas['proyectos_update'] = new Route(
  '/proyectos/update',
  [
    'controller' => proyectoController::class,
    'method' => 'update',
  ]
);
$listaDeRutas['proyectos_delete'] = new Route(
  '/proyectos/borrar',
  [
    'controller' => proyectoController::class,
    'method' => 'delete',
  ]
);

$listaDeRutas['proyectos_ssp'] = new Route(
  '/proyectos/ssp',
  [
    'controller' => proyectoController::class,
    'method' => 'ssp',
  ]
);


// EVALUACION DE PROYECTO



$listaDeRutas['proyectos_subir-notas_baremos'] = new Route(
  '/proyectos/subir-notas',
  [
    'controller' => proyectoController::class,
    'method' => 'subirNotas',
  ]
);
$listaDeRutas['proyectos_evaluar_baremos'] = new Route(
  '/proyectos/evaluar',
  [
    'controller' => proyectoController::class,
    'method' => 'evaluar',
  ]
);

// HISTORICO

$listaDeRutas['proyectos_historico'] = new Route(
  '/proyectos/historico',
  [
    'controller' => proyectoController::class,
    'method' => 'historico',
  ]
);

$listaDeRutas['proyectos_show'] = new Route(
  '/proyectos/{id}',
  [
    'controller' => proyectoController::class,
    'method' => 'obtener',
  ]
);

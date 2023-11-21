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

$listaDeRutas['proyectos/pending-students'] = new Route(
  '/proyectos/pending-students',
  [
    'controller' => proyectoController::class,
    'method' => 'pendingStudents',
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

$listaDeRutas['proyectos_reprobados'] = new Route(
  '/proyectos/reprobados/{idProyecto}',
  [
    'controller' => proyectoController::class,
    'method' => 'reprobados',
  ]
);
$listaDeRutas['proyectos_aprobar'] = new Route(
  '/proyectos/aprobar',
  [
    'controller' => proyectoController::class,
    'method' => 'aprobar',
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
$listaDeRutas['proyectos_obtener_baremos'] = new Route(
  '/proyectos/obtener-baremos/{codigo}',
  [
    'controller' => proyectoController::class,
    'method' => 'obtenerBaremos',
  ]
);

$listaDeRutas['proyectos_notas'] = new Route(
  'proyectnotes/pdf/{id}',
  [
    'controller' => proyectoController::class,
    'method' => 'noteProyectPDF',
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

// reportes
$listaDeRutas['notas_proyecto'] = new Route(
  '/proyectos/calificaciones/{idIntegrante}',
  [
    'controller' => proyectoController::class,
    'method' => 'notasIntegrante',
  ]
);

$listaDeRutas['proyectos_show'] = new Route(
  '/proyectos/{id}',
  [
    'controller' => proyectoController::class,
    'method' => 'obtener',
  ]
);

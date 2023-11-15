<?php

use Symfony\Component\Routing\Route;
use Controllers\inscripcionController;

// GESTION DE INSCRIPCION
$listaDeRutas['inscripcion/ssp/{idMateria}'] =  new Route(

  '/inscripcion/ssp/{idMateria}',
  [
    'controller' => inscripcionController::class,
    'method' => 'ssp',
  ]
);
$listaDeRutas['inscripcion'] =  new Route(

  '/materias/{codigoTrayecto}/{idMateria}',
  [
    'controller' => inscripcionController::class,
    'method' => 'index',
  ]
);

$listaDeRutas['inscripcion/obtener'] =  new Route(

  '/inscripcion/obtener',
  [
    'controller' => inscripcionController::class,
    'method' => 'obtener',
  ]
);
$listaDeRutas['inscripcion/crear'] =  new Route(

  '/inscripcion/crear',
  [
    'controller' => inscripcionController::class,
    'method' => 'store',
  ]
);

$listaDeRutas['inscripcion/evaluar'] =  new Route(

  '/inscripcion/evaluar',
  [
    'controller' => inscripcionController::class,
    'method' => 'evaluar',
  ]
);

$listaDeRutas['inscripcion/borrar'] =  new Route(

  '/inscripcion/borrar',
  [
    'controller' => inscripcionController::class,
    'method' => 'delete',
  ]
);

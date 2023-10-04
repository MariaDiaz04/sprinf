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
$listaDeRutas['inscripcion/{idMateria}'] =  new Route(

  '/inscripcion/{idMateria}',
  [
    'controller' => inscripcionController::class,
    'method' => 'index',
  ]
);

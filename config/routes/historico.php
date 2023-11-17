<?php

use Symfony\Component\Routing\Route;
use Controllers\historicoController;

// GESTION DE INSCRIPCION
$listaDeRutas['historico'] =  new Route(

  '/historico',
  [
    'controller' => historicoController::class,
    'method' => 'index'
  ]
);

$listaDeRutas['historico_ssp'] =  new Route(

  '/historico/ssp',
  [
    'controller' => historicoController::class,
    'method' => 'ssp'
  ]
);

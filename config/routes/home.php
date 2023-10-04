<?php

use Symfony\Component\Routing\Route;
use Controllers\homeController;

// LOGIN
$listaDeRutas['home'] = new Route(
  '/home',
  [
    'controller' => homeController::class,
    'method' => 'index',
  ]
);

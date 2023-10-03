<?php

use Symfony\Component\Routing\Route;
use App\controllers\homeController;

// LOGIN
$listaDeRutas['home'] = new Route(
  '/home',
  [
    'controller' => homeController::class,
    'method' => 'index',
  ]
);

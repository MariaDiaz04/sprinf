<?php

use Symfony\Component\Routing\Route;

$listaDeRutas['index'] = new Route(
  '/',
  [
    'controller' => authController::class,
    'method' => 'index',
  ]
);
$listaDeRutas['login'] = new Route(
  '/login',
  [
    'controller' => authController::class,
    'method' => 'login',
  ]
);
$listaDeRutas['logout'] = new Route(
  '/logout',
  [
    'controller' => authController::class,
    'method' => 'logout',
  ]
);

$listaDeRutas['inactive'] = new Route(
  '/inactive',
  [
    'controller' => authController::class,
    'method' => 'inactive',
  ]
);

$listaDeRutas['invalid'] = new Route(
  '/invalid',
  [
    'controller' => authController::class,
    'method' => 'invalid',
  ]
);

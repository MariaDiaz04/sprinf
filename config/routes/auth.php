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

$listaDeRutas['forgot-password'] = new Route(
  '/forgot-password',
  [
    'controller' => authController::class,
    'method' => 'forgot',
  ]
);

$listaDeRutas['verification'] = new Route(
  '/verification',
  [
    'controller' => authController::class,
    'method' => 'verification',
  ]
);

$listaDeRutas['actualizarContrasena'] = new Route(
  '/actualizarContrasena',
  [
    'controller' => authController::class,
    'method' => 'actualizarContrasena',
  ]
);

$listaDeRutas['questions'] = new Route(
  '/questions',
  [
    'controller' => authController::class,
    'method' => 'questions',
  ]
);

$listaDeRutas['saveQuestions'] = new Route(
  '/saveQuestions',
  [
    'controller' => authController::class,
    'method' => 'saveQuestions',
  ]
);
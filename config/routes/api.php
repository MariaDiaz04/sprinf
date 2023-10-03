<?php

use Symfony\Component\Routing\Route;

// LOGIN
$listaDeRutas['api_login'] = new Route(
  '/api/auth/login',
  [
    'controller' => API\auth::class,
    'method' => 'login',
  ]
);

// INFORMACION DE USUARIO
$listaDeRutas['api_show'] = new Route(
  '/api/user',
  [
    'controller' => API\user::class,
    'method' => 'show',
  ]
);

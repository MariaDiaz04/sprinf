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

// INFORMACION DE USUARIO
$listaDeRutas['api_reports'] = new Route(
  '/api/project-report/{idTrayecto}',
  [
    'controller' => API\reports::class,
    'method' => 'download',
  ]
);

$listaDeRutas['api_proyectos'] = new Route(
  '/api/proyectos',
  [
    'controller' => API\proyectos::class,
    'method' => 'obtener',
  ]
);

 $listaDeRutas['api_proyectos'] = new Route(
  '/api/proyecto/{proyecto_id}',
  [
    'controller' => API\proyectos::class,
    'method' => 'obtenerUno',
  ]
);

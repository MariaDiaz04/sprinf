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

$listaDeRutas['api_baremos'] = new Route(
  '/api/baremos',
  [
    'controller' => API\baremos::class,
    'method' => 'obtener',
  ]
);

$listaDeRutas['api_estudiantes'] = new Route(
  '/api/estudiantes',
  [
    'controller' => API\estudiantes::class,
    'method' => 'obtener',
  ]
);
$listaDeRutas['api_estudiantes_listar'] = new Route(
  '/api/estudiantes/listar',
  [
    'controller' => API\estudiantes::class,
    'method' => 'listar',
  ]
);
$listaDeRutas['api_proyectos_id'] = new Route(
  '/api/proyecto/{proyecto_id}',
  [
    'controller' => API\proyectos::class,
    'method' => 'obtenerUno',
  ]
);

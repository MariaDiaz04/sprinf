<?php
require __DIR__ . '/../vendor/autoload.php';

/* use App\Controllers\AuthenticationController;
use App\Controllers\DashboardController; */

use App\controllers\periodoController;
use App\controllers\aspectosController;
use App\controllers\baremosController;
use App\controllers\dimensionController;
use App\controllers\proyectoController;
use App\controllers\homeController;
use App\controllers\moduloController;
use App\seccion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

if ($_ENV['ENVIRONMENT'] != "production") {
    // Show errors
    error_reporting(-1);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
}

// Start session
session_start();

// Create a server request object form global variables of PHP.
//    $_SERVER
//    $_GET
//    $_POST
//    $_COOKIE
//    $_FILES
$request = Request::createFromGlobals();

// Get a context of request.
$context = new RequestContext();
$context->fromRequest($request);

// Create the router container and get the routing map.
$routes = new RouteCollection();

$routes->add('index', new Route(
    '/',
    [
        'controller' => authController::class,
        'method' => 'index',
    ]
));
$routes->add('login', new Route(
    '/login',
    [
        'controller' => authController::class,
        'method' => 'login',
    ]
));
$routes->add('logout', new Route(
    '/logout',
    [
        'controller' => authController::class,
        'method' => 'logout',
    ]
));

$routes->add('inactive', new Route(
    '/inactive',
    [
        'controller' => authController::class,
        'method' => 'inactive',
    ]
));

$routes->add('invalid', new Route(
    '/invalid',
    [
        'controller' => authController::class,
        'method' => 'invalid',
    ]
));

$routes->add('home', new Route(

    '/home',
    [
        'controller' => homeController::class,
        'method' => 'index',
    ]
));

$routes->add('profesor', new Route(

    '/profesor',
    [
        'controller' => userController::class,
        'method' => 'profesor',
    ]
));

$routes->add('estudiante', new Route(

    '/estudiante',
    [
        'controller' => userController::class,
        'method' => 'estudiante',
    ]
));

$routes->add('seccion', new Route(

    //  var_dump('asa'),
    '/seccion',
    [
        'controller' => seccionController::class,
        'method' => 'index',
    ]
));
$routes->add('seccionCrear', new Route(


    '/seccionCrear',
    [
        'controller' => seccionController::class,
        'method' => 'create',
    ]
));

$routes->add('seccionGuardar', new Route(

    '/seccionGuardar',
    [
        'controller' => seccionController::class,
        'method' => 'store',
    ]
));


$routes->add('materias', new Route(


    '/materias',
    [
        'controller' => materiasController::class,
        'method' => 'index',
    ]
));
$routes->add('materiasCrear', new Route(


    '/materiasCrear',
    [
        'controller' => materiasController::class,
        'method' => 'create',
    ]
));

$routes->add('materiasGuardar', new Route(

    '/materiasGuardar',
    [
        'controller' => materiasController::class,
        'method' => 'store',
    ]
));
$routes->add('usuarioCrear', new Route(

    '/usuarioCrear',
    [
        'controller' => userController::class,
        'method' => 'create',
    ]
));

$routes->add('usuarioGuardar', new Route(

    '/usuarioGuardar',
    [
        'controller' => userController::class,
        'method' => 'store',
    ]
));

$routes->add('/usuario/editar/{id}', new Route(

    '/usuario/editar/{id}',
    [
        'controller' => userController::class,
        'method' => 'edit',
    ]
));

$routes->add('/usuario/actualizar/{id}', new Route(

    '/usuario/actualizar/{id}',
    [
        'controller' => userController::class,
        'method' => 'update',
    ]
));

# GESTION DE PERIODOS
$routes->add('periodo_manage', new Route(

    '/periodos',
    [
        'controller' => periodoController::class,
        'method' => 'index',
    ]
));

$routes->add('periodo_edit', new Route(

    '/periodos/edit/{id}',
    [
        'controller' => periodoController::class,
        'method' => 'edit',
    ]
));

$routes->add('periodo_ssp', new Route(

    '/periodos/ssp',
    [
        'controller' => periodoController::class,
        'method' => 'ssp',
    ]
));



# GESTION DE PROYECTOS
$routes->add('proyectos', new Route(

    '/proyectos',
    [
        'controller' => proyectoController::class,
        'method' => 'index',
    ]
));

$routes->add('/proyectos/crear', new Route(

    '/proyectos/crear',
    [
        'controller' => proyectoController::class,
        'method' => 'create',
    ]
));

$routes->add('/proyectos/guardar', new Route(

    '/proyectos/guardar',
    [
        'controller' => proyectoController::class,
        'method' => 'store',
    ]
));
$routes->add('proyectos_update', new Route(

    '/proyectos/update',
    [
        'controller' => proyectoController::class,
        'method' => 'update',
    ]
));
$routes->add('proyectos_delete', new Route(

    '/proyectos/delete',
    [
        'controller' => proyectoController::class,
        'method' => 'delete',
    ]
));

$showRoute = new Route(

    '/proyectos/{id}',
    [
        'controller' => proyectoController::class,
        'method' => 'show',
    ]
);
$routes->add('proyectos_show', $showRoute);

$routes->add('proyectos_edit', new Route(

    '/proyectos/edit/{id}',
    [
        'controller' => proyectoController::class,
        'method' => 'edit',
    ]
));

# FIN DE GESTIÓN DE PROYECTOS

# GESTION DE BAREMOS



$routes->add('baremos_manage', new Route(

    '/baremos',
    [
        'controller' => baremosController::class,
        'method' => 'index',
    ]
));

$routes->add('baremos_edit', new Route(

    '/baremos/edit/{id}',
    [
        'controller' => baremosController::class,
        'method' => 'edit',
    ]
));

$routes->add('dimension_manage', new Route(

    '/dimensiones',
    [
        'controller' => dimensionController::class,
        'method' => 'index',
    ]
));


$routes->add('aspectos_manage', new Route(

    '/aspectos',
    [
        'controller' => aspectosController::class,
        'method' => 'index',
    ]
));

# FIN DE GESTIÓN DE BAREMOS

$routes->add('bitacora', new Route(

    '/bitacora',
    [
        'controller' => bitacoraController::class,
        'method' => 'index',
    ]
));

$routes->add('/permisos', new Route(

    '/permisos',
    [
        'controller' => permisosController::class,
        'method' => 'index',
    ]
));
$routes->add('/permisos/crear', new Route(

    '/permisos/crear',
    [
        'controller' => permisosController::class,
        'method' => 'create',
    ]
));
$routes->add('/permisos/guardar', new Route(

    '/permisos/guardar',
    [
        'controller' => permisosController::class,
        'method' => 'store',
    ]
));
$routes->add('/permisos/eliminar', new Route(

    '/permisos/eliminar',
    [
        'controller' => permisosController::class,
        'method' => 'delete',
    ]
));
$routes->add('/permisos/editar/{id}', new Route(

    '/permisos/editar/{id}',
    [
        'controller' => permisosController::class,
        'method' => 'edit',
    ]
));
$routes->add('/permisos/actualizar/{id}', new Route(

    '/permisos/actualizar/{id}',
    [
        'controller' => permisosController::class,
        'method' => 'update',
    ]
));
$routes->add('modulos', new Route(

    '/modulos',
    [
        'controller' => moduloController::class,
        'method' => 'index',
    ]
));

$routes->add('modulos/crear', new Route(

    '/modulos/crear',
    [
        'controller' => moduloController::class,
        'method' => 'create',
    ]
));


$routes->add('/modulos/guardar', new Route(

    '/modulos/guardar',
    [
        'controller' => moduloController::class,
        'method' => 'store',
    ]
));

$routes->add('modulos/editar/{id}', new Route(

    '/modulos/editar/{id}',
    [
        'controller' => moduloController::class,
        'method' => 'edit',
    ]
));
$routes->add('modulos/actualizar/{id}', new Route(

    '/modulos/actualizar/{id}',
    [
        'controller' => moduloController::class,
        'method' => 'update',
    ]
));

//coment
try {
    // Get the route matcher from the container ...
    $matcher = new UrlMatcher($routes, $context);
    $route = $matcher->match($context->getPathInfo());

    // OBTENER PARAMETROS DE LA RUTA
    $parameters = $route;
    unset($parameters['controller'], $parameters['_route'], $parameters['method']);

    // Dispatch the request to the route handler.
    $controller = new $route['controller'];

    $method = $route['method'];
    $response = $controller->$method($request, ...$parameters);
} catch (ResourceNotFoundException $exception) {
    var_dump($exception->getMessage());
    $response = new Response('Not Found', 404);

    $viewController = new \App\controllers\controller;
    $viewController->page('errors/404');
} catch (Throwable $throwable) {
    var_dump($throwable->getMessage());
    $response = new Response('An error occurred', 500);
}
//require_once '../config/handler.php';

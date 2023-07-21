<?php
require __DIR__ . '/../vendor/autoload.php';

/* use App\Controllers\AuthenticationController;
use App\Controllers\DashboardController; */

use App\controllers\proyectoController;
use App\controllers\homeController;
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





$routes->add('bitacora', new Route(

    '/bitacora',
    [
        'controller' => bitacoraController::class,
        'method' => 'index',
    ]
));

$routes->add('permisos', new Route(

    '/permisos',
    [
        'controller' => permisosController::class,
        'method' => 'index',
    ]
));
$routes->add('permisosCrear', new Route(

    '/permisosCrear',
    [
        'controller' => permisosController::class,
        'method' => 'create',
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
    $response = new Response('Not Found', 404);

    $viewController = new \App\controllers\controller;
    $viewController->view('errors/404');
} catch (Throwable $throwable) {
    $response = new Response('An error occurred', 500);
}
//require_once '../config/handler.php';

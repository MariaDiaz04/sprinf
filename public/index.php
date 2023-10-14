<?php
require __DIR__ . '/../vendor/autoload.php';

/* use App\Controllers\AuthenticationController;
use App\Controllers\DashboardController; */

use App\controllers\inscripcionController;
use App\controllers\configuracionController;
use App\controllers\periodoController;
use App\controllers\seccionController;
use App\controllers\profesorController;
use App\controllers\estudianteController;
use App\controllers\materiasController;
use App\controllers\aspectosController;
use App\controllers\baremosController;
use App\controllers\dimensionController;
use App\controllers\proyectoController;
use App\controllers\homeController;
use App\controllers\moduloController;
use App\controllers\trayectosController;
use App\proyecto;
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



// GESTION DE ESTUDIANTES
$routes->add('estudiante_manage', new Route(

    '/estudiantes',
    [
        'controller' => estudianteController::class,
        'method' => 'index',
    ]
));

$routes->add('estudiante_edit', new Route(

    '/estudiantes/edit/{id}',
    [
        'controller' => estudianteController::class,
        'method' => 'edit',
    ]
));

$routes->add('/estudiantes/guardar', new Route(

    '/estudiantes/guardar',
    [
        'controller' => estudianteController::class,
        'method' => 'store',
    ]
));

$routes->add('estudiante_ssp', new Route(

    '/estudiantes/ssp',
    [
        'controller' => estudianteController::class,
        'method' => 'ssp',
    ]
));


$routes->add('notes/pdf/{id}', new Route(

    '/notes/pdf/{id}',
    [
        'controller' => estudianteController::class,
        'method' => 'notePDF',
    ]
));





// GESTION DE PROFESORES
$routes->add('profesor_manage', new Route(

    '/profesores',
    [
        'controller' => profesorController::class,
        'method' => 'index',
    ]
));

$routes->add('profesor_edit', new Route(

    '/profesores/edit/{id}',
    [
        'controller' => profesorController::class,
        'method' => 'edit',
    ]
));

$routes->add('/profesores/guardar', new Route(

    '/profesores/guardar',
    [
        'controller' => profesorController::class,
        'method' => 'store',
    ]
));

$routes->add('profesor_ssp', new Route(

    '/profesores/ssp',
    [
        'controller' => profesorController::class,
        'method' => 'ssp',
    ]
));


# GESTION DE Secciones
$routes->add('seccion_manage', new Route(

    '/seccion',
    [
        'controller' => seccionController::class,
        'method' => 'index',
    ]
));

$routes->add('seccion_edit', new Route(

    '/seccion/edit/{id}',
    [
        'controller' => seccionController::class,
        'method' => 'edit',
    ]
));

$routes->add('/seccion/guardar', new Route(

    '/seccion/guardar',
    [
        'controller' => seccionController::class,
        'method' => 'store',
    ]
));

$routes->add('seccion_ssp', new Route(

    '/seccion/ssp',
    [
        'controller' => seccionController::class,
        'method' => 'ssp',
    ]
));
$routes->add('materias/{idTrayecto}', new Route(


    '/materias/{idTrayecto}',
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


$routes->add('materia_guardar', new Route(

    '/materias/guardar',
    [
        'controller' => materiasController::class,
        'method' => 'store',
    ]
));
$routes->add('materia_editar', new Route(

    '/materias/edit',
    [
        'controller' => materiasController::class,
        'method' => 'edit',
    ]
));
$routes->add('materia_update', new Route(

    '/materias/update',
    [
        'controller' => materiasController::class,
        'method' => 'update',
    ]
));
$routes->add('materia_delete', new Route(

    '/materias/delete',
    [
        'controller' => materiasController::class,
        'method' => 'delete',
    ]
));
$routes->add('materia_ssp', new Route(

    '/materias/ssp/{idTrayecto}',
    [
        'controller' => materiasController::class,
        'method' => 'ssp',
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

$routes->add('/periodos/guardar', new Route(

    '/periodos/guardar',
    [
        'controller' => periodoController::class,
        'method' => 'store',
    ]
));

$routes->add('periodo_ssp', new Route(

    '/periodos/ssp',
    [
        'controller' => periodoController::class,
        'method' => 'ssp',
    ]
));

// GESTION DE INSCRIPCION
$routes->add('inscripcion/ssp/{idMateria}', new Route(

    '/inscripcion/ssp/{idMateria}',
    [
        'controller' => inscripcionController::class,
        'method' => 'ssp',
    ]
));
$routes->add('inscripcion/{idMateria}', new Route(

    '/inscripcion/{idMateria}',
    [
        'controller' => inscripcionController::class,
        'method' => 'index',
    ]
));


# GESTION DE TRAYECTOS
$routes->add('trayecto_manage', new Route(

    '/trayectos',
    [
        'controller' => trayectosController::class,
        'method' => 'index',
    ]
));

$routes->add('trayecto_edit', new Route(

    '/trayectos/edit/{id}',
    [
        'controller' => trayectosController::class,
        'method' => 'edit',
    ]
));

$routes->add('/trayectos/guardar', new Route(

    '/trayectos/guardar',
    [
        'controller' => trayectosController::class,
        'method' => 'store',
    ]
));

$routes->add('trayecto_ssp', new Route(

    '/trayectos/ssp',
    [
        'controller' => trayectosController::class,
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
$routes->add('proyectos_pendingStudents', new Route(

    '/proyectos/pending-students',
    [
        'controller' => proyectoController::class,
        'method' => 'pendingStudents',
    ]
));

$routes->add('proyectos_ssp', new Route(

    '/proyectos/ssp',
    [
        'controller' => proyectoController::class,
        'method' => 'ssp',
    ]
));
$routes->add('proyectos_subir-notas_baremos', new Route(

    '/proyectos/subir-notas',
    [
        'controller' => proyectoController::class,
        'method' => 'subirNotas',
    ]
));
$routes->add('proyectos_evaluar_baremos', new Route(

    '/proyectos/evaluar',
    [
        'controller' => proyectoController::class,
        'method' => 'evaluar',
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

$routes->add('proyectos_evaluar', new Route(

    '/proyectos/assessment/{id}',
    [
        'controller' => proyectoController::class,
        'method' => 'assessment',
    ]
));

$routes->add('proyectnotes/pdf/{id}', new Route(

    '/proyectnotes/pdf/{id}',
    [
        'controller' => proyectoController::class,
        'method' => 'noteProyectPDF',
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




$routes->add('dimension_edit', new Route(

    '/dimension/edit/{id}',
    [
        'controller' => dimensionController::class,
        'method' => 'edit',
    ]
));

$routes->add('/dimensiones/guardar', new Route(

    '/dimensiones/guardar',
    [
        'controller' => dimensionController::class,
        'method' => 'store',
    ]
));

$routes->add('dimensiones/ssp/{idTrayecto}', new Route(

    '/dimensiones/ssp/{idTrayecto}',
    [
        'controller' => dimensionController::class,
        'method' => 'ssp',
    ]
));

$routes->add('dimension_manage', new Route(

    '/dimensiones/{idTrayecto}',
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

// GESTION DE CONFIGURACION

$routes->add('configuracion/cerrar', new Route(

    '/configuracion/cerrar',
    [
        'controller' => configuracionController::class,
        'method' => 'cerrarPeriodo',
    ]
));

$routes->add('configuracion/aperturar-periodo', new Route(

    '/configuracion/aperturar-periodo',
    [
        'controller' => configuracionController::class,
        'method' => 'periodo',
    ]
));

$routes->add('configuracion/excel', new Route(

    '/configuracion/excel',
    [
        'controller' => proyectoController::class,
        'method' => 'exportExcel',
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

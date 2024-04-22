<?php
require __DIR__ . '/../vendor/autoload.php';

###############################################
// API
##############################################
// use API\apiAuthController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
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


############################################################
//                          API
############################################################
$listaDeRutas = [];

// rutas de api
require __DIR__ . '/../config/routes/api.php';


############################################################
//                          WEB
############################################################

require __DIR__ . '/../config/routes/auth.php';             ## AUTH
require __DIR__ . '/../config/routes/home.php';             ## HOME
// Personas
require __DIR__ . '/../config/routes/usuario.php';          ## usuario
require __DIR__ . '/../config/routes/profesor.php';         ## PROFESOR
require __DIR__ . '/../config/routes/estudiantes.php';      ## ESTUDIANTES
require __DIR__ . '/../config/routes/controlAcademico.php';      ## ControlAcademico

// Organizacion Docente
require __DIR__ . '/../config/routes/seccion.php';          ## seccion
require __DIR__ . '/../config/routes/materia.php';          ## materia
require __DIR__ . '/../config/routes/inscripcion.php';      ## inscripcion

// baremos
require __DIR__ . '/../config/routes/dimension.php';         ## proyecto
require __DIR__ . '/../config/routes/baremos.php';          ## baremos
require __DIR__ . '/../config/routes/proyecto.php';         ## proyecto
require __DIR__ . '/../config/routes/historico.php';         ## historico

// Consejo Comunal
require __DIR__ . '/../config/routes/consejoComunal.php';  ## ConsejoComunal
require __DIR__ . '/../config/routes/sector.php';            ## sector



// seguridad
require __DIR__ . '/../config/routes/bitacora.php';         ## bitacora
require __DIR__ . '/../config/routes/permisos.php';         ## permisos
require __DIR__ . '/../config/routes/modulos.php';          ## modulo

// configuracion
require __DIR__ . '/../config/routes/configuracion.php';    ## modulo
require __DIR__ . '/../config/routes/periodo.php';          ## periodo
require __DIR__ . '/../config/routes/trayecto.php';         ## trayecto
require __DIR__ . '/../config/routes/usuario.php';          ## usuario

// report
require __DIR__ . '/../config/routes/reportesn.php';    ## reportes
require __DIR__ . '/../config/routes/reporteMunicipio.php';    ## reportes
require __DIR__ . '/../config/routes/reporteAprobado.php';    ## reportes



foreach ($listaDeRutas as $nombre => $ruta) {
    $routes->add($nombre, $ruta);
}

try {
    // OBTENERMOS LA RUTA Y SU CONTENIDO ...
    $matcher = new UrlMatcher($routes, $context);
    $route = $matcher->match($context->getPathInfo());

    // OBTENER PARAMETROS DE LA RUTA
    $parameters = $route;
    unset($parameters['controller'], $parameters['_route'], $parameters['method']);

    // ENVIA LA SOLICITU AL CONTROLADOR DE LA RUTA.
    $controller = new $route['controller'];

    $method = $route['method'];
    $response = $controller->$method($request, ...$parameters);
} catch (ResourceNotFoundException $exception) {
    echo $exception->getMessage();
    $response = new Response('Not Found', 404);
    //SI FALLA INSTACIAMOS EL CONTROLADOR Y ACCEDEMOS AL METODO PAGE PARA RETORNAR UN ERROR
    $viewController = new Controllers\controller;
    // $viewController->page('errors/404');
} catch (Throwable $throwable) {
    echo $throwable->getMessage() . ' ' . $throwable->getTraceAsString();
    $response = new Response('An error occurred', 500);
}

<?php

namespace Model;

use Controllers\controller;

class handler
{


    function __construct($route)
    {
        session_start();
        require '../routes/web.php';

        if (isset($route['middlewares'])) {
            foreach ($route['middlewares'] as $middleware) {
                require '../app/middlewares/' . $middleware . '.php';
            }
        }
        require '../app/model.php';
        require '../app/controllers/controller.php';
        require '../app/controllers/' . $route['controller'] . '.php';
        isset($route['name']) ? $_ENV['title'] = $route['name'] : $_ENV['title'] = 'Page';
        $class = new $route['controller'];

        if (isset($route['type'])) {
            // return var_dump($class->{$route['method']}); 
            switch ($route['type']) {
                case 'GET':
                    $class->{$route['method']}(array_diff($_GET, array('r')));
                    break;
                case 'POST':
                    $class->{$route['method']}($_POST);
                    break;
                case 'FILES':
                    $class->{$route['method']}($_FILES);
                    break;
                case 'REQUEST':
                    $class->{$route['method']}($_REQUEST);
                    break;
                default:
                    require '../app/controllers/controller.php';
                    $controller = new controller();
                    $controller->page('errors/page_not_fount');
                    break;
            }
        } else {
            $class->{$route['method']}();
        }
    }
}
if (isset($_GET['r'])) {

    require '../routes/web.php';
    if (isset($web[$_GET['r']])) {
        new handler($web[$_GET['r']]);
    } else {
        require '../app/controllers/controller.php';
        $controller = new controller();
        $controller->page('errors/page_not_fount');
    }
} else {
    header('location:?r=home');
}

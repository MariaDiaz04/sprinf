<?php

namespace Controllers;

require '../app/request/request.php';



class controller
{

    public function page($view, $datas = null)
    {
        if (isset($datas)) {
            foreach ($datas as $key => $value) {
                ${$key} = json_decode(json_encode($value));
            }
        }
        include '../src/views/' . $view . '.php';
    }

    public function view($view, $datas = null)
    {

        if (isset($datas)) {
            foreach ($datas as $key => $value) {
                ${$key} = json_decode(json_encode($value));
            }
        }
        include '../src/views/app.php';
        include '../src/views/' . $view . '.php';
        echo '</div>';
        $this->layout('footer');
        echo '</div></div><div class="content-backdrop fade"></div>';
        $this->layout('endpage');
    }

    public function Route($route, $paremeters = null)
    {
        if (isset($route)) {

            $get = $route;
            if (isset($paremeters)) {
                foreach ($paremeters as $key => $value) {

                    $get = $get . '&' . $key . '=' . $value;
                }
            }
        } else {

            $get = 'home';
        }

        return $get;
    }

    function currentPath(): string
    {
        $pageURL = 'http';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        $path = explode('/', parse_url($pageURL)['path'])[1];
        return $path;
    }

    function currentLastPath(): string
    {
        $pageURL = 'http';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        $explodedPath = explode('/', parse_url($pageURL)['path']);
        $path = end($explodedPath);
        return $path;
    }
    function fullPath(): array
    {
        $pageURL = 'http';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        $explodedPath = explode('/', parse_url($pageURL)['path']);
        return $explodedPath;
    }

    public function redirect($route, $paremeters = null)
    {
        ob_start(); //this should be first line of your page
        header('location:' . $this->Route($route, $paremeters));
        ob_end_flush(); //this should be last line of your page
        exit();
    }

    public function layout($layout, $datas = null)
    {
        if (isset($datas)) {
            foreach ($datas as $key => $value) {
                ${$key} = json_decode(json_encode($value));
            }
        }
        include '../src/views/layouts/' . $layout . '.php';
    }

    public function js(string $name)
    {
        echo "<script src='../src/views/" . $name . ".js'></script>";
    }

    public function format($date, $format = 'd-m-Y')
    {
        return date_format(date_create($date), $format);
    }

    public function tokenExist()
    {
        if (!isset($_SESSION['token'])) {
            ob_start(); //this should be first line of your page
            header('location:/');
            ob_end_flush(); //this should be last line of your page
            exit();
        }
    }

}

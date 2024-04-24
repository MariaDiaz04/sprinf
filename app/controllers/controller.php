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
    public  function menuByRol($sessionRol)
    {

        switch ($sessionRol) {
            case 1:
                return $this->layout('menuRoot');
                break;
            case 2:
                return $this->layout('menuCoordinador');
                break;
            case 3:
                return $this->layout('menuDocenteTrayecto');
                break;
            case 5:
                return $this->layout('menuDocente');
                break;
            case 6:
                return $this->layout('menuControlAcademico');
                break;
            default:
                return $this->layout('menuRoot');
                break;
        }
    }


    /**
     * Modulo Inicio
     *
     * @var int
     */
    public  $modulo_inicio = 1;

    /**
     * Modulo Docentes
     *
     * @var int
     */
    public  $modulo_docentes = 2;

    /**
     * Modulo Estudiantes
     *
     * @var int
     */
    public  $modulo_estudiantes = 3;

    /**
     * Modulo Secciones
     * 
     *
     * @var int
     */
    public  $modulo_unidades_secciones = 4;

    /**
     * Modulo Unidades curriculares I
     * 
     *
     * @var int
     */
    public  $modulo_unidades_curriculares_TI = 5;

    /**
     * Modulo Unidades curriculares II
     * 
     *
     * @var int
     */
    public  $modulo_unidades_curriculares_TII = 6;

    /**
     * Modulo Unidades curriculares III
     * 
     *
     * @var int
     */
    public  $modulo_unidades_curriculares_TIII = 7;

    /**
     * Modulo Unidades curriculares IV
     * 
     *
     * @var int
     */
    public  $modulo_unidades_curriculares_TIV = 8;

    /**
     * Modulo Consejo comunal
     * 
     *
     * @var int
     */
    public  $modulo_consejo_comunal  = 9;

    /**
     * Modulo Sector
     * 
     *
     * @var int
     */
    public  $modulo_sector = 10;

    /**
     * Modulo baremos TI
     * 
     *
     * @var int
     */
    public  $modulo_baremos_TI = 11;

    /**
     * Modulo baremos TII
     * 
     *
     * @var int
     */
    public  $modulo_baremos_TII = 12;

    /**
     * Modulo  baremos TIII
     * 
     *
     * @var int
     */
    public  $modulo_baremos_TIII = 13;

    /**
     * Modulo Baremos TIV
     * 
     *
     * @var int
     */
    public  $modulo_baremos_TIV = 14;

    /**
     * Modulo Proyectos
     * 
     *
     * @var int
     */
    public  $modulo_proyectos = 15;

    /**
     * Modulo Bitacora session
     * 
     *
     * @var int
     */
    public  $modulo_bitacora_session = 16;

    /**
     * Modulo Bitacora Acciones
     * 
     *
     * @var int
     */
    public  $modulo_bitacora_acciones = 17;

    /**
     * Modulo Permisos
     * 
     *
     * @var int
     */
    public  $modulo_permisos = 18;

    /**
     * Modulo Modulos
     * 
     *
     * @var int
     */
    public  $modulo_modulos = 19;

    /**
     * Modulo Aperturar lapso
     * 
     *
     * @var int
     */
    public  $modulo_aperturar_lapso = 20;

    /**
     * Modulo respaldo
     * 
     *
     * @var int
     */
    public  $modulo_respaldo = 21;
    /**
     * Modulo respaldo
     * 
     *
     * @var int
     */
    public  $modulo_controlAcademico = 29;





    /**
     * Accion Insertar
     *
     * @var int
     */
    public  $accion_insertar = 1;

    /**
     * Accion Actualizar
     *
     * @var int
     */
    public  $accion_actualizar = 2;

    /**
     * Accion Consultar
     *
     * @var int
     */
    public  $accion_consultar = 3;

    /**
     * Accion Eliminar
     * 
     *
     * @var int
     */
    public  $accion_eliminar = 4;
    
    /**
     * Accion Evaluar
     * 
     *
     * @var int
     */
    public  $accion_evaluar = 5;

}

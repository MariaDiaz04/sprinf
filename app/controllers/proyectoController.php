<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use App\proyecto;
use App\estudiante;
use App\tutor;
use App\trayectos;

class proyectoController extends controller
{

    private $proyecto;
    private $estudiantes;
    private $tutores;
    private $trayectos;

    function __construct()
    {
        $this->proyecto = new proyecto();
        $this->estudiantes = new estudiante();
        $this->tutores = new tutor();
        $this->trayectos = new trayectos();
    }

    public function index()
    {

        $proyectos = $this->proyecto->all();

        $tutores = $this->tutores->all();

        $estudiantes = $this->estudiantes->listPendingForProject();


        return $this->view('proyectos/gestionar', [
            'proyectos' => $proyectos,
            'estudiantes' => $estudiantes,
            'tutores' => $tutores
        ]);
    }

    public function create()
    {
        $tutores = $this->tutores->all();
        $trayectos = $this->trayectos->all();



        $estudiantes = $this->estudiantes->listPendingForProject();


        return $this->view('proyectos/crear', [
            'estudiantes' => $estudiantes,
            'tutores' => $tutores,
            'trayectos' => $trayectos
        ]);
    }

    public function store(Request $usuario)
    {

        http_response_code(200);
        echo json_encode($usuario->request->all());
    }

    public function E501()
    {

        return $this->page('errors/501');
    }
}

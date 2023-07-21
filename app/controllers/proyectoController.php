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
use Exception;

class proyectoController extends controller
{

    public $proyecto;
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

    public function store(Request $nuevoProyecto)
    {
        try {
            if (!array_key_exists('estudiantes', $nuevoProyecto->request->all())) throw new Exception('No puede crear proyecto sin integrantes');
            $estudiantes = $nuevoProyecto->request->all()['estudiantes'];
            $this->proyecto->setProyectData($nuevoProyecto->request->all());
            $this->proyecto->save();
            $this->proyecto->saveTeam(1, $estudiantes);

            http_response_code(200);
            echo json_encode($this->proyecto);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $proyecto = $this->proyecto->find($id);
        $estudiantes = $this->estudiantes->byProject($id);

        return $this->view('proyectos/show', [
            'proyecto' => $proyecto,
            'estudiantes' => $estudiantes
        ]);
    }

    public function edit(Request $request, $id)
    {
        $proyecto = $this->proyecto->find($id);
        $estudiantesPendientes = $this->estudiantes->listPendingForProject();
        $estudiantes = $this->estudiantes->byProject($id);
        $tutores = $this->tutores->all();
        $trayectos = $this->trayectos->all();


        return $this->view('proyectos/edit', [
            'proyecto' => $proyecto,
            'estudiantes' => $estudiantes,
            'estudiantesPendientes' => $estudiantesPendientes ?? [],
            'tutores' => $tutores,
            'trayectos' => $trayectos
        ]);
    }

    function update(Request $proyecto): void
    {
        try {
            if (!array_key_exists('estudiantes', $proyecto->request->all())) throw new Exception('No puede crear proyecto sin integrantes');

            $estudiantes = $proyecto->request->all()['estudiantes'];
            $idProyecto = $proyecto->request->get('id');

            $this->proyecto->setProyectData($proyecto->request->all());
            $this->proyecto->save($idProyecto);

            $estudiantes = $proyecto->request->all()['estudiantes'];
            $this->proyecto->updateTeam($idProyecto, 1, $estudiantes);

            http_response_code(200);
            echo json_encode($this->proyecto);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    function delete(Request $proyecto): void
    {
        try {

            $idProyecto = $proyecto->request->get('id');

            $this->proyecto->remove($idProyecto);

            http_response_code(200);
            echo json_encode($this->proyecto);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    public function E501()
    {

        return $this->page('errors/501');
    }
}

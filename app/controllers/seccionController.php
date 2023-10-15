<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\seccion;
use Exception;
use Model\trayectos;

class seccionController extends controller
{

    private $seccion;
    public $TRAYECTO;

    function __construct()
    {
        $this->tokenExist();
        $this->seccion = new seccion();
        $this->TRAYECTO = new trayectos();
    }

    public function index()
    {

        $seccion = $this->seccion->all();
        $trayectos = $this->TRAYECTO->all();


        return $this->view('seccion/gestionar', [
            'seccion' => $seccion,
            'trayectos' => $trayectos
        ]);
    }

    public function create($request)
    {
        $seccion = $this->seccion->Selectcod();
        $trayectos = $this->TRAYECTO->all();
        return $this->view('seccion/gestionar', ['seccion' => $seccion, 'trayectos' => $trayectos]);
    }

    public function store(Request $seccion)

    {
        try {
            $codigo = $seccion->get('codigo');
            $trayectoId = $seccion->get('trayecto_id');
            $observacion = $seccion->get('observacion');

            $this->seccion->setData($seccion->request->all());

            // ejecutar transacción de insert
            $codigo = $this->seccion->save();

            if (empty($codigo)) throw new Exception('Error inesperado al crear seccion.');

            http_response_code(200);
            echo json_encode($codigo);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }


    function ssp(Request $query): void
    {
        try {
            http_response_code(200);
            echo json_encode($this->seccion->generarSSP());
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

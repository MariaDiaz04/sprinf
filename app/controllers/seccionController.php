<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;

use App\seccion;
use Exception;

class seccionController extends controller
{

    private $seccion;

    function __construct()
    {
        $this->seccion = new seccion();
    }

    public function index()
    {

        $seccion = $this->seccion->all();


        return $this->view('seccion/gestionar', [
            'seccion' => $seccion,
        ]);
    }

    public function store(Request $seccion)
    {
        try {


            // $this->seccion->setData($seccion->request->all());

            // $id = $this->seccion->save();

            http_response_code(200);
            // echo json_encode($id);
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

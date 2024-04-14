<?php

namespace Controllers;


use Symfony\Component\HttpFoundation\Request;

use Exception;
use Model\conexion;
use Model\sector;
use Model\parroquia;
use Utils\validation;

final class sectorController extends controller
{
    protected static int $idIndicadorPrueba;
    private $sector;
    public $PARROQUIA;

    function __construct()
    {

        $this->sector = new sector();
        $this->PARROQUIA = new PARROQUIA();
        $this->VALIDATION = new VALIDATION();
    }


    public function index()
    {

        $sector = $this->sector->all();
        $parroquia = $this->PARROQUIA->all();
        // var_dump($parroquia);
        // exit();

        return $this->view('sector/gestionar', [
            'sector' => $sector,
            'parroquias' => $parroquia

        ]);
    }


    public function create($request)
    {

        $sector = $this->sector->Selectcod();
        $parroquia = $this->PARROQUIA->all();
        return $this->view('sector/gestionar', ['sector' => $sector]);
    }

    public function store(Request $request)
    {
        try {

            // Obtener datos del formulario utilizando el objeto Request
            $parroquia_id = $request->get('parroquia_id');
            $nombre = $request->get('nombre');

            //Se recibe: el nombre del campo, el valor del mismo, el tipo de variable, la cantidad minima, maxima, y si es requerido
            $campos = [
                ['parroquia_id', $parroquia_id, 'int', 1, 4, ''],
                ['nombre', $nombre, 'string', 5, 50, 'required']
            ];

            foreach ($campos as $campo) {
                $validacion = $this->VALIDATION->validate(...$campo);
                if ($validacion == true) {
                    http_response_code(400);
                    echo json_encode($validacion);
                    return 0;
                }
            }

            $parroquia = $this->PARROQUIA->find($parroquia_id);
            if ($parroquia == null) {
                //Se establecen los valores a mostrar en caso de no encontrar la parroquia
                $error = ([
                    'error' => '404',
                    'detalle' => 'No existe la parroquia indicada',
                ]);
                //Error de 404 cuando no encuentra un dato
                http_response_code(404);
                echo json_encode($error);
            } else {
                // Crear una nueva instancia del modelo y establecer los datos
                $sector = new sector();
                $sector->setData([
                    'parroquia_id' => $parroquia_id,
                    'nombre' => $nombre,
                ]);

                // Ejecutar transacción de insert
                $resultado = $sector->save();
                http_response_code(200);
                echo json_encode($resultado);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    function update($request)
    {
        try {
            $data = [];
            $id = $request->get('id');
            $parroquia_id = $request->get('parroquia_id');
            $nombre = $request->get('nombre');

            //Se recibe: el nombre del campo, el valor del mismo, el tipo de variable, la cantidad minima, maxima, y si es requerido
            $campos = [
                ['id', $id, 'int', 1, 4, 'required'],
                ['parroquia_id', $parroquia_id, 'int', 1, 4, 'required'],
                ['nombre', $nombre, 'string', 5, 50, 'required']
            ];

            foreach ($campos as $campo) {
                $validacion = $this->VALIDATION->validate(...$campo);
                if ($validacion == true) {
                    http_response_code(400);
                    echo json_encode($validacion);
                    return 0;
                }
            }


            $parroquia = $this->PARROQUIA->find($parroquia_id);
            if ($parroquia == null) {
                //Se establecen los valores a mostrar en caso de no encontrar la parroquia
                $error = ([
                    'error' => '404',
                    'detalle' => 'No existe la parroquia indicada',
                ]);
                //Error de 404 cuando no encuentra un dato
                http_response_code(404);
                echo json_encode($error);
            } else {
                $sector = $this->sector->find($id);
                if ($sector == null) {
                    //Se establecen los valores a mostrar en caso de no encontrar el sector
                    $error = ([
                        'error' => '404',
                        'detalle' => 'No existe el id del sector indicado',
                    ]);
                    //Error de 404 cuando no encuentra un dato
                    http_response_code(404);
                    echo json_encode($error);
                } else {
                    $this->sector->setData([
                        'id' => $id,
                        'parroquia_id' => $parroquia_id,
                        'nombre' => $nombre,
                    ]);
                    $resultado = $this->sector->actualizar();
                    if (!$resultado) throw new Exception('Error al actualizar Consejo Comunal');
                    http_response_code(200);
                    echo json_encode(true);
                }
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    function edit($request)
    {
        try {
            $data = [];
            $id = $request->get('id');

            $sector = $this->sector->find($id);
            //Se recibe: el nombre del campo, el valor del mismo, el tipo de variable, la cantidad minima, maxima, y si es requerido
            $campos = [
                ['id', $id, 'int', 1, 4, 'required']
            ];

            foreach ($campos as $campo) {
                $validacion = $this->VALIDATION->validate(...$campo);
                if ($validacion == true) {
                    http_response_code(400);
                    echo json_encode($validacion);
                    return 0;
                }
            }

            if ($sector == null) {
                //Se establecen los valores a mostrar en caso de no encontrar el sector
                $error = ([
                    'error' => '404',
                    'detalle' => 'No existe el id del sector indicado',
                ]);
                //Error de 404 cuando no encuentra un dato
                http_response_code(404);
                echo json_encode($error);
            } else {
                $data['sector'] = $sector;
                http_response_code(200);
                echo json_encode($data);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    public function delete($request)
    {

        try {
            $id = $request->get('id');
            //Se recibe: el nombre del campo, el valor del mismo, el tipo de variable, la cantidad minima, maxima, y si es requerido
            $campos = [
                ['id', $id, 'int', 1, 4, 'required']
            ];

            foreach ($campos as $campo) {
                $validacion = $this->VALIDATION->validate(...$campo);
                if ($validacion == true) {
                    http_response_code(400);
                    echo json_encode($validacion);
                    return 0;
                }
            }

            $sector = $this->sector->find($id);
            if ($sector == null) {
                //Se establecen los valores a mostrar en caso de no encontrar el sector
                $error = ([
                    'error' => '404',
                    'detalle' => 'No existe el id del sector indicado',
                ]);
                //Error de 404 cuando no encuentra un dato
                http_response_code(404);
                echo json_encode($error);
            } else {
                // realizar eliminacion
                $result = $this->sector->deleteTransaction($id);

                if (!$result) throw new Exception('Error inesperado al borrar el sector.');
                http_response_code(200);
                echo json_encode($id);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }



    function ssp(Request $query): void
    {
        try {
            http_response_code(200);
            echo json_encode($this->sector->generarSSP());
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

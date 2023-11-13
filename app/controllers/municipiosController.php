<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\municipio;
use Exception;
use Model\inscripcion;
use Model\trayectos;

class municipioController extends controller
{

    private $municipio;
    public $TRAYECTO;
    public $INSCRIPCION;

    function __construct()
    {
        $this->tokenExist();
        $this->municipio = new municipio();
    }

    public function index()
    {
        $municipio = $this->municipio->all();
        return $this->view('municipio/gestionar', [
            'municipio' => $municipio,
        ]);
    }

    public function create($request)
    {
        $municipio = $this->municipio->Selectcod();
        $trayectos = $this->TRAYECTO->all();
        return $this->view('municipio/gestionar', ['municipio' => $municipio, 'trayectos' => $trayectos]);
    }

    public function store(Request $municipio)

    {
        try {
            $codigo = $municipio->get('codigo');
            $trayectoId = $municipio->get('trayecto_id');
            $observacion = $municipio->get('observacion');

            $this->municipio->setData($municipio->request->all());

            // ejecutar transacción de insert
            $codigo = $this->municipio->save();

            if (empty($codigo)) throw new Exception('Error inesperado al crear municipio.');

            http_response_code(200);
            echo json_encode($codigo);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    /**
     * Obtiene la informacion necesaria para crear
     * formulario de update retornado en formato JSON
     *
     * @param [type] $request
     * @return void
     */
    function edit($request): void
    {
        try {
            $data = [];
            $codigo = $request->get('codigo');


            $municipio = $this->municipio->find($codigo);

            $data['municipio'] = $municipio;

            http_response_code(200);
            echo json_encode($data);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    public function update($request)
    {
        try {

            $codigo = $request->get('codigo');
            $observacion = $request->get('observacion');
            $trayectoId = $request->get('trayecto_id');
            if (!$municipio = $this->municipio->findOld($codigo)) {
                return $this->page('errors/404');
            };
            // asignar valores de municipio
            $municipio->actualizar([
                'observacion' => '"' . $observacion . '"',
                'trayecto_id' => '"' . $trayectoId . '"',
            ]);



            //if (empty($codigo)) throw new Exception('Error inesperado al actualizar la sección.');

            http_response_code(200);
            echo json_encode($codigo);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    public function delete($request)
    {

        try {
            $municipio_id = $request->get('municipio_id');

            // verificar que no cuente con clases ya creadas
            $this->checkInscripcion($municipio_id, 'eliminar');
            // realizar eliminacion
            $result = $this->municipio->deleteTransaction($municipio_id);
            if (!$result) throw new Exception('Error inesperado al borrar la sección.');
            http_response_code(200);
            echo json_encode($municipio_id);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    function checkInscripcion(string $municipio_id, string $action): bool
    {

        // verificar que no cuente con insripciones
        $inscripciones = $this->INSCRIPCION->findBymunicipio($municipio_id);
        if (!!$inscripciones) {
            foreach ($inscripciones as $inscripcion) {
                if (intval($inscripcion) > 0) throw new Exception('No puede '.$action.' datos de la municipio por que cuenta con incripciones ya creadas');
            }
        }
        return true;
    }
    function ssp(Request $query): void
    {
        try {
            http_response_code(200);
            echo json_encode($this->municipio->generarSSP());
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

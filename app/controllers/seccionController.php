<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\seccion;
use Exception;
use Model\inscripcion;
use Model\trayectos;

class seccionController extends controller
{

    private $seccion;
    public $TRAYECTO;
    public $INSCRIPCION;

    function __construct()
    {
        $this->tokenExist();
        $this->seccion = new seccion();
        $this->TRAYECTO = new trayectos();
        $this->INSCRIPCION = new inscripcion();
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


            $this->checkCodigo($codigo, 'guardar');

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


            $seccion = $this->seccion->find($codigo);

            $data['seccion'] = $seccion;

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
            if (!$seccion = $this->seccion->findOld($codigo)) {
                return $this->page('errors/404');
            };
            // asignar valores de seccion
            $seccion->actualizar([
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
            $seccion_id = $request->get('seccion_id');

            // verificar que no cuente con clases ya creadas
            $this->checkInscripcion($seccion_id, 'eliminar');
            // realizar eliminacion
            $result = $this->seccion->deleteTransaction($seccion_id);
            if (!$result) throw new Exception('Error inesperado al borrar la sección.');
            http_response_code(200);
            echo json_encode($seccion_id);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    function checkInscripcion(string $seccion_id, string $action): bool
    {

        // verificar que no cuente con insripciones
        $inscripciones = $this->INSCRIPCION->findBySeccion($seccion_id);
        if (!!$inscripciones) {
            foreach ($inscripciones as $inscripcion) {
                if (intval($inscripcion) > 0) throw new Exception('No puede ' . $action . ' datos de la seccion por que cuenta con incripciones ya creadas');
            }
        }
        return true;
    }

    function checkCodigo(string $codigo, string $action)
    {

        // verificar que no cuente con insripciones
        $secciones = $this->seccion->find($codigo);
        foreach ($secciones as $seccion) {
            if (intval($seccion) > 0)
                throw new Exception('No puede ' . $action . ' datos de la seccion por que ya existe una seccion con ese codigo');
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

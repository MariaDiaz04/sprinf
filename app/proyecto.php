<?php

namespace App;

use App\model;


use Exception;

class proyecto extends model
{

    public $fillable = [
        'tutor_id',
        'trayecto_id',
        'nombre',
        'descripcion',
        'municipio',
        'area',
        'repositorio_codigo',
        'repositorio_documentacion',
        'url',
        'estatus',
    ];
    private int $id;
    public int $tutor_id;
    public int $trayecto_id;
    public string $nombre;
    public string $descripcion;
    public string $municipio;
    public string $area;
    public string $repositorio_codigo;
    public string $repositorio_documentacion;
    public string $url;
    public string $estatus;

    public function all()
    {
        try {
            $proyectos = $this->querys("SELECT proyecto.*, CONCAT(persona.nombre, ' ',persona.apellido) as nombre_tutor, trayecto.nombre as nombre_trayecto FROM proyecto INNER JOIN tutor ON tutor.id = proyecto.tutor_id INNER JOIN persona ON persona.id = tutor.persona_id INNER JOIN trayecto ON trayecto.id = proyecto.trayecto_id");
            return $proyectos ? $proyectos : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    /**
     * Retorna los datos del proyecto
     *
     * @param [type] $id
     * @return array es vacio si no consigue el proyecto
     */
    public function find($id): array
    {
        $proyectos = $this->selectOne("detalles_proyecto", [['id', '=', $id]]);
        return !$proyectos ? [] : $proyectos;
    }


    public function setProyectData(array $data)
    {
        foreach ($data as $prop => $value) {

            if (property_exists($this, $prop) && in_array($prop, $this->fillable)) {
                $this->{$prop} = $value;
            }
        }
    }

    public function saveTeam(int $periodo_id, array $participantes)
    {
        foreach ($participantes as $value) {

            $this->set('estudiante_proyecto', [
                'proyecto_id' => $this->id,
                'periodo_id' => $periodo_id,
                'estudiante_id' => $value
            ]);
        }
    }

    public function updateTeam($idProyecto, int $periodo_id, array $participantes)
    {
        $participantesActuales = $this->select('estudiante_proyecto', [['proyecto_id', '=', $idProyecto]]);

        $idParticipantesActuales = array_column($participantesActuales, 'estudiante_id');

        $delete_list = array_diff($idParticipantesActuales, $participantes);
        $insert_list = array_diff($participantes, $idParticipantesActuales);

        foreach ($delete_list as $item) {
            $this->delete('estudiante_proyecto', [['estudiante_id', '=', $item], ['proyecto_id', '=', $idProyecto]]);
            // delete $item from DB
        }

        foreach ($insert_list as $item) {
            $this->set('estudiante_proyecto', [
                'proyecto_id' => $idProyecto,
                'periodo_id' => $periodo_id,
                'estudiante_id' => $item
            ]);
        }
    }

    public function save($id = null)
    {
        $data = [];

        foreach ($this->fillable as $key => $value) {
            if (isset($this->{$value})) {
                if (is_string($this->{$value})) {
                    $data[$value] = '"' . $this->{$value} . '"';
                } else {
                    $data[$value] =  $this->{$value};
                }
            }
        }
        if ($id) {
            $this->update('proyecto', $data, [['id', '=', $id]]);
        } else {
            $this->set('proyecto', $data);
            $this->id = $this->lastInsertId();
            return $this->id;
        }
    }

    function remove($id): void
    {
        $this->delete('estudiante_proyecto', [['proyecto_id', '=', $id]]);
        $this->delete('proyecto', [['id', '=', $id]]);
    }

    /**
     * Obtiene los integrantes de un proyecto
     *
     * @param [int] $id - ID de proyecto
     * @return array retorna vacio si no tiene integrantes
     */
    function obtenerIntegrantes(int $id): array
    {
        $integrantes = $this->select('detalles_integrantes', [['proyecto_id', '=', $id]]);
        return !$integrantes ? [] : $integrantes;
    }

    /**
     * generarSSP
     * 
     * Generar SSP proveniente de la función de data table
     *
     * @return array
     */
    public function generarSSP(): array
    {
        $columns = array(
            array(
                'db'        => 'id',
                'dt'        => 0
            ),
            array(
                'db'        => 'nombre',
                'dt'        => 1
            ),
            array(
                'db'        => 'comunidad',
                'dt'        => 2
            ),
            array(
                'db'        => 'nombre_trayecto',
                'dt'        => 3
            ),
            array(
                'db'        => 'nombre_fase',
                'dt'        => 4
            ),
            array(
                'db'        => 'integrantes',
                'dt'        => 5
            ),
        );
        return $this->getSSP('detalles_proyecto', 'id', $columns);
    }
}

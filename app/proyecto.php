<?php

namespace App;

use App\model;
use Utils\Sanitizer;

use Exception;

class proyecto extends model
{

    public $fillable = [
        'tutor_id',
        'fase_id',
        'nombre',
        'descripcion',
        'municipio',
        'area',
        'integrantes',
    ];
    private int $id;
    public int $tutor_id;
    public string $fase_id;
    public string $nombre;
    public string $resumen;
    public string $municipio;
    public string $area;

    public array $integrantes; // has many

    public function all()
    {
        try {
            $proyectos = $this->select("detalles_proyecto");
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

    /**
     * Encontrar proyecto al que el estudiante pertenece
     *
     * @param string $estudiante_id
     * @return array
     */
    function findByStudent(string $estudiante_id): array
    {
        $proyectos = $this->selectOne("integrante_proyecto", [['estudiante_id', '=', $estudiante_id]]);
        return !$proyectos ? [] : $proyectos;
    }

    /**
     * Definir los valores del proyecto
     *
     * @param array $data
     * @return void
     */
    public function setProyectData(array $data)
    {
        foreach ($data as $prop => $value) {
            if (property_exists($this, $prop) && in_array($prop, $this->fillable)) {
                if (is_string($value)) {
                    $this->{$prop} =  Sanitizer::sanitize($value);
                } else {
                    $this->{$prop} = $value;
                }
            }
        }
    }

    function updateFase(int $id, string $codigoFase): void
    {
        $this->update('proyecto', ['fase_id' => "'$codigoFase'"], [['id', '=', $id]]);
    }

    function historicalTransaction(): string
    {
        try {
            parent::beginTransaction();
            $proyectos = $this->all();


            foreach ($proyectos as $proyecto) {
                $data['nombre_proyecto'] = $proyecto['nombre'];
                $data['comunidad'] = $proyecto['comunidad'];
                $data['area'] = $proyecto['area'];
                $data['motor_productivo'] = $proyecto['motor_productivo'];
                $data['resumen'] = $proyecto['resumen'];
                $data['direccion'] = $proyecto['direccion'];
                $data['municipio'] = $proyecto['municipio'];
                $data['parroquia'] = $proyecto['parroquia'];
                $data['periodo_inicio'] = $proyecto['fecha_inicio'];
                $data['periodo_final'] = $proyecto['fecha_cierre'];

                // obtener integrantes
                $integrantes =  $this->obtenerIntegrantes($proyecto['id']);

                foreach ($integrantes as $integrante) {

                    $data['cedula_estudiante'] = $integrante['cedula'];
                    $data['nombre_estudiante'] = $integrante['nombre'];

                    $calificacionFases = $this->findStudentGrades($integrante['cedula']);

                    foreach ($calificacionFases as $calificacionFase) {
                        if (str_contains($calificacionFase['fase_id'], '_1')) {
                            $data['nota_fase_1'] = $calificacionFase['calificacion'];
                        } else {
                            $data['nota_fase_2'] = $calificacionFase['calificacion'];
                        }
                    }
                    $this->saveHistorico($data);
                }
            }
            parent::commit();
            return '';
        } catch (Exception $e) {
            print($e->getMessage());
            parent::rollBack();
            return '';
        }
    }

    function saveHistorico(array $data): bool
    {
        $result = $this->set('proyecto_historico', $data);
        return $result ? true : false;
    }

    function findStudentGrades(int $cedula): array
    {
        $notas = $this->select('detalles_notas_baremos', [['cedula', '=', $cedula]]);
        return !$notas ? [] : $notas;
    }

    /**
     * Transaccion para inserción de proyectos
     *
     * @return String - código de materia creada
     */
    function insertTransaction(): String
    {
        try {
            parent::beginTransaction();
            // almacenar materia
            $codigo = $this->save();
            $team = $this->saveTeam();

            parent::commit();
            return $codigo;
        } catch (Exception $e) {
            parent::rollBack();
            return '';
        }
    }

    /**
     * Recorre el array de integrantes y los añade a 
     * la tabla de integrantes de proyecto
     *
     * @return void
     */
    public function saveTeam()
    {
        foreach ($this->integrantes as $integrante) {

            $this->set('integrante_proyecto', [
                'proyecto_id' => $this->id,
                'estudiante_id' => "'" . $integrante . "'"
            ]);
        }
    }

    function pendientesACerrar(): array
    {
        $proyectos = $this->select("detalles_proyecto", [['cerrado', '=', 0]]);
        return $proyectos ? $proyectos : [];
    }

    function cerrar(int $idProyecto): void
    {
        $this->update('proyecto', ['cerrado' => 1], [['id', '=', $idProyecto]]);
    }

    public function updateTeam($idProyecto, array $participantes)
    {
        $participantesActuales = $this->select('integrante_proyecto', [['proyecto_id', '=', $idProyecto]]);

        $idParticipantesActuales = array_column($participantesActuales, 'estudiante_id');

        $delete_list = array_diff($idParticipantesActuales, $participantes);
        $insert_list = array_diff($participantes, $idParticipantesActuales);

        foreach ($delete_list as $item) {
            $this->delete('integrante_proyecto', [['estudiante_id', '=', $item], ['proyecto_id', '=', $idProyecto]]);
            // delete $item from DB
        }

        foreach ($insert_list as $item) {
            $this->set('integrante_proyecto', [
                'proyecto_id' => $idProyecto,
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
            unset($data['integrantes']);
            $this->set('proyecto', $data);
            $this->id = $this->lastInsertId();
            return $this->id;
        }
    }

    function remove($id): void
    {
        $this->delete('integrante_proyecto', [['proyecto_id', '=', $id]]);
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
            array(
                'db'        => 'cerrado',
                'dt'        => 6
            )
        );
        return $this->getSSP('detalles_proyecto', 'id', $columns);
    }
}

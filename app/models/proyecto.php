<?php

namespace Model;

use Model\model;
use Utils\Sanitizer;

use Exception;

class proyecto extends model
{

    public $fillable = [
        'estatus',
        'nombre',
        'fase_id',
        'comunidad',
        'direccion',
        'motor_productivo',
        'resumen',
        'municipio',
        'parroquia',
        'tutor_in',
        'tutor_ex',
        'id',
        'area',
        'integrantes',
    ];
    private int $id;
    public int $tutor_id;
    public string $fase_id;
    public string $nombre;
    public string $direccion;
    public string $parroquia;
    public string $resumen;
    public string $municipio;
    public string $comunidad;
    public string $motor_productivo;
    public string $tutor_in;
    public string $tutor_ex;

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
    function insertTransaction(): bool
    {
        try {
            parent::beginTransaction();
            // almacenar materia
            $codigo = $this->save();
            $team = $this->saveTeam();

            parent::commit();
            return true;
        } catch (Exception $e) {
            parent::rollBack();
            return false;
        }
    }

    public function save($id = null)
    {
        $preparedSql = "";
        if ($id) {
            $preparedSql = "INSERT INTO proyecto(id, fase_id, nombre, comunidad, motor_productivo, resumen, direccion, municipio, parroquia, tutor_in, tutor_ex, cerrado) "
                . "VALUES (:id, :fase_id, :nombre, :comunidad, :motor_productivo, :resumen, :direccion, :municipio, :parroquia, :tutor_in, :tutor_ex, 0)";
        } else {
            $preparedSql = "INSERT INTO proyecto(fase_id, nombre, comunidad, motor_productivo, resumen, direccion, municipio, parroquia, tutor_in, tutor_ex, cerrado) "
                . "VALUES (:fase_id, :nombre, :comunidad, :motor_productivo, :resumen, :direccion, :municipio, :parroquia, :tutor_in, :tutor_ex, 0)";
        }
        $query = $this->prepare($preparedSql);

        if ($id) {
            $query->bindParam(":id", $this->id);
        }
        $query->bindParam(":fase_id", $this->fase_id);
        $query->bindParam(":nombre", $this->nombre);
        $query->bindParam(":comunidad", $this->comunidad);
        $query->bindParam(":motor_productivo", $this->motor_productivo);
        $query->bindParam(":resumen", $this->resumen);
        $query->bindParam(":direccion", $this->direccion);
        $query->bindParam(":municipio", $this->municipio);
        $query->bindParam(":parroquia", $this->parroquia);
        $query->bindParam(":tutor_in", $this->tutor_in);
        $query->bindParam(":tutor_ex", $this->tutor_ex);
        $query->execute();

        $this->id = $this->lastInsertId();
        return $this->id;
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
     *consulta para el reporte excel
     * @return array para los integrantes de los poryetcos segun su trayecto
     */
    function IntegrastesPorTrayecto($trayectoId)
    {
        try {
            $dataExcel = $this->querys('SELECT DISTINCT detalles_inscripciones.seccion_id, detalles_estudiantes.cedula,detalles_estudiantes.apellido, detalles_estudiantes.nombre,
            detalles_estudiantes.telefono, detalles_estudiantes.email,detalles_proyecto.comunidad, detalles_integrantes.proyecto_nombre, 
            detalles_proyecto.municipio, detalles_proyecto.motor_productivo, detalles_proyecto.resumen, detalles_proyecto.direccion, 
            detalles_proyecto.parroquia FROM detalles_proyecto 
            INNER JOIN detalles_integrantes ON detalles_proyecto.id = detalles_integrantes.proyecto_id 
            INNER JOIN detalles_estudiantes ON detalles_integrantes.estudiante_id = detalles_estudiantes.id 
            INNER JOIN detalles_inscripciones ON detalles_estudiantes.id = detalles_inscripciones.estudiante_id 
            WHERE detalles_proyecto.codigo_trayecto ="' . $trayectoId . '"' . ' ORDER BY detalles_estudiantes.apellido');
            return $dataExcel ? $dataExcel : null;
        } catch (\PDOException $th) {
            return $th;
        }
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

/* SELECT fase.siguiente_fase, proyecto.*, integrante_proyecto.estudiante_id, estudiante.id as estudiante_id,malla_curricular.codigo,inscripcion.profesor_id, inscripcion.seccion_id,persona.cedula,persona.nombre, persona.apellido FROM fase INNER JOIN proyecto ON fase.codigo = proyecto.fase_id INNER JOIN malla_curricular ON fase.codigo = malla_curricular.fase_id INNER JOIN integrante_proyecto ON proyecto.id = integrante_proyecto.proyecto_id INNER JOIN estudiante ON integrante_proyecto.estudiante_id = estudiante.id INNER JOIN persona ON estudiante.persona_id = persona.cedula INNER JOIN inscripcion ON estudiante.id = inscripcion.estudiante_id INNER JOIN malla_curricular as mc ON inscripcion.unidad_curricular_id = mc.codigo WHERE fase.trayecto_id = 'TR4'; */
/* SELECT DISTINCTROW fase.siguiente_fase, malla_curricular.materia_id, inscripcion.profesor_id, inscripcion.seccion_id, inscripcion.estudiante_id, estudiante.id as estudiante_id, persona.cedula , persona.nombre, persona.apellido, integrante_proyecto.estudiante_id, proyecto.* FROM fase INNER JOIN malla_curricular ON fase.codigo = malla_curricular.fase_id INNER JOIN inscripcion ON malla_curricular.codigo = inscripcion.unidad_curricular_id INNER JOIN estudiante ON inscripcion.estudiante_id = estudiante.id INNER JOIN persona ON estudiante.persona_id = persona.cedula INNER JOIN integrante_proyecto ON estudiante.id = integrante_proyecto.estudiante_id INNER JOIN proyecto on integrante_proyecto.proyecto_id = proyecto.id WHERE fase.trayecto_id = 'TR4' ORDER BY proyecto.id; */
/* SELECT DISTINCT detalles_proyecto.* ,detalles_integrantes.proyecto_id as di_pID , detalles_estudiantes.seccion_id, detalles_estudiantes.nombre, detalles_estudiantes.cedula, detalles_estudiantes.apellido, detalles_estudiantes.email FROM detalles_proyecto INNER JOIN detalles_integrantes ON detalles_proyecto.id = detalles_integrantes.proyecto_id INNER JOIN detalles_estudiantes ON detalles_integrantes.estudiante_id = detalles_estudiantes.id WHERE detalles_proyecto.nombre_trayecto = 'TRA'; */
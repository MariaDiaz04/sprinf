<?php

namespace Model;

use Model\model;
use Utils\Sanitizer;

use Exception;
use PDOException;

class proyecto extends model
{

    public $fillable = [
        'cerrado',
        'nombre',
        'fase_id',
        'comunidad',
        'direccion',
        'resumen',
        'consejo_comunal_id',
        'tutor_in',
        'tutor_ex',
        'tlf_tex',
        'id',
        'area',
        'integrantes',
    ];
    public int $id;
    public int $tutor_id;
    public string $fase_id;
    public string $nombre;
    public string $direccion;
    public int $consejo_comunal_id;
    public string $resumen;
    public string $comunidad;
    public string $tutor_in;
    public string $tutor_ex;
    public string $tlf_tex;
    public int $cerrado;

    public array $integrantes; // has many

    public array $error;

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

    public function save($id = null)
    {
        $preparedSql = "";
        if ($id) {
            $preparedSql = "INSERT INTO proyecto(id, fase_id, nombre, comunidad, resumen, consejo_comunal_id,direccion, tutor_in, tutor_ex, tlf_tex,cerrado) "
                . "VALUES (:id, :fase_id, :nombre, :comunidad,  :resumen, :consejo_comunal_id,:direccion,  :tutor_in, :tutor_ex,:tlf_tex, 0)";
        } else {
            $preparedSql = "INSERT INTO proyecto(fase_id, nombre, comunidad, resumen,consejo_comunal_id, direccion, tutor_in, tutor_ex,tlf_tex, cerrado) "
                . "VALUES (:fase_id, :nombre, :comunidad,  :resumen, :consejo_comunal_id, :direccion, :tutor_in, :tutor_ex,:tlf_tex, 0)";
        }
        $query = $this->prepare($preparedSql);


        if ($id) {
            $query->bindParam(":id", $this->id);
        }
        $query->bindParam(":fase_id", $this->fase_id);
        $query->bindParam(":nombre", $this->nombre);
        $query->bindParam(":comunidad", $this->comunidad);
        $query->bindParam(":resumen", $this->resumen);
        $query->bindParam(":direccion", $this->direccion);
        $query->bindParam(":consejo_comunal_id", $this->consejo_comunal_id);
        $query->bindParam(":tutor_in", $this->tutor_in);
        $query->bindParam(":tutor_ex", $this->tutor_ex);
        $query->bindParam(":tlf_tex", $this->tlf_tex);


        if ($query->execute()) {

            $this->id = $this->lastInsertId();
            return $this->id;
        } else {
            throw new Exception();
        }
    }

    public function actualizar()
    {
        $preparedSql = "UPDATE proyecto SET fase_id=:fase_id, nombre=:nombre, comunidad=:comunidad,  resumen=:resumen, direccion=:direccion, consejo_comunal_id=:consejo_comunal_id, tutor_in=:tutor_in, tutor_ex=:tutor_ex,tlf_tex=:tlf_tex, cerrado= :cerrado WHERE id=:id";

        $query = $this->prepare($preparedSql);

        $query->bindParam(":id", $this->id);
        $query->bindParam(":fase_id", $this->fase_id);
        $query->bindParam(":nombre", $this->nombre);
        $query->bindParam(":comunidad", $this->comunidad);
        $query->bindParam(":resumen", $this->resumen);
        $query->bindParam(":direccion", $this->direccion);
        $query->bindParam(":consejo_comunal_id", $this->consejo_comunal_id);
        $query->bindParam(":tutor_in", $this->tutor_in);
        $query->bindParam(":tutor_ex", $this->tutor_ex);
        $query->bindParam(":tlf_tex", $this->tlf_tex);
        $query->bindParam(":cerrado", $this->cerrado);

        return $query->execute();
    }



    function guardarIntegrante(string $integrante): bool
    {
        $query = $this->prepare("INSERT INTO integrante_proyecto (proyecto_id, estudiante_id) VALUES (:proyecto_id, :estudiante_id)");
        $query->bindParam(":proyecto_id", $this->id);
        $query->bindParam(":estudiante_id", $integrante);
        return $query->execute();
    }

    function removerIntegrante(string $integrante): bool
    {
        $query = $this->prepare("DELETE FROM integrante_proyecto WHERE proyecto_id=:proyecto_id AND estudiante_id=:estudiante_id");
        $query->bindParam(":proyecto_id", $this->id);
        $query->bindParam(":estudiante_id", $integrante);

        return $query->execute();
    }

    function removerIntegrantes($id): bool
    {
        try {
            $query = $this->prepare("DELETE FROM integrante_proyecto WHERE proyecto_id=:proyecto_id");
            $query->bindParam(":proyecto_id", $id);

            $query->execute();
            return $query->rowCount() > 0 ? true : false;
        } catch (Exception $e) {
            $this->error = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'stackTrace' => $e->getTraceAsString()
            ];

            return false;
        }
    }

    function removerProyecto($id): bool
    {
        $query = $this->prepare("DELETE FROM proyecto WHERE id=:id");
        $query->bindParam(":id", $id);

        $query->execute();

        return $query->rowCount() > 0 ? true : false;
    }

    public function all()
    {
        $proyectos = $this->select("detalles_proyecto");
        return $proyectos ? $proyectos : [];
    }

    /**
     * Retorna los datos del proyecto
     *
     * @param [type] $id
     * @return array es vacio si no consigue el proyecto
     */
    public function find($id): array
    {
        $query = $this->prepare("SELECT * FROM detalles_proyecto WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return ($result) ? $result : [];
    }

    /**
     * Encontrar proyecto al que el estudiante pertenece
     *
     * @param string $estudiante_id
     * @return array
     */
    function findByStudent(string $estudiante_id): array
    {
        $query = $this->prepare("SELECT * FROM integrante_proyecto WHERE estudiante_id = :estudiante_id");
        $query->bindParam(":estudiante_id", $estudiante_id);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return ($result) ? $result : [];
    }

    /**
     * Obtener las notas de proyecto de el estudiante
     *
     * @param integer $cedula
     * @return array
     */
    function findStudentGrades(int $cedula): array
    {
        $notas = $this->select('detalles_notas_baremos', [['cedula', '=', $cedula]]);
        return !$notas ? [] : $notas;
    }

    /*
    *consulta para el reporte notas PDF
    * @return array para los integrantes de los poryetcos segun su trayecto
    */
    function NotasIntegrastesProyecto($id): array
    {
        try {
            $notas = $this->querys("SELECT detalles_notas_baremos.fase_id,detalles_notas_baremos.nombre_fase, detalles_notas_baremos.cedula,
            detalles_notas_baremos.ponderado,detalles_notas_baremos.calificacion, persona.nombre, persona.apellido, proyecto.nombre as proyecto_nombre 
            FROM detalles_notas_baremos LEFT JOIN persona ON persona.cedula = detalles_notas_baremos.cedula LEFT JOIN proyecto ON proyecto.id = detalles_notas_baremos.proyecto_id WHERE detalles_notas_baremos.proyecto_id = $id");

            return $notas ? $notas : [];
        } catch (Exception $th) {
            return $th;
        }
    }

    /**
     * Obtiene los integrantes de un proyecto
     *
     * @param [int] $id - ID de proyecto
     * @return array retorna vacio si no tiene integrantes
     */
    function obtenerIntegrantes(int $id): array
    {
        $query = $this->prepare("SELECT * FROM detalles_estudiantes WHERE proyecto_id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        return ($result) ? $result : [];
    }




    /**
     * Actualizar la fase del proyecto
     *
     * @param integer $id
     * @param string $codigoFase
     * @return void
     */
    function actualizarFase(int $id, string $codigoFase): bool
    {
        $query = $this->prepare("UPDATE proyecto SET fase_id=:fase_id WHERE id=:id");
        $query->bindParam(":id", $id);
        $query->bindParam(":fase_id", $codigoFase);
        return $query->execute();
    }

    /**
     * Obtener proyectos pendientes a cerrar
     *
     * @return array
     */
    function pendientesACerrar(): array
    {
        $proyectos = $this->select("detalles_proyecto", [['cerrado', '=', 0]]);
        return $proyectos ? $proyectos : [];
    }

    /**
     * Transaccion para inserción de proyectos
     *
     * @return bool - exito de ejecución
     */
    function insertTransaction(): bool
    {
        try {
            parent::beginTransaction();
            // almacenar materia
            $this->id = $this->save((isset($this->id) ? $this->id : null));
            if (!property_exists($this, 'integrantes') || empty($this->integrantes)) {
                throw new Exception('No se puede generar un proyecto sin integrantes');
            }
            foreach ($this->integrantes as $integrante) {
                $resultado = $this->guardarIntegrante($integrante);
                if (!$resultado) {
                    throw new Exception('No se ha podido añadir el integrante ' . $integrante);
                }
            }
            parent::commit();
            return true;
        } catch (Exception $e) {
            $this->error = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'stackTrace' => $e->getTraceAsString()
            ];
            parent::rollBack();
            return false;
        }
    }

    /**
     * Transaccion que recorre todos los proyectos para
     * enviar su información al historico
     *
     * @return bool
     */
    function historicalTransaction(): bool
    {
        try {
            parent::beginTransaction();
            $proyectos = $this->all();

            foreach ($proyectos as $proyecto) {
                $data['codigo_trayecto'] = $proyecto['codigo_trayecto'];
                $data['nombre_proyecto'] = $proyecto['nombre'];
                $data['parroquia_id'] = $proyecto['parroquia_id'];
                $data['comunidad'] = $proyecto['comunidad'];
                $data['area'] = $proyecto['area'];
                $data['resumen'] = $proyecto['resumen'];
                $data['direccion'] = $proyecto['direccion'];
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
                    $this->set('proyecto_historico', $data);
                }
            }
            parent::commit();
            return true;
        } catch (Exception $e) {
            $this->error = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'stackTrace' => $e->getTraceAsString()
            ];
            parent::rollBack();
            return false;
        }
    }

    function cerrar(int $idProyecto): void
    {
        $this->update('proyecto', ['cerrado' => 1], [['id', '=', $idProyecto]]);
    }

    public function actualizarIntegrantes(): bool|PDOException
    {
        try {
            parent::beginTransaction();
            $participantesActuales = $this->obtenerIntegrantes($this->id);

            $idParticipantesActuales = array_column($participantesActuales, 'estudiante_id');

            $delete_list = array_diff($idParticipantesActuales, $this->integrantes);
            $insert_list = array_diff($this->integrantes, $idParticipantesActuales);

            foreach ($delete_list as $item) {
                $this->removerIntegrante($item);
            }

            foreach ($insert_list as $item) {
                $this->guardarIntegrante($item);
            }

            parent::commit();
            return true;
        } catch (Exception $Exception) {
            parent::rollBack();
            $this->error = [
                'code' => $Exception->getCode(),
                'message' => $Exception->getMessage(),
                'stackTrace' => $Exception->getTraceAsString()
            ];
            return false;
        }
    }



    function remover($id): bool
    {
        try {
            $resultado = $this->removerIntegrantes($id);

            if (!$resultado) return false;

            $resultado = $this->removerProyecto($id);
            if (!$resultado) return false;
            return true;
        } catch (Exception $e) {

            $this->error = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'stackTrace' => $e->getTraceAsString()
            ];
            return false;
        }
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
            detalles_proyecto.municipio,  detalles_proyecto.resumen, detalles_proyecto.direccion, 
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
            ),
            array(
                'db'        => 'fase_id',
                'dt'        => 7
            )
        );
        return $this->getSSP('detalles_proyecto', 'id', $columns);
    }
}

<?php

namespace Model;

use Model\usuario;
use Model\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class estudiante extends model
{

    public $fillable = [
        'id',
        'nombre',
        'apellido',
        'direccion',
        'telefono',
        'email',
        'cedula',
        'persona_id',
    ];

    private string $id;
    private string $persona_id;

    public function all()
    {
        try {
            $estudiantes = $this->select('detalles_estudiantes');
            return $estudiantes ? $estudiantes : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    function setestudianteId(): void
    {
        $this->id = 'e-' . $this->persona_id;
    }


    public function setEstudiante(array $data)
    {
        foreach ($data as $estud => $value) {

            if (property_exists($this, $estud) && in_array($estud, $this->fillable)) {
                $this->{$estud} = $value;
            }
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
            $this->update('estudiante', $data, [['id', '=', $id]]);
        } else {
            $this->set('estudiante', $data);
            return $this->id;
        }
    }
    /**
     * Obtener información del estudiante
     *
     * @param string $id
     * @return array
     */
    function find(string $id): array
    {
        $estudiante = $this->selectOne("detalles_estudiantes", [['id', '=', "'" . $id . "'"]]);
        return !$estudiante ? [] : $estudiante;
    }

    /**
     * Obtener información del estudiante
     *
     * @param string $id
     * @return array
     */
    function findByCedula(string $cedula): array
    {
        $estudiante = $this->selectOne("detalles_estudiantes", [['cedula', '=', "'" . $cedula . "'"]]);
        return !$estudiante ? [] : $estudiante;
    }


    function findByCedulaQuery(string $cedula)
    {
        $estudiante = $this->querys("SELECT persona.nombre, persona.apellido,persona.direccion, persona.cedula, persona.telefono, usuario.email FROM persona LEFT JOIN usuario ON persona.usuario_id = usuario.id WHERE usuario.rol_id= 4 AND persona.cedula = $cedula ");
        if (!!$estudiante) {
            foreach ($estudiante[0] as $key => $value) {
                $this->fillable[$key] = $value;
            }
            return $this;
        } else {
            return [];
        }
    }


    public function findOld(string $cedula)
    {
        try {
            $persona = $this->select('persona', [['cedula', '=', '"' . $cedula . '"']]);
            if ($persona) {
                foreach ($persona[0] as $key => $value) {
                    $this->fillable[$key] = $value;
                }
                return $this;
            } else {
                return [];
            }
        } catch (\PDOException $th) {
            return $th;
        }
    }


    /**
     * Obtener los detalles de una inscripcion
     * por su código de estudiante
     *
     * @param string $cedula
     * @param string $email
     * @return array - es un array vacio en caso de que no consiga alguna coincidencia
     */
    public function findData(string $tabla, string $campo, string $dato)
    {
        $estudiante = $this->select($tabla, [[$campo, '=',  "'$dato'"]]);
        return !$estudiante ? [] : $estudiante;
    }

    /**
     * Actualizar información del estudiante
     *
     * @param string $nombre
     * @param string $apellido
     * @param string $email
     * @param string $direccion
     * @param string $telefono
     * @param integer $cedula
     * @return array
     */
    function updateStudent($nombre, $apellido, $email, $direccion, $telefono, $cedula)
    {

        $estudiante = $this->querys('UPDATE usuario, persona SET persona.nombre =  "' . $nombre . '", persona.apellido = "' . $apellido . '" , persona.direccion = "' . $direccion . '", persona.telefono = "' . $telefono . '", usuario.email = "' . $email . '" WHERE persona.usuario_id = usuario.id AND persona.cedula = "' . $cedula . '"');
        return !$estudiante ? [] : $estudiante;
    }

    public function pendientesAProyecto()
    {
        try {
            $estudiantes = $this->select('estudiantes_pendientes_a_proyecto');
            return $estudiantes ? $estudiantes : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    /**
     * Transaccion para el borrado de secciones
     *
     * @return String
     */
    function deleteTransaction($estudiante_id, $usuario_id): bool
    {
        try {
            parent::beginTransaction();
            // actualizar tabla materia
            $this->delete('estudiante', [['id', '=', '"' . $estudiante_id . '"']]);
            $this->delete('persona', [['usuario_id', '=',  $usuario_id]]);
            $this->delete('usuario', [['id', '=',  $usuario_id]]);
            parent::commit();
            return true;
        } catch (Exception $e) {
            parent::rollBack();
            return false;
        }
    }
    public function byProject($id)
    {
        try {
            $estudiantes = $this->querys("SELECT estudiante_proyecto.id, estudiante_proyecto.estudiante_id, persona.nombre, persona.apellido, persona.cedula FROM estudiante_proyecto LEFT JOIN estudiante ON estudiante.id = estudiante_proyecto.estudiante_id LEFT JOIN persona ON persona.cedula = estudiante.persona_id WHERE estudiante_proyecto.proyecto_id = $id");
            return $estudiantes ? $estudiantes : null;
        } catch (Exception $th) {
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
    public function generarSSP(int $idProyecto = null): array
    {
        $columns = array(
            array(
                'db'        => 'cedula',
                'dt'        => 0
            ),
            array(
                'db'        => 'nombre',
                'dt'        => 1
            ),
            array(
                'db'        => 'apellido',
                'dt'        => 2
            ),
            array(
                'db'        => 'email',
                'dt'        => 3
            ),
            array(
                'db'        => 'telefono',
                'dt'        => 4
            ),
            array(
                'db'        => 'nombre_proyecto',
                'dt'        => 5
            ),
        );
        if (empty($idProyecto)) {
            return $this->getSSP('detalles_estudiantes', 'id', $columns);
        } else {

            return $this->getComplexSSP('detalles_estudiantes', 'id', $columns, ['condition' => "proyecto_id = $idProyecto"]);
        }
    }

    /**
     * Obtener información del las notas del estudiante
     *
     * @param string $id
     * @return array
     */
    function findNotesByStudents(string $cedula): array
    {
        try {
            $notas = $this->querys("SELECT detalles_notas_baremos.fase_id,detalles_notas_baremos.nombre_fase, detalles_notas_baremos.cedula,detalles_notas_baremos.ponderado,detalles_notas_baremos.calificacion,
            persona.nombre, persona.apellido, proyecto.nombre as proyecto_nombre 
            FROM detalles_notas_baremos LEFT JOIN persona ON persona.cedula = detalles_notas_baremos.cedula LEFT JOIN proyecto ON proyecto.id = detalles_notas_baremos.proyecto_id WHERE detalles_notas_baremos.cedula = $cedula");
            return $notas ? $notas : [];
        } catch (Exception $th) {
            return $th;
        }
    }
}

<?php

namespace App;

use App\usuario;
use App\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class estudiante extends model
{

    public $fillable = [
        'id',
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


    public function pendientesAProyecto()
    {
        try {
            $estudiantes = $this->select('estudiantes_pendientes_a_proyecto');
            return $estudiantes ? $estudiantes : null;
        } catch (Exception $th) {
            return $th;
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
    public function generarSSP(): array
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
            )
        );
        return $this->getSSP('detalles_estudiantes', 'cedula', $columns);
    }
}

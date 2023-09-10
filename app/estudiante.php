<?php

namespace App;

use App\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class estudiante extends model
{

    public $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'direccion',
        'telefono',
        'nacimiento',
        'estatus'
    ];

    public function all()
    {
        try {
            $estudiantes = $this->select('detalles_estudiantes');
            return $estudiantes ? $estudiantes : null;
        } catch (Exception $th) {
            return $th;
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
        $proyectos = $this->selectOne("detalles_estudiantes", [['id', '=', "'" . $id . "'"]]);
        return !$proyectos ? [] : $proyectos;
    }

    public function listPendingForProject()
    {
        try {
            $estudiantes = $this->select('detalles_estudiantes', [['id', 'NOT IN', '(SELECT estudiante_id FROM integrante_proyecto)']]);
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

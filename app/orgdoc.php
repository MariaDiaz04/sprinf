<?php

namespace App;

use App\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class orgdoc extends model
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
            $orgdoc = $this->querys('SELECT orgdoc.*, persona.nombre, persona.apellido, persona.cedula FROM orgdoc INNER JOIN persona ON persona.id = orgdoc.persona_id');
            return $orgdoc ? $orgdoc : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    public function listPendingForProject()
    {
        try {
            $orgdoc = $this->querys('SELECT orgdoc.*, persona.nombre, persona.apellido, persona.cedula FROM orgdoc INNER JOIN persona ON persona.id = orgdoc.persona_id WHERE orgdoc.id NOT IN (SELECT estudiante_id FROM estudiante_proyecto)');
            return $orgdoc ? $orgdoc : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    public function byProject($id)
    {
        try {
            $orgdoc = $this->querys("SELECT estudiante_proyecto.id, estudiante_proyecto.estudiante_id, persona.nombre, persona.apellido, persona.cedula FROM estudiante_proyecto LEFT JOIN orgdoc ON orgdoc.id = estudiante_proyecto.estudiante_id LEFT JOIN persona ON persona.id = orgdoc.persona_id WHERE estudiante_proyecto.proyecto_id = $id");
            return $orgdoc ? $orgdoc : null;
        } catch (Exception $th) {
            return $th;
        }
    }
}
<?php

namespace App;

use App\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class coordinador extends model
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
            $coordinadores = $this->querys('SELECT coordinador.*, persona.nombre, persona.apellido, persona.cedula FROM coordinador INNER JOIN persona ON persona.id = coordinador.persona_id');
            return $coordinadores ? $coordinadores : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    public function listPendingForProject()
    {
        try {
            $coordinadores = $this->querys('SELECT coordinador.*, persona.nombre, persona.apellido, persona.cedula FROM coordinador INNER JOIN persona ON persona.id = coordinador.persona_id WHERE coordinador.id NOT IN (SELECT estudiante_id FROM estudiante_proyecto)');
            return $coordinadores ? $coordinadores : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    public function byProject($id)
    {
        try {
            $coordinadores = $this->querys("SELECT estudiante_proyecto.id, estudiante_proyecto.estudiante_id, persona.nombre, persona.apellido, persona.cedula FROM estudiante_proyecto LEFT JOIN coordinador ON coordinador.id = estudiante_proyecto.estudiante_id LEFT JOIN persona ON persona.id = coordinador.persona_id WHERE estudiante_proyecto.proyecto_id = $id");
            return $coordinadores ? $coordinadores : null;
        } catch (Exception $th) {
            return $th;
        }
    }
}

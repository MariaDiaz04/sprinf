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
            $estudiantes = $this->querys('SELECT estudiante.*, persona.nombre, persona.apellido, persona.cedula FROM estudiante INNER JOIN persona ON persona.id = estudiante.persona_id');
            return $estudiantes ? $estudiantes : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    public function listPendingForProject()
    {
        try {
            $estudiantes = $this->querys('SELECT estudiante.*, persona.nombre, persona.apellido, persona.cedula FROM estudiante INNER JOIN persona ON persona.id = estudiante.persona_id WHERE estudiante.id NOT IN (SELECT estudiante_id FROM estudiante_proyecto)');
            return $estudiantes ? $estudiantes : null;
        } catch (Exception $th) {
            return $th;
        }
    }
}


<?php 
namespace App;
use App\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class tutor extends model
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
            $tutores = $this->querys('SELECT tutor.*, persona.nombre, persona.apellido, persona.cedula FROM tutor INNER JOIN persona ON persona.id = tutor.persona_id');
            return $tutores ? $tutores : null;
        } catch (Exception $th) {
            return $th;
        }
    }
}


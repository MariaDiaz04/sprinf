<?php

namespace App;

use App\model;


use Exception;

class proyecto extends model
{

    public $fillable = [
        'tutor_id',
        'trayecto_id',
        'nombre',
        'descripcion',
        'municipio',
        'area',
        'repositorio_codigo',
        'repositorio_documentacion',
        'url',
        'estatus',
    ];

    public function all()
    {
        try {
            $proyectos = $this->select('proyecto');
            return $proyectos ? $proyectos : null;
        } catch (Exception $th) {
            return $th;
        }
    }
}

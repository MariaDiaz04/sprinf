<?php

namespace App;

use App\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class dimension extends model
{

  public $fillable = [
    'baremos_id',
    'nombre',
    'porcentaje',
    'esTutor'
  ];

  public function all()
  {
    try {
      $materias = $this->querys('SELECT dimension.id, trayecto.nombre as baremos, dimension.porcentaje, dimension.esTutor FROM dimension INNER JOIN baremos ON baremos.id = dimension.baremos_id INNER JOIN trayecto ON trayecto.id = baremos.trayecto_id');
      return $materias ? $materias : null;
    } catch (Exception $th) {
      return $th;
    }
  }
}

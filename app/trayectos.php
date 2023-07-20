<?php

namespace App;

use App\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class trayectos extends model
{

  public $fillable = [
    'coordinador_id',
    'nombre',
  ];

  public function all()
  {
    try {
      $trayectos = $this->select('trayecto');
      return $trayectos ? $trayectos : null;
    } catch (Exception $th) {
      return $th;
    }
  }
}

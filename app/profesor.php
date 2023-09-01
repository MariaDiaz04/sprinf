<?php

namespace App;

use App\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class profesor extends model
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
      $estudiantes = $this->select('detalles_profesores');
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
    return $this->getSSP('detalles_profesores', 'cedula', $columns);
  }
}

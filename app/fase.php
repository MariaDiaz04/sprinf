<?php

namespace App;

use App\model;

use Exception;
use Utils\Sanitizer;

class fase extends model
{

  public $fillable = [
    'fecha_inicio',
    'fecha_cierre',
  ];
  private $id;
  private $fecha_inicio;
  private $fecha_cierre;

  /**
   * Obtener informacion de fase
   *
   * @param string $codigo codigo de la fase
   * @return array
   */
  function find(string $codigo): array
  {

    $fase = $this->selectOne('detalles_fase', [['codigo_fase', '=', "'" . $codigo . "'"]]);

    return !$fase ? [] : $fase;
  }
}

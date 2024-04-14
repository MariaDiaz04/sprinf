<?php

namespace Model;

use Model\model;

use Exception;
use Utils\sanitizer;

class fase extends model
{

  public $fillable = [
    'fecha_inicio',
    'fecha_cierre',
  ];
  private $id;
  private $fecha_inicio;
  private $fecha_cierre;

  public function all()
  {
    try {
      $estudiantes = $this->select('detalles_fase');
      return $estudiantes ? $estudiantes : null;
    } catch (Exception $th) {
      return $th;
    }
  }


  function getPrimerFaseDeTrayectos(): array
  {
    $estudiantes = $this->select('detalles_fase', [['codigo_fase', 'like', '"%_1"']]);
    return $estudiantes ? $estudiantes : [];
  }

  function getFaseDeTrayecto($fase, $trayecto): array
  {
    $estudiantes = $this->selectOne('detalles_fase', [['codigo_fase', 'like', '"%_' . $fase . '"'], ['codigo_trayecto', '=', '"' . $trayecto . '"']]);
    return $estudiantes ? $estudiantes : [];
  }

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

  function getByTrayecto(string $codigo): array
  {
    $estudiantes = $this->select('detalles_fase', [['codigo_trayecto', '=', '"' . $codigo . '"']]);
    return $estudiantes ? $estudiantes : [];
  }
}

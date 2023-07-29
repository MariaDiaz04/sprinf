<?php

namespace App;

use App\model;


use Exception;

class aspectos extends model
{

  public $fillable = [
    'dimension_id',
    'nombre',
    'fase',
    'tipo'
  ];

  private int $id;
  public int $dimension_id;
  public string $nombre;
  public string $fase;
  public string $tipo;

  public function all()
  {
    try {
      $baremos = $this->querys("SELECT aspectos.id, trayecto.nombre as baremos, aspectos.dimension_id, aspectos.nombre, aspectos.fase, aspectos.tipo FROM aspectos INNER JOIN dimension ON dimension.id = aspectos.dimension_id INNER JOIN baremos ON baremos.id = dimension.baremos_id INNER JOIN trayecto ON trayecto.id = baremos.trayecto_id");
      return $baremos ? $baremos : null;
    } catch (Exception $th) {
      return $th;
    }
  }

  public function find($id)
  {
    try {
      $baremos = $this->querys("SELECT aspectos.id, baremos.id as baremos, aspectos.dimension_id, aspectos.nombre, aspectos.fase, aspectos.tipo FROM aspectos INNER JOIN dimension ON dimension.id = aspectos.dimension_id INNER JOIN baremos ON baremos.id = dimension.baremos_id WHERE aspectos.id = $id");
      return $baremos ? reset($baremos) : null;
    } catch (Exception $th) {
      return $th;
    }
  }
}

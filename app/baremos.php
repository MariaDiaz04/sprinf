<?php

namespace App;

use App\model;


use Exception;

class baremos extends model
{

  public $fillable = [
    'trayecto_id',
    'estatus'
  ];

  private int $id;
  public int $trayecto_id;
  public string $estatus;

  public function all()
  {
    try {
      $baremos = $this->querys("SELECT baremos.*, trayecto.nombre as trayecto FROM baremos INNER JOIN trayecto ON trayecto.id = baremos.trayecto_id WHERE estatus != 0");
      return $baremos ? $baremos : null;
    } catch (Exception $th) {
      return $th;
    }
  }

  public function find($id)
  {
    try {
      $baremos = $this->querys("SELECT baremos.*, trayecto.nombre as trayecto FROM baremos INNER JOIN trayecto ON trayecto.id = baremos.trayecto_id WHERE estatus != 0 AND baremos.id = $id");
      return $baremos ? reset($baremos) : null;
    } catch (Exception $th) {
      return $th;
    }
  }
}

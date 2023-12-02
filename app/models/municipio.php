<?php

namespace Model;

use Model\model;
use Utils\Sanitizer;

use Exception;

class municipio extends model
{

  public $fillable = [
    'id',
    'nombre',
  ];
  public int $id;
  public string $nombre;

  public array $error;

  public function all()
  {
    $proyectos = $this->select("municipios");
    return $proyectos ? $proyectos : [];
  }
}

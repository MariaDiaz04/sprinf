<?php

namespace Model;

use Model\model;
use Utils\sanitizer;

use Exception;

class malla extends model
{

  public $fillable = [
    'codigo',
    'fase_id',
    'materia_id'
  ];

  private $codigo;
  private $fase_id;
  private $materia_id;

  function findByTrayecto(string $codigoTrayecto): array
  {
    $materias = $this->select('detalles_malla', [['codigo_trayecto', '=', '"' . $codigoTrayecto . '"']]);
    return !$materias ? [] : $materias;
  }

  function findMateria(string $codigoMateria): array
  {
    $materias = $this->selectOne('detalles_malla', [['codigo', '=', '"' . $codigoMateria . '"']]);
    return !$materias ? [] : $materias;
  }

  function findByMateria(string $codigoMateria): array
  {
    $materias = $this->select('detalles_malla', [['codigo_materia', '=', '"' . $codigoMateria . '"']]);
    return !$materias ? [] : $materias;
  }


  /**
   * setData
   * 
   * Se encarga de asignar los valores en los campos
   * definidos en la variable "fillable", tambien se 
   * encarga de sanitizar cada uno de estos valores
   *
   * @param array $data
   * @return void
   */
  public function setData(array $data)
  {
    foreach ($data as $prop => $value) {

      if (property_exists($this, $prop) && in_array($prop, $this->fillable)) {
        $this->{$prop} = $value;
      }
    }
  }

  function getQuery(): array
  {
    $data = [];

    foreach ($this->fillable as $key => $value) {
      if (isset($this->{$value})) {
        if (is_string($this->{$value})) {
          $data[$value] = '"' . Sanitizer::sanitize($this->{$value}) . '"';
        } else {
          $data[$value] =  $this->{$value};
        }
      }
    }

    return $data;
  }

  /**
   * save
   * 
   * Se encarga de tomar los valores que fueron asignados al modelo
   * previamente y realizar la consulta SQL
   *
   * @param [type] $id
   * @return integer ID de elemento creado o actualizado
   */
  public function save($codigo = null): int
  {
    $data = [];

    foreach ($this->fillable as $key => $value) {
      if (isset($this->{$value})) {
        if (is_string($this->{$value})) {
          $data[$value] = '"' . Sanitizer::sanitize($this->{$value}) . '"';
        } else {
          $data[$value] =  $this->{$value};
        }
      }
    }
    if ($codigo) {
      $this->update('malla_curricular', $data, [['codigo', '=', $codigo]]);
      return $codigo;
    } else {
      $this->set('malla_curricular', $data);
      $this->codigo = $this->lastInsertId();
      return $this->codigo;
    }
  }
}

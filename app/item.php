<?php

namespace App;

use App\model;
use Utils\Sanitizer;
use Exception;

class dimension extends model
{

  public $fillable = [
    'dimension_id',
    'ponderacion'
  ];

  private $id;
  private $dimension_id;
  private $ponderacion;

  public function all()
  {
    try {
      $materias = $this->querys('SELECT dimension.id, trayecto.nombre as baremos, dimension.porcentaje, dimension.esTutor FROM dimension INNER JOIN baremos ON baremos.id = dimension.baremos_id INNER JOIN trayecto ON trayecto.id = baremos.trayecto_id');
      return $materias ? $materias : null;
    } catch (Exception $th) {
      return $th;
    }
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

  /**
   * save
   * 
   * Se encarga de tomar los valores que fueron asignados al modelo
   * previamente y realizar la consulta SQL
   *
   * @param [type] $id
   * @return integer ID de elemento creado o actualizado
   */
  public function save($id = null): int
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
    if ($id) {
      $this->update('items', $data, [['id', '=', $id]]);
      return $id;
    } else {
      $this->set('items', $data);
      $this->id = $this->lastInsertId();
      return $this->id;
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
        'db'        => 'id',
        'dt'        => 0
      ),
      array(
        'db'        => 'dimension_id',
        'dt'        => 1,
        'formatter' => function ($d, $row) {
          return date('d/m/Y', strtotime($d));
        }
      ),
      array(
        'db'        => 'ponderacion',
        'dt'        => 2,
        'formatter' => function ($d, $row) {
          return date('d/m/Y', strtotime($d));
        }
      )
    );
    return $this->getSSP('items', 'id', $columns);
  }
}

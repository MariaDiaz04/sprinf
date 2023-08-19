<?php

namespace App;

use App\model;

use Exception;
use Utils\Sanitizer;

class periodo extends model
{

  public $fillable = [
    'fecha_inicial',
    'fecha_final',
  ];
  private $id;
  private $fecha_inicial;
  private $fecha_final;

  public function all()
  {
    try {
      $periodos = $this->select('periodo');
      return $periodos ? $periodos : null;
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
        $this->{$prop} = Sanitizer::sanitize($value);
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
          $data[$value] = '"' . $this->{$value} . '"';
        } else {
          $data[$value] =  $this->{$value};
        }
      }
    }
    if ($id) {
      $this->update('periodos', $data, [['id', '=', $id]]);
      return $id;
    } else {
      $this->set('periodos', $data);
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
        'db'        => 'fecha_inicial',
        'dt'        => 1,
        'formatter' => function ($d, $row) {
          return date('jS M y', strtotime($d));
        }
      ),
      array(
        'db'        => 'fecha_final',
        'dt'        => 2,
        'formatter' => function ($d, $row) {
          return date('jS M y', strtotime($d));
        }
      )
    );
    return $this->getSSP('periodos', 'id', $columns);
  }
}

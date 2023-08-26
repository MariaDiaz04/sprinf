<?php

namespace App;

use App\model;

use Exception;
use Utils\Sanitizer;

class clases extends model
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
      $periodos = $this->select('clases');
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
      $this->update('clases', $data, [['id', '=', $id]]);
      return $id;
    } else {
      $this->set('clases', $data);
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
        'db'        => 'codigo',
        'dt'        => 0
      ),
      array(
        'db'        => 'nombre',
        'dt'        => 1
      ),
      array(
        'db'        => 'profesor',
        'dt'        => 2
      ),
      array(
        'db'        => 'seccion_id',
        'dt'        => 3
      ),
      array(
        'db'        => 'nombre_fase',
        'dt'        => 4
      ),
      array(
        'db'        => 'nombre_trayecto',
        'dt'        => 5
      ),
      array(
        'db'        => 'estudiantes',
        'dt'        => 6
      ),
    );
    return $this->getSSP('detalles_clases', 'codigo', $columns);
  }
}

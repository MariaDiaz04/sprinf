<?php

namespace App;

use App\model;
use Utils\Sanitizer;

use Exception;

class trayectos extends model
{

  public $fillable = [
    'periodo_id',
    'numero_trayecto',
    'estatus',
  ];

  private int $id;
  private string $numero_trayecto;
  private int $periodo_id;
  private int $estatus;

  public function all()
  {
    try {
      $trayectos = $this->select('detalles_trayecto');
      return $trayectos ? $trayectos : null;
    } catch (Exception $th) {
      return $th;
    }
  }

  /**
   * Obtener trayecto por codigo de fase
   *
   * @param string $codigoFase
   * @return array
   */
  function findByFase(string $codigoFase): array
  {
    $proyectos = $this->selectOne("detalles_fase", [['codigo_fase', '=', "'" . $codigoFase . "'"]]);
    return !$proyectos ? [] : $proyectos;
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
   * previamente y realizar la consulta SQL guardar/actualizar
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
      $this->update('trayecto', $data, [['id', '=', $id]]);
      return $id;
    } else {
      $this->set('trayecto', $data);
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
        'db'        => 'fecha_inicio',
        'dt'        => 2
      ),
      array(
        'db'        => 'fecha_cierre',
        'dt'        => 3
      )
    );
    return $this->getSSP('detalles_trayecto', 'codigo', $columns);
  }
}

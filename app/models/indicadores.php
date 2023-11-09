<?php

namespace Model;

use Model\model;
use Utils\Sanitizer;
use Exception;

class indicadores extends model
{

  public $fillable = [
    'id',
    'dimension_id',
    'nombre',
    'ponderacion'
  ];

  public $id;
  private $dimension_id;
  private $nombre;
  private $ponderacion;

  public array $error;


  function findByDimension($dimension_id): array
  {
    $query = $this->prepare("SELECT * FROM detalles_baremos WHERE dimension_id = :id");
    $query->bindParam(":id", $dimension_id);
    $query->execute();
    $result = $query->fetch(\PDO::FETCH_ASSOC);
    return ($result) ? $result : [];
  }

  /**
   * Retorna los datos del indiacodr
   *
   * @param [type] $id
   * @return array es vacio si no consigue el indicador
   */
  public function find($id): array
  {
    $query = $this->prepare("SELECT * FROM indicadores WHERE id = :id");
    $query->bindParam(":id", $id);
    $query->execute();
    $result = $query->fetch(\PDO::FETCH_ASSOC);
    return ($result) ? $result : [];
  }

  public function actualizar(): bool
  {
    $preparedSql = "UPDATE indicadores SET dimension_id=:dimension_id, nombre=:nombre, ponderacion=:ponderacion WHERE id=:id";

    $query = $this->prepare($preparedSql);

    $query->bindParam(":id", $this->id);
    $query->bindParam(":dimension_id", $this->dimension_id);
    $query->bindParam(":nombre", $this->nombre);
    $query->bindParam(":ponderacion", $this->ponderacion);

    return $query->execute();
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
   * @return bool - ejecucion exitosa
   */
  public function save(): int
  {
    $query = $this->prepare("INSERT INTO indicadores(dimension_id, nombre, ponderacion) VALUES (:dimension_id, :nombre, :ponderacion)");
    $query->bindParam(":dimension_id", $this->dimension_id);
    $query->bindParam(":nombre", $this->nombre);
    $query->bindParam(":ponderacion", $this->ponderacion);
    $query->execute();
    $this->id = $this->lastInsertId();
    return true;
  }

  function remove(): bool
  {
    $query = $this->prepare("DELETE FROM indicadores WHERE id=:id");
    $query->bindParam(":id", $this->id);
    $query->execute();
    return $query->rowCount() > 0 ? true : false;
  }

  /**
   * generarComplexSSP
   * 
   * Generar SSP proveniente de la función de data table
   *
   * @return array
   */
  public function generarComplexSSP(string $dimension_id): array
  {
    $columns = array(
      array(
        'db'        => 'id',
        'dt'        => 0
      ),
      array(
        'db'        => 'nombre',
        'dt'        => 1
      ),
      array(
        'db'        => 'ponderacion',
        'dt'        => 2
      )
    );
    return $this->getComplexSSP('indicadores', 'id', $columns, ['condition' => "dimension_id = '$dimension_id'"]);
  }
}

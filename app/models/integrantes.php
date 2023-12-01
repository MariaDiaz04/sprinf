<?php

namespace Model;

use Model\model;
use Utils\Sanitizer;
use Exception;
use PDOException;

class integrantes extends model
{

  public $fillable = [
    'id',
    'estudiante_id',
    'proyecto_id',
    'estatus',
  ];

  public $id;
  private $estudiante_id;
  private $proyecto_id;
  private $estatus;

  public array $error; // has many

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
   * Retorna los datos del integrante de Proyecto
   *
   * @param [type] $id
   * @return array es vacio si no consigue el integrante
   */
  public function find($id): array
  {
    $query = $this->prepare("SELECT * FROM detalles_integrantes WHERE id = :id");
    $query->bindParam(":id", $id);
    $query->execute();
    $result = $query->fetch(\PDO::FETCH_ASSOC);
    return ($result) ? $result : [];
  }

  function save(): bool
  {
    $query = $this->prepare("INSERT INTO integrante_proyecto (proyecto_id, estudiante_id) VALUES (:proyecto_id, :estudiante_id)");
    $query->bindParam(":proyecto_id", $this->id);
    $query->bindParam(":estudiante_id", $this->estudiante_id);
    return $query->execute();
  }

  function remove(): bool
  {
    $query = $this->prepare("DELETE FROM integrante_proyecto WHERE proyecto_id=:proyecto_id AND estudiante_id=:estudiante_id");
    $query->bindParam(":proyecto_id", $this->id);
    $query->bindParam(":estudiante_id", $this->estudiante_id);

    return $query->execute();
  }

  /**
   * generarComplexSSP
   * 
   * Generar SSP proveniente de la función de data table
   *
   * @return array
   */
  public function generarComplexSSP(int $proyectoId): array
  {
    $columns = array(
      array(
        'db'        => 'id',
        'dt'        => 0
      ),
      array(
        'db'        => 'cedula',
        'dt'        => 1
      ),
      array(
        'db'        => 'nombre_completo',
        'dt'        => 2
      ),
      array(
        'db'        => 'nombre_fase',
        'dt'        => 3
      ),
      array(
        'db'        => 'calificaciones',
        'dt'        => 4
      ),
      array(
        'db'        => 'estatus',
        'dt'        => 5
      )
    );
    return $this->getComplexSSP('detalles_integrantes', 'id', $columns, ['condition' => "proyecto_id = $proyectoId"]);
  }
}

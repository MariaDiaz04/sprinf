<?php

namespace Model;

use Model\model;
use Utils\sanitizer;

use Exception;

class parroquia extends model
{

  public $fillable = [
    'id',
    'nombre',
    'municipio',
  ];
  public int $id;
  public string $nombre;
  public int $municipio;

  public array $error;

  /**
   * Definir los valores del proyecto
   *
   * @param array $data
   * @return void
   */
  public function setData(array $data)
  {
    foreach ($data as $prop => $value) {
      if (property_exists($this, $prop) && in_array($prop, $this->fillable)) {
        if (is_string($value)) {
          $this->{$prop} =  Sanitizer::sanitize($value);
        } else {
          $this->{$prop} = $value;
        }
      }
    }
  }

  public function save($id = null)
  {

    $query = $this->prepare("INSERT INTO parroquias(nombre, municipio) VALUES (:nombre, :municipio)");

    $query->bindParam(":nombre", $this->nombre);
    $query->bindParam(":municipio", $this->municipio);
    if ($query->execute()) {

      $this->id = $this->lastInsertId();
      return $this->id;
    } else {
      throw new Exception('Error insertando parroquia');
    }
  }

  public function actualizar()
  {
    $preparedSql = "UPDATE parroquias SET nombre=:nombre, municipio=:municipio WHERE id=:id";

    $query = $this->prepare($preparedSql);

    $query->bindParam(":id", $this->id);
    $query->bindParam(":nombre", $this->nombre);
    $query->bindParam(":municipio", $this->municipio);

    return $query->execute();
  }

  public function all()
  {
    $proyectos = $this->select("parroquias");
    return $proyectos ? $proyectos : [];
  }

  public function allDetalles()
  {
    $proyectos = $this->select("detalles_parroquia");
    return $proyectos ? $proyectos : [];
  }

  /**
   * Retorna los datos del proyecto
   *
   * @param [type] $id
   * @return array es vacio si no consigue el proyecto
   */
  public function find($id): array
  {
    $query = $this->prepare("SELECT * FROM detalles_parroquia WHERE parroquia_id = :id");
    $query->bindParam(":id", $id);
    $query->execute();
    $result = $query->fetch(\PDO::FETCH_ASSOC);
    return ($result) ? $result : [];
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
        'db'        => 'nombre',
        'dt'        => 1
      ),
      array(
        'db'        => 'comunidad',
        'dt'        => 2
      ),
      array(
        'db'        => 'nombre_trayecto',
        'dt'        => 3
      ),
      array(
        'db'        => 'nombre_fase',
        'dt'        => 4
      ),
      array(
        'db'        => 'integrantes',
        'dt'        => 5
      ),
      array(
        'db'        => 'cerrado',
        'dt'        => 6
      ),
      array(
        'db'        => 'fase_id',
        'dt'        => 7
      )
    );
    return $this->getSSP('detalles_proyecto', 'id', $columns);
  }
}

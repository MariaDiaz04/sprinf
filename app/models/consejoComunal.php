<?php

namespace Model;

use Model\model;

use Exception;
use Utils\Sanitizer;

class consejoComunal extends model
{

  public $fillable = [
    'id',
    'nombre',
    'nombre_vocero',
    'sector_id',
    'telefono',
  ];
  public ?int $id;
  public string $nombre;
  public string $nombre_vocero;
  public int $sector_id;
  public int $telefono;

  public function all(): array
  {
    $consejos = $this->select('detalles_consejo_comunal');
    return $consejos ? $consejos : [];
  }

  /**
   * Obtener los detalles de un consejo comunal
   * por su código de estudiante
   *
   * @param string $codigo
   * @return array - es un array vacio en caso de que no consiga alguna coincidencia
   */
  public function find(string $codigo)
  {
    $consejos = $this->selectOne('detalles_consejo_comunal', [['consejo_comunal_id', '=', '"' . $codigo . '"']]);
    return !$consejos ? [] : $consejos;
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
    $query = $this->prepare("INSERT INTO consejo_comunal(nombre, nombre_vocero,sector_id,telefono) VALUES (:nombre, :nombre_vocero, :sector_id, :telefono)");
    $query->bindParam(":nombre", $this->nombre);
    $query->bindParam(":nombre_vocero", $this->nombre_vocero);
    $query->bindParam(":sector_id", $this->sector_id);
    $query->bindParam(":telefono", $this->telefono);
    $query->execute();
    $this->id = $this->lastInsertId();
    return true;
  }

  public function actualizar(): bool
  {
    $preparedSql = "UPDATE consejo_comunal SET nombre=:nombre, nombre_vocero=:nombre_vocero, sector_id=:sector_id, telefono=:telefono WHERE id=:id";

    $query = $this->prepare($preparedSql);

    $query->bindParam(":id", $this->id);
    $query->bindParam(":nombre", $this->nombre);
    $query->bindParam(":nombre_vocero", $this->nombre_vocero);
    $query->bindParam(":sector_id", $this->sector_id);
    $query->bindParam(":telefono", $this->telefono);

    return $query->execute();
  }

  function remove(int $id): bool
  {
    $query = $this->prepare("DELETE FROM consejo_comunal WHERE id=:id");
    $query->bindParam(":id", $id);
    $query->execute();
    return $query->rowCount() > 0 ? true : false;
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
   * generarComplexSSP
   * 
   * Generar SSP proveniente de la función de data table
   *
   * @return array
   */
  public function generarComplexSSP(string $idMateria): array
  {
    $columns = array(
      array(
        'db'        => 'consejo_comunal_id',
        'dt'        => 0
      ),
      array(
        'db'        => 'consejo_comunal_nombre',
        'dt'        => 1,
      ),
      array(
        'db'        => 'consejo_comunal_telefono',
        'dt'        => 2,
      ),
      array(
        'db'        => 'sector_id',
        'dt'        => 3,
      ),
      array(
        'db'        => 'sector_nombre',
        'dt'        => 4,
      ),
      array(
        'db'        => 'parroquia_id',
        'dt'        => 5,
      ),
      array(
        'db'        => 'parroquia_nombre',
        'dt'        => 6,
      ),
      array(
        'db'        => 'municipio_nombre',
        'dt'        => 7,
      )
    );
    return $this->getSSP('detalles_consejo_comunal', 'consejo_comunal_id', $columns);
  }
}

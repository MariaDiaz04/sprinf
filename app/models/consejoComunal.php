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

  public function all()
  {
    try {
      $consejos = $this->select("SELECT consejo_comunal.*, sector_consejo_comunal.nombre as sector FROM consejo_comunal INNER JOIN sector_consejo_comunal ON sector_consejo_comunal.id = sector_consejo_comunal.nombre
    ");
      return $consejos ? $consejos : null;
    } catch (Exception $th) {
      return $th;
    }
  }

  public function allDetalles()
  {
    $proyectos = $this->select("detalles_consejo_comunal");
    return $proyectos ? $proyectos : [];
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



  public function Selectcod()
  {

    $codigo = $this->query(
      'SELECT
                sector_consejo_comunal.id AS id,
                sector_consejo_comunal.nombre AS nombre
            FROM
                
                `sector_consejo_comunal`;'
    );
    return $codigo;
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
    $query = $this->prepare("INSERT INTO consejo_comunal(nombre, nombre_vocero, sector_id, telefono) VALUES (:nombre, :nombre_vocero, :sector_id, :telefono)");
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

  function remove(): bool
  {
    $query = $this->prepare("DELETE FROM consejo_comunal WHERE id=:id");
    $query->bindParam(":id", $id);
    $query->execute();
    return $query->rowCount() > 0 ? true : false;
  }

  function deleteTransaction(string $id): bool
  {
    try {
      parent::beginTransaction();
      // actualizar tabla materia
      $delete = $this->delete('consejo_comunal', [['id', '=',  $id]]);
      parent::commit();
      return true;
    } catch (Exception $e) {
      parent::rollBack();
      return false;
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
   * generarComplexSSP
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
        'dt'        => 1,
      ),
      array(
        'db'        => 'nombre_vocero',
        'dt'        => 2,
      ),
      array(
        'db'        => 'sector_id',
        'dt'        => 3,
      ),
      array(
        'db'        => 'telefono',
        'dt'        => 4,
      )
    );
    return $this->getSSP('consejo_comunal', 'id', $columns);
  }
}

<?php

namespace Model;

use Model\model;
use Utils\Sanitizer;
use Exception;

class sector extends model
{

  public $fillable = [
    'id',
    'parroquia_id',
    'nombre',
  ];

  public int $id;
  public int $parroquia_id;
  private string $nombre;
  public array $error;


  public function all()
  {
    try {
      $sector = $this->querys("SELECT sector_consejo_comunal.*, parroquias.nombre as parroquias FROM sector_consejo_comunal INNER JOIN parroquias ON parroquias.id = sector_consejo_comunal.parroquia_id");
      return $sector ? $sector : null;
  } catch (Exception $th) {
      return $th;
  }
  }

  
  /**
   * Retorna los datos del indiacodr
   *
   * @param [type] $id
   * @return array es vacio si no consigue el indicador
   */
  public function find($id): array
  {
    $query = $this->prepare("SELECT * FROM sector_consejo_comunal WHERE id = :id");
    $query->bindParam(":id", $id);
    $query->execute();
    $result = $query->fetch(\PDO::FETCH_ASSOC);
    return ($result) ? $result : [];
  }

  /**
   * save
   * 
   * Se encarga de tomar los valores que fueron asignados al modelo
   * previamente y realizar la consulta SQL
   *
   * @return bool - ejecucion exitosa
   */
  public function save()
  {
   
    $query = $this->prepare("INSERT INTO sector_consejo_comunal(parroquia_id, nombre) VALUES (:parroquia_id, :nombre)");
    $query->bindParam(":parroquia_id", $this->parroquia_id);
    $query->bindParam(":nombre", $this->nombre);
    $query->execute();
    $this->id = $this->lastInsertId();
    return true;
  }

  public function actualizar(): bool
  {
    $preparedSql = "UPDATE sector_consejo_comunal SET nombre=:nombre, parroquia_id=:parroquia_id WHERE id=:id";

    $query = $this->prepare($preparedSql);

    $query->bindParam(":id", $this->id);
    $query->bindParam(":parroquia_id", $this->parroquia_id);
    $query->bindParam(":nombre", $this->nombre);

    return $query->execute();
  }


  function remove(): bool
  {
    $query = $this->prepare("DELETE FROM sector_consejo_comunal WHERE id=:id");
    $query->bindParam(":id", $this->id);
    $query->execute();
    return $query->rowCount() > 0 ? true : false;
  }

  function insertTransaction(): String
    {
        try {

            parent::beginTransaction();
            // almacenar 
            $id = $this->save();

            parent::commit();
            return $id;
        } catch (Exception $e) {
            parent::rollBack();
            return null;
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

  public function Selectcod()
    {

        $codigo = $this->query(
            'SELECT
                parroquias.id AS id,
                parroquias.nombre AS nombre
            FROM
                
                `parroquias`;'
        );
        return $codigo;
    }

    function deleteTransaction(string $id): bool
    {
        try {
            parent::beginTransaction();
            // actualizar tabla materia
            $delete = $this->delete('sector_consejo_comunal', [['id', '=',  $id ]]);
            parent::commit();
            return true;
        } catch (Exception $e) {
            parent::rollBack();
            return false;
        }
    }


    public function eliminar()
    {

        try {

            $this->delete('sector', [['id', '=',  $this->fillable['id']]]);

            return $this;
        } catch (Exception $th) {
            return $th;
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
        'db'        => 'parroquia_id',
        'dt'        => 1
      ),
      array(
        'db'        => 'nombre',
        'dt'        => 2
      )
    );
    return $this->getSSP('sector_consejo_comunal', 'id', $columns);
  }
}

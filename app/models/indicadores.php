<?php

namespace Model;

use Model\model;
use Utils\Sanitizer;
use Exception;

class indicadores extends model
{

  public $fillable = [
    'dimension_id',
    'nombre',
    'ponderacion'
  ];

  private $id;
  private $dimension_id;
  private $nombre;
  private $ponderacion;


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

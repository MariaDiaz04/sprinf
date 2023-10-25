<?php

namespace Model;

use Model\model;

use Exception;
use Utils\Sanitizer;

class consejoComunal extends model
{

  public $fillable = [
    'nomre',
    'nombre_vocero',
    'sector_id',
  ];
  private $id;
  private $nomre;
  private $nombre_vocero;
  private $sector_id;

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

<?php

namespace App;

use App\model;

use Exception;
use Utils\Sanitizer;

class clases extends model
{

  public $fillable = [
    'codigo',
    'profesor_id',
    'seccion_id',
    'unidad_curricular_id',
  ];
  private $codigo;
  private $profesor_id;
  private $seccion_id;
  private $unidad_curricular_id;

  public function all()
  {
    try {
      $clases = $this->select('clases');
      return $clases ? $clases : null;
    } catch (Exception $th) {
      return $th;
    }
  }

  /**
   * Obtener clase por código de clase
   *
   * @param string $codigo
   * @return array
   */
  function find(string $codigo): array
  {
    $clase = $this->selectOne('detalles_clases', [['codigo', '=', '"' . $codigo . '"']]);
    return $clase ? $clase : [];
  }

  function crearCodigoClase(): void
  {
    $codigo = "c-" . $this->seccion_id . $this->unidad_curricular_id;
    $this->codigo = $codigo;
  }

  /**
   * Obtiene las clases de cualquier fase y seccion
   * perteneciente a una materia
   *
   * @param string $codigoMateria
   * @return array
   */
  function getAllBySubject(string $codigoMateria): array
  {
    $clases = $this->select('detalles_clases', [['materia_id', '=', '"' . $codigoMateria . '"']]);
    return $clases ? $clases : [];
  }

  /**
   * Obtiene las clases de cualquier fase y seccion
   * perteneciente a una materia de una seccion
   *
   * @param string $codigoMateria
   * @param string $codigoSeccion
   * @return array
   */
  function getBySubjectAndSection(string $codigoMateria, string $codigoSeccion): array
  {
    $clases = $this->select('detalles_clases', [['unidad_curricular_id', '=', '"' . $codigoMateria . '"'], ['seccion_id', '=', '"' . $codigoSeccion . '"']]);
    return $clases ? $clases : [];
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
  public function save($codigo = null): string
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
    if ($codigo) {
      $this->update('clase', $data, [['codigo', '=', $codigo]]);
      return $codigo;
    } else {
      $this->set('clase', $data);
      return $this->codigo;
    }
  }

  function grade($codigoInscripcion, float $calificacion): void
  {
    $this->update('inscripcion', ['calificacion' => $calificacion], [['id', '=', "'" . $codigoInscripcion . "'"]]);
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

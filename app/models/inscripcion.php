<?php

namespace Model;

use Model\model;

use Exception;
use Utils\Sanitizer;

class inscripcion extends model
{

  public $fillable = [
    'profesor_id',
    'seccion_id',
    'estudiante_id',
    'unidad_curricular_id',
    'calificacion',
    'estatus',
  ];
  public $id;
  private $profesor_id;
  private $seccion_id;
  private $unidad_curricular_id;
  private $estudiante_id;
  public $calificacion;
  public $estatus;

  public array $error;

  public function all()
  {
    try {
      $periodos = $this->select('detalles_inscripciones');
      return $periodos ? $periodos : null;
    } catch (Exception $th) {
      return $th;
    }
  }

  /**
   * Obtener lista de estudiantes
   * inscritos a una materia
   *
   * @param string $codigo
   * @return array
   */
  function findBySeccion(string $seccion_id): array
  {
    $inscripcion = $this->select('inscripcion', [['seccion_id', '=', '"' . $seccion_id . '"']]);
    return !$inscripcion ? [] : $inscripcion;
  }

  /**
   * Obtener los detalles de una inscripcion
   * por su código de estudiante
   *
   * @param int $codigo
   * @return array - es un array vacio en caso de que no consiga alguna coincidencia
   */
  public function find(int $codigo)
  {
    $inscripcion = $this->selectOne('detalles_inscripciones', [['id_inscripcion', '=',  $codigo]]);
    return !$inscripcion ? [] : $inscripcion;
  }

  /**
   * Obtener los detalles de una inscripcion
   * por su código de estudiante
   *
   * @param int $codigo
   * @return array - es un array vacio en caso de que no consiga alguna coincidencia
   */
  public function findByMateria(string $estudiante_id, string $codigo)
  {
    $inscripcion = $this->select('inscripcion', [['unidad_curricular_id', '=',  '"' . $codigo . '"'], ['estudiante_id', '=',  '"' . $estudiante_id . '"']]);
    return !$inscripcion ? [] : $inscripcion;
  }

  function findByStudent(string $codigoEstudiante): array
  {
    $inscripcion = $this->select('detalles_inscripciones', [['estudiante_id', '=', '"' . $codigoEstudiante . '"']]);
    return !$inscripcion ? [] : $inscripcion;
  }

  function findPendingEnrollment($codigo_materia): array
  {
    $query = $this->prepare("SELECT `id`,nombre, apellido,`cedula` FROM `detalles_estudiantes` WHERE `id` NOT IN (SELECT `estudiante_id` FROM `detalles_inscripciones` WHERE codigo_materia = :codigo_materia)");
    $query->bindParam(":codigo_materia", $codigo_materia);
    $query->execute();
    $result = $query->fetchAll(\PDO::FETCH_ASSOC);
    return ($result) ? $result : [];
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
    $query = $this->prepare("INSERT INTO inscripcion(profesor_id, seccion_id, unidad_curricular_id, estudiante_id, estatus) VALUES (:profesor_id, :seccion_id, :unidad_curricular_id, :estudiante_id, 1)");
    $query->bindParam(":profesor_id", $this->profesor_id);
    $query->bindParam(":seccion_id", $this->seccion_id);
    $query->bindParam(":unidad_curricular_id", $this->unidad_curricular_id);
    $query->bindParam(":estudiante_id", $this->estudiante_id);
    $query->execute();
    $this->id = $this->lastInsertId();
    return true;
  }

  function remove(int $id): bool
  {
    $query = $this->prepare("DELETE FROM inscripcion WHERE id=:id");
    $query->bindParam(":id", $id);
    $query->execute();
    return $query->rowCount() > 0 ? true : false;
  }

  function evaluar(int $idInscripcion, float $calificacion): bool
  {
    $preparedSql = "UPDATE inscripcion SET calificacion=:calificacion WHERE id=:id";

    $query = $this->prepare($preparedSql);

    $query->bindParam(":id", $idInscripcion);
    $query->bindParam(":calificacion", $calificacion);

    return $query->execute();
  }

  /**
   * Verifica si un usuario está inscrito a una materia
   *
   * @param string $idEstudiante
   * @param string $idUnidadCurricular
   * @return array es vacio si no consigue la inscripcion
   */
  function usuarioCursaMateria(string $idEstudiante, string $idUnidadCurricular): array
  {
    $inscripcion = $this->selectOne('inscripcion', [['estudiante_id', '=', "'" . $idEstudiante . "'"], ['unidad_curricular_id', '=', "'" . $idUnidadCurricular . "'"]]);
    return !$inscripcion ? [] : $inscripcion;
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
        'db'        => 'id_inscripcion',
        'dt'        => 0
      ),
      array(
        'db'        => 'seccion_id',
        'dt'        => 1,
      ),
      array(
        'db'        => 'estudiante_id',
        'dt'        => 2,
      ),
      array(
        'db'        => 'cedula',
        'dt'        => 3,
      ),
      array(
        'db'        => 'nombre_estudiante',
        'dt'        => 4,
      ),
      array(
        'db'        => 'codigo_materia',
        'dt'        => 5,
      ),
      array(
        'db'        => 'nombre_materia',
        'dt'        => 6,
      ),
      array(
        'db'        => 'calificacion',
        'dt'        => 7,
      )
    );
    return $this->getComplexSSP('detalles_inscripciones', 'id_inscripcion', $columns, ['condition' => "codigo_materia = '$idMateria'"]);
  }
}

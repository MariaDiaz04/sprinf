<?php

namespace Model;

use Model\model;
use Utils\Sanitizer;
use Exception;
use PDOException;

class dimension extends model
{

  public $fillable = [
    'id',
    'unidad_id',
    'nombre',
    'grupal',

    'indicadores', // has many
  ];

  public $id;
  private $unidad_id;
  private $nombre;
  private $grupal;

  private $indicadores; // has many

  public array $error; // has many

  public function all()
  {
    try {
      $materias = $this->querys('SELECT dimension.id, trayecto.nombre as baremos, dimension.porcentaje, dimension.esTutor FROM dimension INNER JOIN baremos ON baremos.id = dimension.baremos_id INNER JOIN trayecto ON trayecto.id = baremos.trayecto_id');
      return $materias ? $materias : null;
    } catch (Exception $th) {
      return $th;
    }
  }

  function find($id): array
  {
    $query = $this->prepare("SELECT * FROM detalles_dimension WHERE id = :id");
    $query->bindParam(":id", $id);
    $query->execute();
    $result = $query->fetch(\PDO::FETCH_ASSOC);
    return ($result) ? $result : [];
  }

  /**
   * Obtener las dimensiones por fase
   *
   * @param string $codFase
   * @return array es vacio si no consigue ninguna
   */
  function findByFase(string $codFase): array
  {
    $query = $this->prepare("SELECT * FROM detalles_dimension WHERE codigo_fase = :codigo_fase");
    $query->bindParam(":codigo_fase", $codFase);
    $query->execute();
    $result = $query->fetch(\PDO::FETCH_ASSOC);
    return ($result) ? $result : [];
  }

  /**
   * Obtener las dimensiones por materia
   *
   * @param string $codMateria
   * @return array
   */
  function findBySubject(string $codMateria): array
  {
    $query = $this->prepare("SELECT * FROM detalles_dimension WHERE unidad_id = :unidad_id");
    $query->bindParam(":unidad_id", $codMateria);
    $query->execute();
    $result = $query->fetchAll(\PDO::FETCH_ASSOC);
    return ($result) ? $result : [];
  }

  /**
   * Obtiene los indicadores pertenecientes a una dimension
   *
   * @param integer $dimensionId
   * @return array es vacio si no consigue ningun indicador
   */
  function obtenerIndicadores(int $dimensionId): array
  {
    $query = $this->prepare("SELECT * FROM indicadores WHERE dimension_id = :dimension_id");
    $query->bindParam(":dimension_id", $dimensionId);
    $query->execute();
    $result = $query->fetchAll(\PDO::FETCH_ASSOC);
    return ($result) ? $result : [];
  }

  /**
   * Transaccion para inserción de dimensiones
   *
   * @return bool - exito de ejecución
   */
  function insertTransaction(): bool
  {
    try {
      parent::beginTransaction();
      // almacenar materia

      $this->save();
      $this->guardarIndicadores();

      parent::commit();
      return true;
    } catch (PDOException $e) {
      $this->error = [
        'code' => $e->getCode(),
        'message' => $e->getMessage(),
        'stackTrace' => $e->getTraceAsString()
      ];
      parent::rollBack();
      return false;
    }
  }

  function guardarIndicadores(): bool
  {
    foreach ($this->indicadores as $indicador) {
      $resultado = $this->guardarIndicador($this->id, $indicador['nombre'], $indicador['ponderacion']);
      if (!$resultado) return false;
    }
    return true;
  }



  public function actualizar()
  {
    $preparedSql = "UPDATE dimension SET unidad_id=:unidad_id, nombre=:nombre, grupal=:grupal WHERE id=:id";

    $query = $this->prepare($preparedSql);

    $query->bindParam(":id", $this->id);
    $query->bindParam(":unidad_id", $this->unidad_id);
    $query->bindParam(":nombre", $this->nombre);
    $query->bindParam(":grupal", $this->grupal);

    return $query->execute();
  }

  public function actualizarIndicadores(): bool|PDOException
  {
    try {
      parent::beginTransaction();
      $listaIndicadores = array_combine(array_column($this->indicadores, 'id'), $this->indicadores);

      foreach ($listaIndicadores as $indicador) {
        $result = $this->actualizarIndicador($indicador['id'], $indicador['nombre'], $indicador['ponderacion']);

        if (!$result) throw new Exception('Indicador no actualizado');
      }

      parent::commit();
      return true;
    } catch (Exception $Exception) {
      parent::rollBack();
      $this->error = [
        'code' => $Exception->getCode(),
        'message' => $Exception->getMessage(),
        'stackTrace' => $Exception->getTraceAsString()
      ];
      return false;
    }
  }

  function actualizarIndicador(int $id, string $nombre, float $ponderacion): bool
  {
    $query = $this->prepare("UPDATE indicadores SET  nombre=:nombre, ponderacion=:ponderacion WHERE id=:id AND dimension_id = :dimension_id");
    $query->bindParam(":dimension_id", $this->id);
    $query->bindParam(":id", $id);
    $query->bindParam(":nombre", $nombre);
    $query->bindParam(":ponderacion", $ponderacion);
    return $query->execute();
  }

  function guardarIndicador(int $dimensionId, string $nombre, float $ponderacion): bool
  {
    $query = $this->prepare("INSERT INTO indicadores (dimension_id, nombre, ponderacion) VALUES (:dimension_id, :nombre, :ponderacion)");
    $query->bindParam(":dimension_id", $dimensionId);
    $query->bindParam(":nombre", $nombre);
    $query->bindParam(":ponderacion", $ponderacion);
    return $query->execute();
  }

  function removerInidicador(int $id): bool
  {
    $query = $this->prepare("DELETE FROM indicadores WHERE id=:id AND dimension_id = :dimension_id");
    $query->bindParam(":id", $id);
    $query->bindParam(":dimension_id", $this->id);

    return $query->execute();
  }


  function obtenerInidicadores(): array
  {
    $query = $this->prepare("SELECT * FROM indicadores WHERE dimension_id = :dimension_id");
    $query->bindParam(":dimension_id", $this->id);
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
    $query = $this->prepare("INSERT INTO dimension(unidad_id, nombre, grupal) VALUES (:unidad_id, :nombre, :grupal)");
    $query->bindParam(":unidad_id", $this->unidad_id);
    $query->bindParam(":nombre", $this->nombre);
    $query->bindParam(":grupal", $this->grupal);
    $query->execute();
    $this->id = $this->lastInsertId();
    return true;
  }

  function remover($id): bool
  {
    try {
      parent::beginTransaction();
      $indicadores = $this->obtenerInidicadores();

      foreach ($indicadores as $indicador) {
        $this->removerInidicador($indicador['id']);
      }
      $resultado = $this->removerDimension();
      if (!$resultado) return false;
      parent::commit();
      return true;
    } catch (Exception $e) {
      parent::rollBack();
      echo $e->getMessage();
      exit();
      $this->error = [
        'code' => $e->getCode(),
        'message' => $e->getMessage(),
        'stackTrace' => $e->getTraceAsString()
      ];
      return false;
    }
  }

  function removerDimension(): bool
  {
    $query = $this->prepare("DELETE FROM dimension WHERE id=:id");
    $query->bindParam(":id", $this->id);
    $query->execute();
    return $query->rowCount() > 0 ? true : false;
  }


  /**
   * Retorna un array de las materias que se están cursando por baremos
   *
   * @param string En este  parametro se define la fase del baremos
   * @return array
   */
  function materiasDeBaremos(string $codFase): array
  {
    $materias = $this->select('detalles_malla', [['codigo_fase', '=', '"' . $codFase . '"'], ['dimensiones', '>', 0]]);

    return $materias;
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
        'db'        => 'nombre_materia',
        'dt'        => 2
      ),
      array(
        'db'        => 'nombre_fase',
        'dt'        => 3
      ),
      array(
        'db'        => 'nombre_trayecto',
        'dt'        => 4
      ),
      array(
        'db'        => 'grupal',
        'dt'        => 5
      )
    );
    return $this->getSSP('detalles_dimension', 'id', $columns);
  }

  /**
   * generarComplexSSP
   * 
   * Generar SSP proveniente de la función de data table
   *
   * @return array
   */
  public function generarComplexSSP(string $idTrayecto): array
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
        'db'        => 'nombre_materia',
        'dt'        => 2
      ),
      array(
        'db'        => 'nombre_fase',
        'dt'        => 3
      ),
      array(
        'db'        => 'nombre_trayecto',
        'dt'        => 4
      ),
      array(
        'db'        => 'grupal',
        'dt'        => 5
      ),
      array(
        'db'        => 'codigo_trayecto',
        'dt'        => 6
      )
    );
    return $this->getComplexSSP('detalles_dimension', 'id', $columns, ['condition' => "codigo_trayecto = '$idTrayecto'"]);
  }
}

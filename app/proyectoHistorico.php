<?php

namespace App;

use App\model;
use Utils\Sanitizer;

use Exception;

class proyectoHistorico extends model
{

  public $fillable = [
    'nombre_estudiante',
    'cedula_estudiante',
    'nombre_proyecto',
    'comunidad',
    'motor_productivo',
    'direccion',
    'area',
    'municipio',
    'parroquia',
    'nota_fase_1',
    'nota_fase_2',
    'periodo_inicio',
    'periodo_final',
    'integrantes',
  ];
  private int $id;
  public string $nombre_estudiante;
  public int $cedula_estudiante;
  public string $nombre_proyecto;
  public string $cedula;
  public string $nombre;
  public string $resumen;
  public string $comunidad;
  public string $motor_productivo;
  public string $direccion;
  public string $area;
  public string $municipio;
  public string $parroquia;
  public float $nota_fase_1;
  public float $nota_fase_2;
  public string $periodo_inicio;
  public string $periodo_final;

  public array $integrantes; // has many

  public function all()
  {
    try {
      $proyectos = $this->select("detalles_proyecto");
      return $proyectos ? $proyectos : null;
    } catch (Exception $th) {
      return $th;
    }
  }

  function historicalTransaction(): string
  {
    try {
      parent::beginTransaction();
      $proyectos = $this->all();


      foreach ($proyectos as $proyecto) {
        $this->nombre_proyecto = $proyecto['nombre'];
        $this->comunidad = $proyecto['comunidad'];
        $this->area = $proyecto['area'];
        $this->motor_productivo = $proyecto['motor_productivo'];
        $this->resumen = $proyecto['resumen'];
        $this->direccion = $proyecto['direccion'];
        $this->municipio = $proyecto['municipio'];
        $this->parroquia = $proyecto['parroquia'];
        $this->periodo_inicio = $proyecto['fecha_inicio'];
        $this->periodo_final = $proyecto['fecha_cierre'];

        // obtener integrantes
        $integrantes =  $this->obtenerIntegrantes($proyecto['id']);

        foreach ($integrantes as $integrante) {

          $this->cedula_estudiante = $integrante['cedula'];
          $this->nombre_estudiante = $integrante['nombre'];

          $calificacionFases = $this->findStudentGrades($integrante['cedula']);

          foreach ($calificacionFases as $calificacionFase) {
            if (str_contains($calificacionFase['fase_id'], '_1')) {
              $this->nota_fase_1 = $calificacionFase['calificacion'];
            } else {
              $this->nota_fase_2 = $calificacionFase['calificacion'];
            }
          }
          $this->save();
        }
      }

      // remove data from inscripcion
      $this->delete('inscripcion');
      // remove data from clase
      $this->delete('clase');
      // remove data from notas_integrante_proyecto
      $this->delete('notas_integrante_proyecto');
      // remove data from integrante_proyecto
      $this->delete('integrante_proyecto');
      // remove data from proyecto
      $this->delete('proyecto');

      parent::commit();
      return '';
    } catch (Exception $e) {
      print($e->getMessage());
      parent::rollBack();
      return '';
    }
  }

  /**
   * Obtiene los integrantes de un proyecto
   *
   * @param [int] $id - ID de proyecto
   * @return array retorna vacio si no tiene integrantes
   */
  function obtenerIntegrantes(int $id): array
  {
    $integrantes = $this->select('detalles_integrantes', [['proyecto_id', '=', $id]]);
    return !$integrantes ? [] : $integrantes;
  }

  public function save()
  {
    $data = [];

    foreach ($this->fillable as $key => $value) {
      if (isset($this->{$value})) {
        if (is_string($this->{$value})) {
          $data[$value] = '"' . $this->{$value} . '"';
        } else {
          $data[$value] =  $this->{$value};
        }
      }
    }

    $this->set('proyecto_historico', $data);
    $this->id = $this->lastInsertId();
    return $this->id;
  }

  function findStudentGrades(int $cedula): array
  {
    $notas = $this->select('detalles_notas_baremos', [['cedula', '=', $cedula]]);
    return !$notas ? [] : $notas;
  }
}

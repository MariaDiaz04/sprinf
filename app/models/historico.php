<?php

namespace Model;

use Model\model;
use Utils\sanitizer;
use Exception;

class historico extends model
{

  public $fillable = [
    'id',
    'id_proyecto',
    'consejo_comunal_id',
    'codigo_trayecto',
    'codigo_siguiente_trayecto',
    'nombre_estudiante',
    'cedula_estudiante',
    'nombre_proyecto',
    'nombre_trayecto',
    'resumen',
    'direccion',
    'comunidad',
    'motor_productivo',
    'nombre_consejo_comunal',
    'nombre_vocero_consejo_comunal',
    'telefono_consejo_comunal',
    'sector_consejo_comunal',
    'municipio',
    'parroquia_id',
    'parroquia',
    'observaciones',
    'tutor_in',
    'tutor_ex',
    'tlf_tex',
    'nota_fase_1',
    'nota_fase_2',
    'estatus',
    'periodo_inicio',
    'periodo_final',
  ];

  public int $id;
  public int $id_proyecto;
  public int $consejo_comunal_id;
  public string $codigo_trayecto;
  public string $codigo_siguiente_trayecto;
  public string $nombre_estudiante;
  public int $cedula_estudiante;
  public string $nombre_proyecto;
  public string $nombre_trayecto;
  public string $resumen;
  public string $direccion;
  public string $comunidad;
  public string $motor_productivo;
  public string $nombre_consejo_comunal;
  public string $nombre_vocero_consejo_comunal;
  public $telefono_consejo_comunal;
  public string $sector_consejo_comunal;
  public string $municipio;
  public $parroquia_id;
  public string $parroquia;
  public string $observaciones;
  public string $tutor_in;
  public string $tutor_ex;
  public $tlf_tex;
  public float $nota_fase_1;
  public float $nota_fase_2;
  public int $estatus;
  public $periodo_inicio;
  public $periodo_final;

  public array $error;




  /**
   * generarComplexSSP
   * 
   * Generar SSP proveniente de la función de data table
   *
   * @return array
   */
  public function generarComplexSSP(int $cedula = null, int $id_proyecto = null): array
  {
    $columns = array(
      array(
        'db'        => 'id',
        'dt'        => 0
      ),
      array(
        'db'        => 'id_proyecto',
        'dt'        => 1
      ),
      array(
        'db'        => 'consejo_comunal_id',
        'dt'        => 2
      ),
      array(
        'db'        => 'nombre_estudiante',
        'dt'        => 3
      ),
      array(
        'db'        => 'cedula_estudiante',
        'dt'        => 4
      ),
      array(
        'db'        => 'nombre_trayecto',
        'dt'        => 5
      ),
      array(
        'db'        => 'nombre_proyecto',
        'dt'        => 6
      ),
      array(
        'db'        => 'comunidad',
        'dt'        => 7
      ),
      array(
        'db'        => 'nombre_consejo_comunal',
        'dt'        => 8
      ),
      array(
        'db'        => 'nombre_tutor_in',
        'dt'        => 9
      ),
      array(
        'db'        => 'telefono_tutor_in',
        'dt'        => 10
      ),
      array(
        'db'        => 'municipio',
        'dt'        => 11
      ),
      array(
        'db'        => 'parroquia',
        'dt'        => 12
      ),
      array(
        'db'        => 'calificacion',
        'dt'        => 13
      ),
      array(
        'db'        => 'estatus',
        'dt'        => 14
      ),

    );

    $sqlCondition = '';
    if (isset($cedula)) {
      $sqlCondition = "cedula_estudiante = '$cedula'";
    } else if (isset($id_proyecto)) {

      $sqlCondition = "id_proyecto = $id_proyecto";
    }
    if (empty($sqlCondition)) {
      return $this->getSSP('detalles_historico_proyecto', 'id', $columns);
    } else {

      return $this->getComplexSSP('detalles_historico_proyecto', 'id', $columns, ['condition' => $sqlCondition]);
    }
  }
}

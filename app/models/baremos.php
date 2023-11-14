<?php

namespace Model;

use Model\model;


use Exception;

class baremos extends model
{

  public $fillable = [
    'trayecto_id',
    'estatus'
  ];

  private int $id;
  public int $trayecto_id;
  public string $estatus;

  function findStudentGrades(int $idParticipante): array
  {
    $notas = $this->select('notas_integrante_proyecto', [['integrante_id', '=', $idParticipante]]);
    return !$notas ? [] : $notas;
  }

  function findStudentItem(int $idInidicador, int $idParticipante): array
  {
    $materias = $this->selectOne('notas_integrante_proyecto', [['indicador_id', '=', $idInidicador], ['integrante_id', '=', $idParticipante]]);
    return !$materias ? [] : $materias;
  }

  function findByFase(string $codigoFase): array
  {

    $materias = $this->select('detalles_baremos', [['codigo_fase', '=', "'" . $codigoFase . "'"]]);
    return !$materias ? [] : $materias;
  }

  /**
   * Se encarga de crear o actualizar registro de nota de 
   * integrante de proyecto
   *
   * @param integer $idInidicador
   * @param integer $idParticipante
   * @param float $calificacion
   * @return void
   */
  function evaluarIndicador(int $idInidicador, int $idParticipante, float $calificacion): void
  {
    $itemEstudiante = $this->findStudentItem($idInidicador, $idParticipante);

    if (empty($itemEstudiante)) {
      $this->set('notas_integrante_proyecto', [
        'indicador_id' => $idInidicador,
        'integrante_id' => $idParticipante,
        'calificacion' => $calificacion,
      ]);
    } else {
      $this->update('notas_integrante_proyecto', ['calificacion' => $calificacion], [['id', '=', $itemEstudiante['id']]]);
    }
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
        'db'        => 'nombre',
        'dt'        => 0
      ),
      array(
        'db'        => 'nombre_fase',
        'dt'        => 1
      ),
      array(
        'db'        => 'ponderado_baremos',
        'dt'        => 2
      ),
      array(
        'db'        => 'codigo',
        'dt'        => 3
      ),

    );
    return $this->getComplexSSP('detalles_malla', 'codigo', $columns, ['condition' => "codigo_trayecto = '$idTrayecto'"]);
  }
}

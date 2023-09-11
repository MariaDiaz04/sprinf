<?php

namespace App;

use App\model;


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

  function findStudentItem(int $idInidicador, int $idParticipante): array
  {
    $materias = $this->selectOne('notas_integrante_proyecto', [['indicador_id', '=', $idInidicador], ['integrante_id', '=', $idParticipante]]);
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
}

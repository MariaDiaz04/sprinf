<?php

namespace App;

use App\model;

use Exception;

class periodo extends model
{

  public $fillable = [
    'fecha_inicio',
    'fecha_cierre',
  ];

  public function all()
  {
    try {
      $periodos = $this->select('periodo');
      return $periodos ? $periodos : null;
    } catch (Exception $th) {
      return $th;
    }
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
        'db'        => 'fecha_inicial',
        'dt'        => 1,
        'formatter' => function ($d, $row) {
          return date('jS M y', strtotime($d));
        }
      ),
      array(
        'db'        => 'fecha_final',
        'dt'        => 2,
        'formatter' => function ($d, $row) {
          return date('jS M y', strtotime($d));
        }
      )
    );
    return $this->getSSP('periodos', 'id', $columns);
  }
}

<?php

namespace Utils;

use InvalidArgumentException;

class DateValidator
{

  /**
   * checkPeriodDates
   * 
   * Verifica si las fechas fueron definidas y 
   * si la fecha final efectivamente es mayor a la incial
   *
   * @param string $fecha_inicio
   * @param string $fecha_cierre
   * @return boolean
   */
  public static function checkPeriodDates(string $fecha_inicio, string $fecha_cierre): bool
  {
    if (empty($fecha_cierre)) throw new InvalidArgumentException('Fecha inicial no fue definida');
    if (empty($fecha_cierre)) throw new InvalidArgumentException('Fecha final no fue definida');

    if ($fecha_inicio > $fecha_cierre) throw new InvalidArgumentException('Fecha inicial no puede ser mayor que fecha final');

    return true;
  }
}

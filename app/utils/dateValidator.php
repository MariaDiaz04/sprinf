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
   * @param string $fecha_inicial
   * @param string $fecha_final
   * @return boolean
   */
  public static function checkPeriodDates(string $fecha_inicial, string $fecha_final): bool
  {
    if (empty($fecha_final)) throw new InvalidArgumentException('Fecha inicial no fue definida');
    if (empty($fecha_final)) throw new InvalidArgumentException('Fecha final no fue definida');

    if ($fecha_inicial > $fecha_final) throw new InvalidArgumentException('Fecha inicial no puede ser mayor que fecha final');

    return true;
  }
}

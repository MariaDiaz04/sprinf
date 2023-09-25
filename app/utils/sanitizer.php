<?php

namespace Utils;

class Sanitizer
{
  public static function sanitize($input)
  {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
  }
}

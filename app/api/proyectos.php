<?php

namespace API;

use Model\usuario;
use Model\proyecto;
use Controllers\controller;
use Exception;
use Traits\Excel;
use Traits\Utility;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;

class proyectos extends controller
{

  use Excel;
  use Utility;

  public $usuarios;
  public $proyecto;
  function __construct()
  {
    $this->usuarios = new usuario();
    $this->proyecto = new proyecto();
  }

  /**
 * funcion para obtener datos de proyectos.
 *
 * @param string $nombre
 * @param string $trayecto 
 * @return int $tutor 
 */
  function obtener():void
  {

    try {
      if ($user = $this->obtenerTokenJWT()) {
        $infoUsuario = $this->usuarios->find($user->data->id);
        if ($infoUsuario['rol_id'] == 1) {

            $proyectos = $this->proyecto->all();

          if (!$proyectos) throw new Exception('No hay proyectos que mostrar', 400);
          http_response_code(200);
          echo json_encode($proyectos);
        } else {
          throw new Exception('Permisos insuficientes', 401);
        }
      } else {
        die();
      }
    } catch (\Exception $th) {
      http_response_code($th->getCode() ?? 500);
      echo json_encode($th->getMessage());
    }
  }
}

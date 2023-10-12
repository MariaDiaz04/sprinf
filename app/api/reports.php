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

class reports extends controller
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

  function download(Request $data): void
  {
    try {
      if ($user = $this->obtenerTokenJWT()) {

        $infoUsuario = $this->usuarios->find($user->data->id);
        if ($infoUsuario['rol_id'] == 1) {
          $requestData = $data->toArray();


          $trayectoId = $requestData['trayecto_id'];
          $integrantes = $this->proyecto->IntegrastesPorTrayecto($trayectoId);

          if (!$integrantes) throw new Exception('No hay integrantes en el trayecto seleccionado', 400);

          $this->reporteProyectos($integrantes);
          http_response_code(200);
          echo json_encode(true);
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

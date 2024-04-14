<?php

namespace API;

use Model\usuario;
use Model\proyecto;
use Model\estudiante;
use Model\inscripcion;
use Controllers\controller;
use Exception;
use Traits\Excel;
use Traits\utility;

use Firebase\JWT\JWT;

use Symfony\Component\HttpFoundation\Request;

class estudiantes extends controller
{

  use Excel;
  use Utility;

  public $usuarios;
  public $proyecto;
  public $estudiante;
  public $inscripcion;
  function __construct()
  {
    $this->usuarios = new usuario();
    $this->proyecto = new proyecto();
    $this->estudiante = new estudiante();
    $this->inscripcion = new inscripcion();
  }

  function obtener(Request $peticion): void
  {

    try {
      if ($user = $this->obtenerTokenJWT()) {
        $infoUsuario = $this->usuarios->find($user->data->id);


        $data = $peticion->toArray();
        $data = $data['data'];

        $infoEstudiante = $this->estudiante->find($data['codigo']);

        if ($infoEstudiante['proyecto_id'] != null) {
          $infoProyecto = $this->proyecto->find($infoEstudiante['proyecto_id']);

          $infoEstudiante['proyecto'] = $infoProyecto;
        }

        $inscripciones = $this->inscripcion->findByStudent($data['codigo']);

        $infoEstudiante['inscripciones'] = $inscripciones;


        http_response_code(200);
        echo json_encode($infoEstudiante);
      } else {
        die();
      }
    } catch (\Exception $th) {
      http_response_code($th->getCode() ?? 500);
      echo json_encode($th->getMessage());
    }
  }

  function listar(): void
  {
    try {
      if ($user = $this->obtenerTokenJWT()) {
        $infoEstudiantes = $this->estudiante->all();
        echo json_encode($infoEstudiantes);
      } else {
        die();
      }
    } catch (\Exception $th) {
      http_response_code($th->getCode() ?? 500);
      echo json_encode($th->getMessage());
    }
  }
}

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

  function download(Request $data, $idTrayecto): void
  {
    try {
      if ($user = $this->obtenerTokenJWT()) {

        $infoUsuario = $this->usuarios->find($user->data->id);
        if ($infoUsuario['rol_id'] == 1) {


          $trayectoId = $idTrayecto;
          $proyectos = $this->proyecto->all();


          foreach ($proyectos as $key => $proyecto) {
            $integrantes = $this->proyecto->obtenerIntegrantes($proyecto['id']);

            $proyectos[$key]['integrantes'] = $integrantes;
            # code...
          }
          $ultimaCelda = 3;
          $excelData = [];
          foreach ($proyectos as $key => $proyecto) {
            $celdaInicial = intval($key + $ultimaCelda);

            $celdaFinal = intval($celdaInicial + count($proyecto['integrantes']));

            foreach ($proyecto['integrantes'] as $key => $integrante) {
              array_push($excelData, [
                'UPTAEB',
                $integrante['nombre'] .  ' ' . $integrante['apellido'],
                $integrante['cedula'],
                'Plan Nacional de Formación en Informática',
                $integrante['telefono'],
                $integrante['email'],
                $proyecto['tutor_in_nombre'],
                $proyecto['tutor_in_telefono'],
                $proyecto['nombre'],
                $proyecto['municipio'],
                $proyecto['comunidad'],
                $proyecto['motor_productivo'],
                $proyecto['resumen'],
                $proyecto['nombre_consejo_comunal'],
                $proyecto['sector_consejo_comunal'],
                $proyecto['nombre_vocero_consejo_comunal'],
                $proyecto['telefono_consejo_comunal'],
                $proyecto['estatus'],
                $proyecto['observaciones'],

              ]);
            }

            // var_dump("CELDAS[A" . $celdaInicial . ":A" . $celdaFinal . "]");
            $ultimaCelda = $celdaFinal;
          }
          if (!$integrantes) throw new Exception('No hay integrantes en el trayecto seleccionado', 400);

          $this->reporteProyectos($excelData);
          http_response_code(200);
          // echo json_encode(true);
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

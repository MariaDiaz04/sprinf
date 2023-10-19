<?php

namespace API;

use Model\usuario;
use Model\fase;
use Model\proyecto;
use Model\dimension;
use Controllers\controller;
use Exception;
use Traits\Excel;
use Traits\Utility;

use Firebase\JWT\JWT;

use Symfony\Component\HttpFoundation\Request;

class baremos extends controller
{

  use Excel;
  use Utility;

  public $usuarios;
  public $proyecto;
  public $fase;
  public $dimension;
  function __construct()
  {
    $this->usuarios = new usuario();
    $this->fase = new fase();
    $this->proyecto = new proyecto();
    $this->dimension = new dimension();
  }

  function obtener(Request $peticion): void
  {

    try {
      if ($user = $this->obtenerTokenJWT()) {
        $data = $peticion->toArray();
        $data = $data['data'];

        $fases = $this->fase->getByTrayecto($data['codigo']);
        $baremos = [];
        foreach ($fases as $fase) {

          $materiasDeDimension = $this->dimension->materiasDeBaremos($fase['codigo_fase']);

          if (empty($materiasDeDimension)) {
            throw new Exception('Baremos no cuenta con dimensiones');
          }

          foreach ($materiasDeDimension as $materia) {
            $dimensiones = $this->dimension->findBySubject($materia['codigo']);

            $fase['baremos'] = [];
            $materia['infoDimensiones'] = [];

            foreach ($dimensiones as $dimension) {

              $indicadores = $this->dimension->obtenerIndicadores($dimension['id']);

              if (empty($indicadores)) {
                $errors['danger'][] = 'Dimension ' . $dimension['nombre_materia'] . ' - ' . $dimension['nombre'] . ' no cuenta con indicadores!';
              } else {
                // configurar informacion de indicador
                $dimension['indicadores'] = $indicadores;
                array_push($materia['infoDimensiones'], $dimension);
              }
            }
            array_push($fase['baremos'], $materia);
          }
          array_push($baremos, $fase);
        }

        echo json_encode($baremos);
      } else {
        die();
      }
    } catch (\Exception $th) {
      http_response_code($th->getCode() ?? 500);
      echo json_encode($th->getMessage());
    }
  }
}

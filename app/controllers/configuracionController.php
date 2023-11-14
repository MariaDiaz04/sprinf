<?php

namespace Controllers;

use Model\permisos;
use Model\periodo;
use Model\proyectoHistorico;
use Model\materias;
use Model\trayectos;
use Model\proyecto;
use Controllers\controller;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class configuracionController extends controller
{
  public $materias;
  public $proyectoHistorico;
  public $permisos;
  public $trayecto;
  public $proyectos;
  public $periodo;

  function __construct()
  {
    $this->proyectoHistorico = new proyectoHistorico();
    $this->materias = new materias();
    $this->periodo = new periodo();
    $this->permisos = new permisos();
    $this->proyectos = new proyecto();
    $this->trayecto = new trayectos();
  }

  function periodo()
  {
    $proyectos = $this->proyectos->all();
    $pendientes = $this->proyectos->pendientesACerrar();
    $periodo = $this->periodo->get();

    $proximoInicioDePeriodo = date('Y-m-d', strtotime('+1 year', strtotime($periodo['fecha_inicio'])));
    $proximoCierreDePeriodo = date('Y-m-d', strtotime('+1 year', strtotime($periodo['fecha_cierre'])));

    return $this->view('configuracion/periodo', [
      'cerrarFase' => empty($pendientes) && !empty($proyectos),
      'periodo' => $periodo,
      'inicio' => $proximoInicioDePeriodo,
      'cierre' => $proximoCierreDePeriodo
    ]);
  }

  function cerrarPeriodo(Request $nuevoPeriodo): void
  {
    try {
      // verificar que no haya proyectos por evaluar
      $pendientes = $this->proyectos->pendientesACerrar();

      if (!empty($pendientes)) throw new Exception('Hay proyectos pendientes por cerrar');

      // iniciar transaccion que envia información al historico
      $resultado = $this->proyectoHistorico->historicalTransaction();

      if (!$resultado) throw new Exception('Ha ocurrido un error al crear proyecto');

      // actualizar periodo de trayecto
      $this->periodo->setData($nuevoPeriodo->request->all());
      $this->periodo->save(1); // update first record

      http_response_code(200);
      echo json_encode(true);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode(['error' => [
        'code' => $e->getCode(),
        'message' => $e->getMessage(),
        'stackTrace' => $e->getTraceAsString(),
        (isset($this->proyectoHistorico->error)) ? ['errorDetails' =>  $this->proyectoHistorico->error] : null
      ]]);
    }
  }
}

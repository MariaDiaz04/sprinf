<?php

namespace App\controllers;

use App\permisos;
use App\proyectoHistorico;
use App\materias;
use App\trayectos;
use App\proyecto;
use App\clases;
use App\fase;
use App\malla;
use App\controllers\controller;
use Exception;

use Symfony\Component\HttpFoundation\Request;

class configuracionController extends controller
{
  public $materias;
  public $proyectoHistorico;
  public $clases;
  public $permisos;
  public $trayecto;
  public $proyectos;
  public $fase;
  public $malla;

  function __construct()
  {
    $this->proyectoHistorico = new proyectoHistorico();
    $this->materias = new materias();
    $this->clases = new clases();
    $this->permisos = new permisos();
    $this->proyectos = new proyecto();
    $this->trayecto = new trayectos();
    $this->fase = new fase();
    $this->malla = new malla();
  }

  function periodo(): void
  {
  }

  function cerrarPeriodo(Request $nuevoPeriodo): void
  {
    try {
      // verificar que no haya proyectos por evaluar
      $pendientes = $this->proyectos->pendientesACerrar();

      if (!empty($pendientes)) throw new Exception('Hay proyectos pendientes por cerrar');

      // iniciar transaccion que envia información al historico
      $this->proyectoHistorico->historicalTransaction();

      // actualizar periodo de trayecto


      http_response_code(200);
      echo json_encode(true);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode(false);
    }
  }
}

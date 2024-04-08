<?php

namespace Controllers;
use Model\reportesn;
use Model\periodo;
use Model\trayectos;
use Model\seccion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

use Exception;


class reportesnController extends controller
{
	public $REPORTESN;
	public $PERIODO;
	public $TRAYECTOS;
	public $SECCION;


	function __construct () {	
	//	$this->tokenExist();
		$this->REPORTESN = new reportesn();
		$this->PERIODO = new periodo();
		$this->TRAYECTOS = new trayectos();
		$this->SECCION = new seccion();
	}

	public function index()
	{

		$reportesn = $this->REPORTESN->reportesn_all();
		$periodo = $this->PERIODO->all();

		$chartData = [
			['mes' => 'Enero', 'ventas' => 1000],
			['mes' => 'Febrero', 'ventas' => 1200],
			['mes' => 'Marzo', 'ventas' => 800],
			['mes' => 'Abril', 'ventas' => 1500],
			['mes' => 'Mayo', 'ventas' => 1300],
			['mes' => 'Junio', 'ventas' => 1700],
			// Agrega más meses si es necesario
		];

		return $this->view('reportesn/reportes_notas_unidad_c', [
			'reportesn' => $reportesn,
			'periodo' => $periodo,
			'chartData' => $chartData
		]);
	}

	public function listar_trayectos(Request $request)
	{
		$periodo_id = $request->get('periodo_id');
		$trayectos = $this->TRAYECTOS->findByPeriodo($periodo_id);
		$total_proyectos = $this->PERIODO->total($periodo_id);
		$aprobados = $this->PERIODO->aprobados($periodo_id);
		$reprobados = $this->PERIODO->reprobados($periodo_id);
		$porcentaje_aprobado = (intval($aprobados['aprobados'])/intval($total_proyectos['total']))*100;
		$porcentaje_reprobados = (intval($reprobados['reprobados'])/intval($total_proyectos['total']))*100;
		echo json_encode([
			'resultado' => 'listar_trayectos',
			'trayectos' => $trayectos,
			'aprobados' => $porcentaje_aprobado,
			'reprobados' => $porcentaje_reprobados
		]);
		return 0;
	}
	
	public function listar_secciones(Request $request)
	{
		$trayecto_id = $request->get('trayecto_id');
		$secciones = $this->SECCION->findByTrayecto($trayecto_id);
		echo json_encode([
			'resultado' => 'listar_secciones',
			'secciones' => $secciones
		]);
		return 0;
	}
	

}

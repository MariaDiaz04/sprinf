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
		//Obtiene el id del periodo
		$periodo_id = $request->get('periodo_id');
		//Valida que existe el periodo buscado
		$buscar_periodo = $this->PERIODO->find($periodo_id);
		if($buscar_periodo == null){
			echo json_encode([
				'resultado' => 'error',
				'mensaje' => 'Periodo no encontrado'
			]);
		}
		else{
			//En caso de encontrar el periodo
			$proyecto_periodo = $this->PERIODO->findbyproyecto($periodo_id);
			if($proyecto_periodo == null){
				echo json_encode([
					'resultado' => 'error',
					'mensaje' => 'No existe proyectos con el periodo indicado'
				]);
			}
			else
			{
				//PARA CARGAR EL SELECT
				// Muestra trayecto de acuerdo al periodo_id
				$trayectos = $this->TRAYECTOS->findByPeriodo($periodo_id);
				//PARA LA GRAFICA
				//Muestra el total de proyectos segun el periodo
				$total_proyectos = $this->PERIODO->total($periodo_id);
				//Muestra los proyectos aprobados de acuerdo con el periodo
				$aprobados = $this->PERIODO->aprobados($periodo_id);
				//Muestra los proyectos reprobados de acuerdo con el periodo
				$reprobados = $this->PERIODO->reprobados($periodo_id);

				//Formula para obtener el porcentaje de aprobados y reprobados
				$porcentaje_aprobado = (intval($aprobados['aprobados'])/intval($total_proyectos['total']))*100;
				$porcentaje_reprobados = (intval($reprobados['reprobados'])/intval($total_proyectos['total']))*100;

				echo json_encode([
					'resultado' => 'listar_trayectos',
					'trayectos' => $trayectos,
					'aprobados' => $porcentaje_aprobado,
					'reprobados' => $porcentaje_reprobados
				]);
			}

		}
		return 0;
		
	}
	
	public function listar_secciones(Request $request)
	{
		$trayecto_id = $request->get('trayecto_id');
		$buscar_trayectos = $this->TRAYECTOS->find($trayecto_id);
		if($buscar_trayectos == null){
			echo json_encode([
				'resultado' => 'error',
				'mensaje' => 'Trayecto no encontrado'
			]);
		}
		else{
			$secciones = $this->SECCION->findByTrayecto($trayecto_id);
			$proyecto_trayecto = $this->TRAYECTOS->findbyproyecto($trayecto_id);
			if($proyecto_trayecto == null){
				echo json_encode([
					'resultado' => 'error',
					'mensaje' => 'No existe proyectos con el trayecto indicado'
				]);
			}
			else{
				$total_proyectos = $this->TRAYECTOS->total($trayecto_id);
				//Muestra los proyectos aprobados de acuerdo con el TRAYECTO
				$aprobados = $this->TRAYECTOS->aprobados($trayecto_id);
				//Muestra los proyectos reprobados de acuerdo con el TRAYECTO
				$reprobados = $this->TRAYECTOS->reprobados($trayecto_id);
				//Formula para obtener el porcentaje de aprobados y reprobados
				$porcentaje_aprobado = (intval($aprobados['aprobados'])/intval($total_proyectos['total']))*100;
				$porcentaje_reprobados = (intval($reprobados['reprobados'])/intval($total_proyectos['total']))*100;
				echo json_encode([
					'resultado' => 'listar_secciones',
					'secciones' => $secciones,
					'aprobados' => $porcentaje_aprobado,
					'reprobados' => $porcentaje_reprobados
				]);

			}
		}
		return 0;
	}

	public function listar_secciones_trayectos(Request $request)
	{

		$seccion_id = $request->get('seccion_id');
		$buscar_seccion = $this->SECCION->find($seccion_id);
		if($buscar_seccion == null){
			echo json_encode([
				'resultado' => 'error',
				'mensaje' => 'Sección no encontrada'
			]);
		}
		else{
			$proyecto_seccion = $this->SECCION->findbyseccion($seccion_id);
			if($proyecto_seccion == null){
				echo json_encode([
					'resultado' => 'error',
					'mensaje' => 'No existe proyectos con la sección indicada'
				]);
			}
			else{
				$total_proyectos = $this->SECCION->total($seccion_id);
				//Muestra los proyectos aprobados de acuerdo con el TRAYECTO
				$aprobados = $this->SECCION->aprobados($seccion_id);
				//Muestra los proyectos reprobados de acuerdo con el TRAYECTO
				$reprobados = $this->SECCION->reprobados($seccion_id);
				//Formula para obtener el porcentaje de aprobados y reprobados
				$porcentaje_aprobado = (intval($aprobados['aprobados'])/intval($total_proyectos['total']))*100;
				$porcentaje_reprobados = (intval($reprobados['reprobados'])/intval($total_proyectos['total']))*100;
				echo json_encode([
					'resultado' => 'listar_secciones_trayecto',
					'aprobados' => $porcentaje_aprobado,
					'reprobados' => $porcentaje_reprobados
				]);

			}
		}
		return 0;	
	}
	

}

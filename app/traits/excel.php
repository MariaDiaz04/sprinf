<?php

namespace Traits;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;


/**
 * Trait General para funciones Helpers
 */
trait Excel
{
  function reporteProyectos(array $integrantes): void
  {
    $spreadsheet = new Spreadsheet();
    $styleArray = [
      'font' => [
        'bold' => true,
      ],
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
        'top' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM
        ],
        'bottom' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM
        ],
        'left' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM
        ],
        'right' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM
        ],
      ],

    ];

    $spreadsheet->getActiveSheet()->setCellValue('H1', 'MATRIZ DE PROYECTOS');
    $spreadsheet->getActiveSheet()->getStyle('H1')->getFont()->setBold(true)->setSize(20);
    $spreadsheet->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal('center');
    $spreadsheet->getActiveSheet()->getStyle('A2:N2')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->setCellValue('A2', 'Sección');
    $spreadsheet->getActiveSheet()->setCellValue('B2', 'Cedula de identidad');
    $spreadsheet->getActiveSheet()->setCellValue('C2', 'Apellidos');
    $spreadsheet->getActiveSheet()->setCellValue('D2', 'Nombres');
    $spreadsheet->getActiveSheet()->setCellValue('E2', 'Telefonos');
    $spreadsheet->getActiveSheet()->setCellValue('F2', 'Correo Electrónico');
    $spreadsheet->getActiveSheet()->setCellValue('G2', 'Lugar');
    $spreadsheet->getActiveSheet()->setCellValue('H2', 'Nombre del Proyecto');
    $spreadsheet->getActiveSheet()->setCellValue('I2', 'Municipio donde se ejecuta el proyecto');
    $spreadsheet->getActiveSheet()->setCellValue('J2', 'Motor Productivo');
    $spreadsheet->getActiveSheet()->setCellValue('K2', 'Breve Descripción (Resumen)');
    $spreadsheet->getActiveSheet()->setCellValue('L2', 'Dirección');
    $spreadsheet->getActiveSheet()->setCellValue('M2', 'Parroquia');
    if (!is_null($integrantes)) {
      $spreadsheet->getActiveSheet()
        ->fromArray(
          $integrantes,  // The data to set
          NULL,        // Array values with this value will not be set
          'A3'         // Top left coordinate of the worksheet range where
          //    we want to set these values (default is A1)
        );
    } else {
      $spreadsheet->getActiveSheet()->setCellValue('H3', 'SIN DATOS');
      $spreadsheet->getActiveSheet()->getStyle('H3')->getFont()->setBold(true)->setSize(16);
      $spreadsheet->getActiveSheet()->getStyle('H3')->getAlignment()->setHorizontal('center');
    }
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="matriz de proyectos.xlsx"');
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
  }
}

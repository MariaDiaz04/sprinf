<?php

namespace Traits;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;


/**
 * Trait General para funciones Helpers
 */
trait Excel
{
  function reporteProyectos(array $proyectos): void
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
    $spreadsheet->getActiveSheet()->getStyle('A2:S3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('N2:Q3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('N2')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('N3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('O3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('P3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('Q3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('A2:A3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('B2:B3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('C2:C3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('D2:D3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('E2:E3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('H2:H3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('I2:I3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('J2:J3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('K2:K3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('L2:L3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('M2:M3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('R2:R3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('S2:S3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->mergeCells('A2:A3');
    $spreadsheet->getActiveSheet()->mergeCells('B2:B3');
    $spreadsheet->getActiveSheet()->mergeCells('C2:C3');
    $spreadsheet->getActiveSheet()->mergeCells('D2:D3');
    $spreadsheet->getActiveSheet()->mergeCells('E2:E3');
    $spreadsheet->getActiveSheet()->mergeCells('F2:F3');
    $spreadsheet->getActiveSheet()->mergeCells('G2:G3');
    $spreadsheet->getActiveSheet()->mergeCells('H2:H3');
    $spreadsheet->getActiveSheet()->mergeCells('I2:I3');
    $spreadsheet->getActiveSheet()->mergeCells('J2:J3');
    $spreadsheet->getActiveSheet()->mergeCells('K2:K3');
    $spreadsheet->getActiveSheet()->mergeCells('L2:L3');
    $spreadsheet->getActiveSheet()->mergeCells('M2:M3');
    $spreadsheet->getActiveSheet()->mergeCells('N2:Q2');
    $spreadsheet->getActiveSheet()->mergeCells('R2:R3');
    $spreadsheet->getActiveSheet()->mergeCells('S2:S3');
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
    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->setCellValue('A2', 'Nombre de IEU');
    $spreadsheet->getActiveSheet()->setCellValue('B2', 'Nombre de los estudiantes');
    $spreadsheet->getActiveSheet()->setCellValue('C2', 'Cedula de Identidad');
    $spreadsheet->getActiveSheet()->setCellValue('D2', 'PNF');
    $spreadsheet->getActiveSheet()->setCellValue('E2', 'Teléfono');
    $spreadsheet->getActiveSheet()->setCellValue('F2', 'Correo Electrónico');
    $spreadsheet->getActiveSheet()->setCellValue('G2', 'Nombre del Tutor(a) Asesor(a)');
    $spreadsheet->getActiveSheet()->setCellValue('H2', 'N° del Teléfono del Tutor(a) Asesor(a)');
    $spreadsheet->getActiveSheet()->setCellValue('I2', 'Nombre del Proyecto');
    $spreadsheet->getActiveSheet()->setCellValue('J2', 'Municipio donde se ejecuta el proyecto');
    $spreadsheet->getActiveSheet()->setCellValue('K2', 'Área');
    $spreadsheet->getActiveSheet()->setCellValue('L2', 'Motor Productivo');
    $spreadsheet->getActiveSheet()->setCellValue('M2', 'Breve Descripción (Resumen)');
    $spreadsheet->getActiveSheet()->setCellValue('N2', 'Vinculación del proyecto con el Consejo Comunal');
    $spreadsheet->getActiveSheet()->setCellValue('N3', 'Nombre del Consejo Comunal');
    $spreadsheet->getActiveSheet()->setCellValue('O3', 'Sector');
    $spreadsheet->getActiveSheet()->setCellValue('P3', 'Nombre de Vocero del Consejo Comunal');
    $spreadsheet->getActiveSheet()->setCellValue('Q3', 'Nº de Telefono');
    $spreadsheet->getActiveSheet()->setCellValue('R2', 'Status del Proyecto');
    $spreadsheet->getActiveSheet()->setCellValue('S2', 'Observaciones');

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
    if (!is_null($excelData)) {
      $spreadsheet->getActiveSheet()
        ->fromArray(
          $excelData,  // The data to set
          NULL,        // Array values with this value will not be set
          'A4'         // Top left coordinate of the worksheet range where
          //    we want to set these values (default is A1)
        );
      $spreadsheet->getActiveSheet()->mergeCells("A4:A" . 3 + count($excelData));
      $spreadsheet->getActiveSheet()->getStyle("A4:A" . 3 + count($excelData))->applyFromArray($styleArray);
      $spreadsheet->getActiveSheet()->getStyle('A4')->getAlignment()->setVertical('center');
      $spreadsheet->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal('center');
      $spreadsheet->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);


      $ultimaCelda = 4;
      foreach ($proyectos as $key => $proyecto) {
        $celdaInicial = intval($key + $ultimaCelda);

        $celdaFinal = intval(($celdaInicial - 1) + count($proyecto['integrantes']));
        // var_dump("CELDAS[A" . $celdaInicial . ":A" . $celdaFinal . "]");
        $ultimaCelda = $celdaFinal;

        $spreadsheet->getActiveSheet()->mergeCells("I" . $celdaInicial . ":I" . $celdaFinal);
        $spreadsheet->getActiveSheet()->getStyle("I" . $celdaInicial)->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle("I" . $celdaInicial)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("I" . $celdaInicial)->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->mergeCells("J" . $celdaInicial . ":J" . $celdaFinal);
        $spreadsheet->getActiveSheet()->getStyle("J" . $celdaInicial)->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle("J" . $celdaInicial)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("J" . $celdaInicial)->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->mergeCells("N" . $celdaInicial . ":N" . $celdaFinal);
        $spreadsheet->getActiveSheet()->getStyle("N" . $celdaInicial)->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle("N" . $celdaInicial)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("N" . $celdaInicial)->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->mergeCells("O" . $celdaInicial . ":O" . $celdaFinal);
        $spreadsheet->getActiveSheet()->getStyle("O" . $celdaInicial)->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle("O" . $celdaInicial)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("O" . $celdaInicial)->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->mergeCells("P" . $celdaInicial . ":P" . $celdaFinal);
        $spreadsheet->getActiveSheet()->getStyle("P" . $celdaInicial)->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle("P" . $celdaInicial)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("P" . $celdaInicial)->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->mergeCells("Q" . $celdaInicial . ":Q" . $celdaFinal);
        $spreadsheet->getActiveSheet()->getStyle("Q" . $celdaInicial)->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle("Q" . $celdaInicial)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("Q" . $celdaInicial)->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->mergeCells("R" . $celdaInicial . ":R" . $celdaFinal);
        $spreadsheet->getActiveSheet()->getStyle("R" . $celdaInicial)->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle("R" . $celdaInicial)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("R" . $celdaInicial)->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->mergeCells("K" . $celdaInicial . ":K" . $celdaFinal);
        $spreadsheet->getActiveSheet()->getStyle("K" . $celdaInicial)->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle("K" . $celdaInicial)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("K" . $celdaInicial)->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->mergeCells("L" . $celdaInicial . ":L" . $celdaFinal);
        $spreadsheet->getActiveSheet()->getStyle("L" . $celdaInicial)->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle("L" . $celdaInicial)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("L" . $celdaInicial)->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->mergeCells("M" . $celdaInicial . ":M" . $celdaFinal);
        $spreadsheet->getActiveSheet()->mergeCells("D" . $celdaInicial . ":D" . $celdaFinal);
        $spreadsheet->getActiveSheet()->getStyle("D" . $celdaInicial)->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle("D" . $celdaInicial)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->mergeCells("G" . $celdaInicial . ":G" . $celdaFinal);
        $spreadsheet->getActiveSheet()->getStyle("G" . $celdaInicial)->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle("G" . $celdaInicial)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->mergeCells("H" . $celdaInicial . ":H" . $celdaFinal);
        $spreadsheet->getActiveSheet()->getStyle("H" . $celdaInicial)->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle("H" . $celdaInicial)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("B" . $celdaInicial . ":S" . $celdaFinal)->applyFromArray($styleArray);
      }
    }
    //     $spreadsheet->getActiveSheet()->setCellValue('H3', 'SIN DATOS');
    //     $spreadsheet->getActiveSheet()->getStyle('H3')->getFont()->setBold(true)->setSize(16);
    //     $spreadsheet->getActiveSheet()->getStyle('H3')->getAlignment()->setHorizontal('center');
    // }
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="matriz de proyectos.xlsx"');
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
  }
}

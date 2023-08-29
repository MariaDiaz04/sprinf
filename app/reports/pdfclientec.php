<?php

namespace App\reports;

require('fpdf/pdf.php');
require('fpdf/fpdf.php');


class PDF extends FPDF
{
    //public $ZONA;
    // Cabecera de página

    function Header()
    {

        // Arial bold 15
        $this->SetFont('Arial', 'B', 14);
        // Movernos a la derecha
        $this->Cell(60);

        $this->Image('../public/assets/img/logo.png', 0, 0, 35, 55, 'png');
        // Logo
        $this->Image('../public/assets/img/mb11.jpg', 165, 6, 30, 30, 'JPG');
        // Título
        $this->Cell(70, 35, 'Listado de Cliente comprador', 0, 0, 'C');
        // Salto de línea

        $this->Ln(40);

        $this->Cell(25, 10, 'Nombre', 0, 0, 'C');
        $this->Cell(25, 10, 'Cedula', 0, 0, 'C');
        $this->Cell(29, 10, 'Direccion', 0, 0, 'C');
        $this->Cell(35, 10, 'Correo', 0, 0, 'C');
        $this->Cell(25, 10, 'Telefono', 0, 0, 'C');
        $this->Cell(28, 10, 'Nacimiento', 0, 0, 'C');
        $this->Cell(25, 10, 'Estatus', 0, 1, 'C');
        $this->SetDrawColor(94, 111, 176);
        $this->SetLineWidth(1);

        $this->Line(5.5, 59.5, 205.5, 59);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Pagina') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}



/*$consulta = "SELECT persona.*, usuario.email,cliente_comprador.* FROM `usuario` INNER JOIN persona on usuario.id=persona.usuario_id and persona.rol_id = 5 INNER JOIN cliente_comprador on cliente_comprador.persona_id=persona.id";
$resultado = $mysqli->query($consulta);
*/

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 9);
$pdf->SetFillColor(230, 230, 230);
foreach ($cliente_comprador as $row) {
    $pdf->Cell(25, 10, $row['nombre'], 0, 0, 'C', true);
    $pdf->Cell(25, 10, $row['cedula'], 0, 0, 'C', true);
    $pdf->Cell(29, 10, $row['direccion'], 0, 0, 'C', true);
    $pdf->Cell(35, 10, $row['email'], 0, 0, 'C', true);
    $pdf->Cell(25, 10, $row['telefono'], 0, 0, 'C', true);
    $pdf->Cell(28, 10, $row['nacimiento'], 0, 0, 'C', true);
    $pdf->Cell(25, 10, $row['estatus'], 0, 1, 'C', true);
}
$pdf->Output();

<?php

require('fpdf19/fpdf.php');
include("db.php");

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);

$pdf->Cell(190,10,'Unique Training Institution',0,1,'C');

$pdf->SetFont('Arial','',12);

$pdf->Cell(190,8,'Student List Report',0,1,'C');

$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(12,10,'ID',1);
$pdf->Cell(45,10,'Name',1);
$pdf->Cell(45,10,'Father',1);
$pdf->Cell(30,10,'Class',1);
$pdf->Cell(58,10,'Phone',1);

$pdf->Ln();

$query=mysqli_query($conn,"SELECT * FROM students");

$pdf->SetFont('Arial','',9);

while($row=mysqli_fetch_assoc($query))
{

$pdf->Cell(12,10,$row['id'],1);

$pdf->Cell(45,10,$row['student_name'],1);

$pdf->Cell(45,10,$row['father_name'],1);

$pdf->Cell(30,10,$row['class_name'],1);

$pdf->Cell(58,10,$row['phone'],1);

$pdf->Ln();

}

$pdf->Output();

?>

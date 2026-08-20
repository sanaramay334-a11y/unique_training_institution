<?php

require('fpdf19/fpdf.php');
include("db.php");

$id=$_GET['id'];

$query=mysqli_query($conn,

"SELECT fees.*, students.student_name, students.course

FROM fees

INNER JOIN students

ON fees.student_id=students.id

WHERE fees.id='$id'");

$row=mysqli_fetch_assoc($query);

$pdf=new FPDF();

$pdf->AddPage();

$pdf->Image('images/logo.png',10,8,25);


$pdf->SetFont('Arial','B',18);

$pdf->Cell(190,10,'Unique Training Institution',0,1,'C');

$pdf->SetFont('Arial','',12);

$pdf->Cell(190,8,'Fee Receipt',0,1,'C');

$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(50,10,'Receipt No :');

$pdf->SetFont('Arial','',12);

$pdf->Cell(80,10,$row['id']);

$pdf->Ln();

$pdf->SetFont('Arial','B',12);

$pdf->Cell(50,10,'Student Name :');

$pdf->SetFont('Arial','',12);

$pdf->Cell(80,10,$row['student_name']);

$pdf->Ln();

$pdf->SetFont('Arial','B',12);

$pdf->Cell(50,10,'Course :');

$pdf->SetFont('Arial','',12);

$pdf->Cell(80,10,$row['course']);

$pdf->Ln();

$pdf->SetFont('Arial','B',12);

$pdf->Cell(50,10,'Amount :');

$pdf->SetFont('Arial','',12);

$pdf->Cell(80,10,'Rs. '.$row['amount']);

$pdf->Ln();

$pdf->SetFont('Arial','B',12);

$pdf->Cell(50,10,'Payment Date :');

$pdf->SetFont('Arial','',12);

$pdf->Cell(80,10,$row['payment_date']);

$pdf->Ln();

$pdf->SetFont('Arial','B',12);

$pdf->Cell(50,10,'Status :');

$pdf->SetFont('Arial','',12);

$pdf->Cell(80,10,$row['status']);

$pdf->Ln(25);

$pdf->Cell(120);

$pdf->Cell(60,10,'Authorized Signature',0,1,'C');


$pdf->Ln(20);

$pdf->SetFont('Arial','I',10);

$pdf->Cell(
190,
10,
'Thank you for choosing Unique Training Institution',
0,
1,
'C'
);

$pdf->Output();

?>

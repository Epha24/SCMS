<?php
    
ob_end_clean();
require('pdf_generator/fpdf.php');
include'../conn.php';

if(isset($_GET['clearance-id'])){
$sql = "SELECT *FROM clearance WHERE clearance_id = '".$_GET['clearance-id']."'";
// Instantiate and use the FPDF class 
$pdf = new FPDF();
  
//Add a new page
$pdf->AddPage(); 
// Set the font for the text
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(70);  
// Prints a cell with given text 
$pdf->Cell(50,20,'SATA Technology and Business College',0,0,'C');

// Line break
$pdf->Ln(20);
$pdf->Cell(70);
// Prints a cell with given text 
$pdf->Cell(50,0,'Student'."'s Clearance Form",0,0,'C');
$pdf->Ln(20);
$width_cell=array(35,35,35,26);
$pdf->SetFont('Arial','B',13);

//Background color of header//
$pdf->SetFillColor(193,229,252);

// Header starts /// 
//First header column //
$pdf->Cell($width_cell[0],10,'Department Head',1,0,'L',true);
//Third header column//
$pdf->Cell($width_cell[1],10,'Student Dean',1,0,'L',true);
//Third header column//
$pdf->Cell($width_cell[1],10,'Library',1,0,'L',true);
//Third header column//
$pdf->Cell($width_cell[2],10,'Exam & Assessment',1,0,'L',true); 
//Fourth header column//
$pdf->Cell($width_cell[3],10,'Finance',1,0,'L',true); 
//Fourth header column//
$pdf->Cell($width_cell[3],10,'Registrar',1,0,'L',true); 
//Fourth header column//
$pdf->Cell($width_cell[3],10,'A/V Dean',1,0,'L',true); 
//Fourth header column//
$pdf->Cell($width_cell[3],10,'Dean',1,1,'L',true); 
//// header ends ///////

$pdf->SetFont('Arial','',12);
//Background color of header//
$pdf->SetFillColor(235,236,236); 
//to give alternate background fill color to rows// 
$fill=false;

/// each record is one row  ///
foreach ($conn->query($sql) as $row) {
$pdf->Cell($width_cell[0],10,$row['dep_head_app'],1,0,'L',$fill);
$pdf->Cell($width_cell[1],10,$row['student_dean_app'],1,0,'L',$fill);
$pdf->Cell($width_cell[1],10,$row['librarian_app'],1,0,'L',$fill);
$pdf->Cell($width_cell[2],10,$row['exam_assessor_app'],1,0,'L',$fill);
$pdf->Cell($width_cell[3],10,$row['finance_app'],1,0,'L',$fill);
$pdf->Cell($width_cell[3],10,$row['registrar_app'],1,0,'L',$fill);
$pdf->Cell($width_cell[3],10,$row['vice_dean_app'],1,0,'L',$fill);
$pdf->Cell($width_cell[3],10,$row['dean_app'],1,1,'L',$fill);
//to give alternate background fill  color to rows//
$fill = !$fill;
}
  
// return the generated output
$pdf->Output();

}
?>
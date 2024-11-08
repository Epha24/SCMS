<?php
    
ob_end_clean();
require('pdf_generator/fpdf.php');
include'../conn.php';

if(isset($_GET['clearance-id'])){
$sql = "SELECT *FROM clearance WHERE clearance_id = '".$_GET['clearance-detail']."'";
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
$pdf->Cell($width_cell[0],10,'First Name',1,0,'L',true);
//Third header column//
$pdf->Cell($width_cell[1],10,'Middle Name',1,0,'L',true);
//Third header column//
$pdf->Cell($width_cell[1],10,'Last Name',1,0,'L',true);
//Third header column//
$pdf->Cell($width_cell[2],10,'Phone',1,0,'L',true); 
//Fourth header column//
$pdf->Cell($width_cell[3],10,'Sex',1,0,'L',true); 
//Fourth header column//
$pdf->Cell($width_cell[3],10,'Status',1,1,'L',true); 
//// header ends ///////

$pdf->SetFont('Arial','',12);
//Background color of header//
$pdf->SetFillColor(235,236,236); 
//to give alternate background fill color to rows// 
$fill=false;

/// each record is one row  ///
foreach ($conn->query($sql) as $row) {
$pdf->Cell($width_cell[0],10,$row['fname'],1,0,'L',$fill);
$pdf->Cell($width_cell[1],10,$row['mname'],1,0,'L',$fill);
$pdf->Cell($width_cell[1],10,$row['lname'],1,0,'L',$fill);
$pdf->Cell($width_cell[2],10,$row['phone'],1,0,'L',$fill);
$pdf->Cell($width_cell[3],10,$row['sex'],1,0,'L',$fill);
$pdf->Cell($width_cell[3],10,$row['status'],1,1,'L',$fill);
//to give alternate background fill  color to rows//
$fill = !$fill;
}
  
// return the generated output
$pdf->Output();

}

if(isset($_GET['teacher-id'])){

$sql = mysqli_query($conn, "SELECT *FROM teacher WHERE teach_id= '".$_GET['teacher-id']."'");
	$sql2 = mysqli_query($conn,"SELECT *FROM school");
$row_school = mysqli_fetch_array($sql2);

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
$pdf->Cell(50,5,'Teacher'."'s Profile",0,0,'C');
$pdf->Ln(20);


$row = mysqli_fetch_array($sql);

// Set the font for the text
$pdf->SetFont('Arial', 'B', 14);
// Prints a cell with given text 
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(50,0,'Name :',0,0,'L');
$pdf->Cell(-30);
$pdf->SetFont('Arial', 'i', 14);
$pdf->Cell(10,0,$row['fname']." ".$row['mname']." ".$row['lname'],0,0,'L');
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(50,0,'Phone :',0,0,'L');
$pdf->Cell(-29);
$pdf->SetFont('Arial', 'i', 14);
$pdf->Cell(10,0,$row['phone'],0,0,'L');
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(50,0,'Sex :',0,0,'L');
$pdf->Cell(-29);
$pdf->SetFont('Arial', 'i', 14);
$pdf->Cell(10,0,$row['sex'],0,0,'L');
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(50,0,'Status :',0,0,'L');
$pdf->Cell(-27);
$pdf->SetFont('Arial', 'i', 14);
$pdf->Cell(10,0,$row['status'],0,0,'L');
// return the generated output
$pdf->Output();
}


if(isset($_GET['department'])){
$sql = "SELECT *FROM department ORDER BY dep_name ASC";
  
// Instantiate and use the FPDF class 
$pdf = new FPDF();
  
//Add a new page
$pdf->AddPage();
$pdf->Image('../logo.JPG',10,10,200);  
// Set the font for the text
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(70);  
// Prints a cell with given text 
$pdf->Cell(50,20,'Mirab Abaya Construction and Industrial College',0,0,'C');

// Line break
$pdf->Ln(20);
$pdf->Cell(70); 
// Prints a cell with given text 
$pdf->Cell(50,10,'Office of Registrar',0,0,'C');
// Line break
$pdf->Ln(20);
$pdf->Cell(70);
// Prints a cell with given text 
$pdf->Cell(50,0,'Department List',0,0,'C');
$pdf->Ln(20);
$width_cell=array(115,70);
$pdf->SetFont('Arial','B',13);

//Background color of header//
$pdf->SetFillColor(193,229,252);

// Header starts /// 
//First header column //
$pdf->Cell($width_cell[0],10,'Department',1,0,'C',true);
//Second header column//
$pdf->Cell($width_cell[1],10,'Status',1,1,'C',true); 
//// header ends ///////

$pdf->SetFont('Arial','',12);
//Background color of header//
$pdf->SetFillColor(235,236,236); 
//to give alternate background fill color to rows// 
$fill=false;

/// each record is one row  ///
foreach ($conn->query($sql) as $row) {
$pdf->Cell($width_cell[0],10,$row['dep_name']." (".$row['dep_name_opt'].") ",1,0,'L',$fill);
$pdf->Cell($width_cell[1],10,$row['status'],1,1,'L',$fill);
//to give alternate background fill  color to rows//
$fill = !$fill;
}
  
// return the generated output
$pdf->Output();

}

if(isset($_GET['course'])){
$sql = "SELECT *FROM course ORDER BY course ASC";
  
// Instantiate and use the FPDF class 
$pdf = new FPDF();
  
//Add a new page
$pdf->AddPage();
$pdf->Image('../logo.JPG',10,10,200);  
// Set the font for the text
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(70);  
// Prints a cell with given text 
$pdf->Cell(50,20,'Mirab Abaya Construction and Industrial College',0,0,'C');

// Line break
$pdf->Ln(20);
$pdf->Cell(70); 
// Prints a cell with given text 
$pdf->Cell(50,10,'Office of Registrar',0,0,'C');
// Line break
$pdf->Ln(20);
$pdf->Cell(70);
// Prints a cell with given text 
$pdf->Cell(50,0,'Course List',0,0,'C');
$pdf->Ln(20);
$width_cell=array(118,27,25,25);
$pdf->SetFont('Arial','B',13);

//Background color of header//
$pdf->SetFillColor(193,229,252);

// Header starts /// 
//First header column //
$pdf->Cell($width_cell[0],10,'Course',1,0,'C',true);
//Second header column//
$pdf->Cell($width_cell[1],10,'Credit Hour',1,0,'L',true);
//Third header column//
$pdf->Cell($width_cell[2],10,'Type',1,0,'L',true);
//Third header column//
$pdf->Cell($width_cell[3],10,'Status',1,1,'L',true); 
//// header ends ///////

$pdf->SetFont('Arial','',12);
//Background color of header//
$pdf->SetFillColor(235,236,236); 
//to give alternate background fill color to rows// 
$fill=false;

/// each record is one row  ///
foreach ($conn->query($sql) as $row) {
$pdf->Cell($width_cell[0],10,$row['course'],1,0,'L',$fill);
$pdf->Cell($width_cell[1],10,$row['cr_hr'],1,0,'L',$fill);
$pdf->Cell($width_cell[2],10,$row['type'],1,0,'L',$fill);
$pdf->Cell($width_cell[3],10,$row['status'],1,1,'L',$fill);
//to give alternate background fill  color to rows//
$fill = !$fill;
}
  
// return the generated output
$pdf->Output();

}

if(isset($_GET['program'])){
$sql = "SELECT *FROM program ORDER BY program ASC";
  
// Instantiate and use the FPDF class 
$pdf = new FPDF();
  
//Add a new page
$pdf->AddPage();
$pdf->Image('../logo.JPG',10,10,200);  
// Set the font for the text
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(70);  
// Prints a cell with given text 
$pdf->Cell(50,20,'Mirab Abaya Construction and Industrial College',0,0,'C');

// Line break
$pdf->Ln(20);
$pdf->Cell(70); 
// Prints a cell with given text 
$pdf->Cell(50,10,'Office of Registrar',0,0,'C');
// Line break
$pdf->Ln(20);
$pdf->Cell(70);
// Prints a cell with given text 
$pdf->Cell(50,0,'Program List',0,0,'C');
$pdf->Ln(20);
$width_cell=array(115,70);
$pdf->SetFont('Arial','B',13);

//Background color of header//
$pdf->SetFillColor(193,229,252);

// Header starts /// 
//First header column //
$pdf->Cell($width_cell[0],10,'Program',1,0,'C',true);
//Second header column//
$pdf->Cell($width_cell[1],10,'Status',1,1,'C',true); 
//// header ends ///////

$pdf->SetFont('Arial','',12);
//Background color of header//
$pdf->SetFillColor(235,236,236); 
//to give alternate background fill color to rows// 
$fill=false;

/// each record is one row  ///
foreach ($conn->query($sql) as $row) {
$pdf->Cell($width_cell[0],10,$row['program'],1,0,'L',$fill);
$pdf->Cell($width_cell[1],10,$row['status'],1,1,'L',$fill);
//to give alternate background fill  color to rows//
$fill = !$fill;
}
  
// return the generated output
$pdf->Output();

}
  
?>
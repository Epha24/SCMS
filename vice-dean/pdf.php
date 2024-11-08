<?php
    
ob_end_clean();
require('pdf_generator/fpdf.php');
include'../conn.php';

if(isset($_GET['all-student'])){
$sql = "SELECT student.stud_id, student.fname, student.mname, student.lname, student.sex, student.age, student.entry, student.program, student.modality, student.section, student.status, program.program_id, program.program AS 'program_name', section.section_id, section.section AS 'section_name', modality.modality_id, modality.modality AS 'modality_name', department.dep_id, department.department AS 'dep_name' FROM student JOIN program JOIN section JOIN modality JOIN department ON student.program = program.program_id AND student.section = section.section_id AND student.modality = modality.modality_id AND student.department = department.dep_id ORDER BY student.fname, student.mname, student.lname ASC";
  
// Instantiate and use the FPDF class 
$pdf = new FPDF();
  
//Add a new page
$pdf->AddPage();
$pdf->Image('../logo.JPG',10,10,200);  
// Set the font for the text
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(70);  
// Prints a cell with given text 
$pdf->Cell(50,20,'SATA Technology and Business College',0,0,'C');

// Line break
$pdf->Ln(20);
$pdf->Cell(70); 
// Prints a cell with given text 
$pdf->Cell(50,10,'Office of Registrar',0,0,'C');
// Line break
$pdf->Ln(20);
$pdf->Cell(70);
// Prints a cell with given text 
$pdf->Cell(50,0,'Student List',0,0,'C');
$pdf->Ln(20);
$width_cell=array(30,30,30,28,47,28,33);
$pdf->SetFont('Arial','B',13);

//Background color of header//
$pdf->SetFillColor(193,229,252);

// Header starts /// 
//First header column //
$pdf->Cell($width_cell[0],10,'ID',1,0,'C',true);
//Second header column//
$pdf->Cell($width_cell[1],10,'First Name',1,0,'L',true);
//Third header column//
$pdf->Cell($width_cell[1],10,'Middle Name',1,0,'L',true);
//Third header column//
$pdf->Cell($width_cell[3],10,'Last Name',1,0,'L',true);
//Third header column//
$pdf->Cell($width_cell[6],10,'Program',1,0,'L',true); 
//Fourth header column//
$pdf->Cell($width_cell[4],10,'Department',1,1,'L',true); 
//// header ends ///////

$pdf->SetFont('Arial','',12);
//Background color of header//
$pdf->SetFillColor(235,236,236); 
//to give alternate background fill color to rows// 
$fill=false;

/// each record is one row  ///
foreach ($conn->query($sql) as $row) {
$pdf->Cell($width_cell[0],10,$row['stud_id'],1,0,'C',$fill);
$pdf->Cell($width_cell[1],10,$row['fname'],1,0,'L',$fill);
$pdf->Cell($width_cell[1],10,$row['mname'],1,0,'L',$fill);
$pdf->Cell($width_cell[3],10,$row['lname'],1,0,'L',$fill);
$pdf->Cell($width_cell[6],10,$row['program_name'],1,0,'L',$fill);
$pdf->Cell($width_cell[4],10,$row['dep_name'],1,1,'L',$fill);
//to give alternate background fill  color to rows//
$fill = !$fill;
}
  
// return the generated output
$pdf->Output();

}

if(isset($_GET['stud-id'])){

	$sql = mysqli_query($conn, "SELECT student.stud_id, student.fname, student.mname, student.lname, student.sex, student.age, student.phone, student.address, student.entry, student.dep, student.level, student.status, department.dep_id, department.dep_name, department.dep_name_opt FROM student JOIN department ON student.dep = department.dep_id AND student.stud_id = '".$_GET['stud-id']."'");

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
$pdf->Ln(18);
$pdf->Cell(70); 
// Prints a cell with given text 
$pdf->Cell(50,5,'Office of Registrar',0,0,'C');
// Line break
$pdf->Ln(10);
$pdf->Cell(70);
// Prints a cell with given text 
$pdf->Cell(50,5,'Student Profile',0,0,'C');
$pdf->Ln(20);


$row = mysqli_fetch_array($sql);

// Set the font for the text
$pdf->SetFont('Arial', 'B', 14);
// Prints a cell with given text 
$pdf->Cell(5);
$pdf->Cell(50,0,'ID :',0,0,'L');
$pdf->Cell(-30);
$pdf->SetFont('Arial', 'i', 14);
$pdf->Cell(10,0,$row['stud_id'],0,0,'L');
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(50,0,'Name :',0,0,'L');
$pdf->Cell(-30);
$pdf->SetFont('Arial', 'i', 14);
$pdf->Cell(10,0,$row['fname'],0,0,'L');
$pdf->Cell(9); 
$pdf->Cell(10,0,$row['mname'],0,0,'L');
$pdf->Cell(12); 
$pdf->Cell(10,0,$row['lname'],0,0,'L');
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(50,0,'Gender :',0,0,'L');
$pdf->Cell(-29);
$pdf->SetFont('Arial', 'i', 14);
$pdf->Cell(10,0,$row['sex'],0,0,'L');
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(50,0,'Age :',0,0,'L');
$pdf->Cell(-30);
$pdf->SetFont('Arial', 'i', 14);
$pdf->Cell(10,0,$row['age'],0,0,'L');
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(50,0,'Phone :',0,0,'L');
$pdf->Cell(-30);
$pdf->SetFont('Arial', 'i', 14);
$pdf->Cell(10,0,$row['phone'],0,0,'L');
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(50,0,'Address :',0,0,'L');
$pdf->Cell(-24);
$pdf->SetFont('Arial', 'i', 14);
$pdf->Cell(10,0,$row['address'],0,0,'L');
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(50,0,'Entry :',0,0,'L');
$pdf->Cell(-30);
$pdf->SetFont('Arial', 'i', 14);
$pdf->Cell(10,0,$row['entry'],0,0,'L');
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(50,0,'Department :',0,0,'L');
$pdf->Cell(-18);
$pdf->SetFont('Arial', 'i', 14);
$pdf->Cell(10,0,$row['dep_name'],0,0,'L');
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(50,0,'Admitted Level :',0,0,'L');
$pdf->Cell(-10);
$pdf->SetFont('Arial', 'i', 14);
$pdf->Cell(10,0,$row['level'],0,0,'L');
// return the generated output
$pdf->Output();
}


if(isset($_GET['department'])){
$sql = "SELECT *FROM department ORDER BY department ASC";
  
// Instantiate and use the FPDF class 
$pdf = new FPDF();
  
//Add a new page
$pdf->AddPage();
$pdf->Image('../logo.JPG',10,10,200);  
// Set the font for the text
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(70);  
// Prints a cell with given text 
$pdf->Cell(50,20,'SATA Technology and Business College',0,0,'C');

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
$pdf->Cell($width_cell[0],10,$row['department'],1,0,'L',$fill);
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
$pdf->Cell(50,20,'SATA Technology and Business College',0,0,'C');

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
$width_cell=array(100,32,25,25);
$pdf->SetFont('Arial','B',13);

//Background color of header//
$pdf->SetFillColor(193,229,252);

// Header starts /// 
//First header column //
$pdf->Cell($width_cell[1],10,'Course Code',1,0,'C',true);
//Second header column//
$pdf->Cell($width_cell[0],10,'Course',1,0,'L',true);
//Third header column//
$pdf->Cell($width_cell[2],10,'Credit Hour',1,0,'L',true);
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
$pdf->Cell($width_cell[1],10,$row['course_id'],1,0,'L',$fill);
$pdf->Cell($width_cell[0],10,$row['course'],1,0,'L',$fill);
$pdf->Cell($width_cell[2],10,$row['crhour'],1,0,'L',$fill);
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
$pdf->Cell(50,20,'SATA Technology and Business College',0,0,'C');

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
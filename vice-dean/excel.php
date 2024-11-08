<?php 

  include'../conn.php';

  if(isset($_GET['offer_id'])){
  // $semester_id = $_GET['semester_id'];
  // $dep_id = $_GET['dep_id'];
  // $batch = $_GET['batch'];
  // $program_id = $_GET['program_id'];
  // $modality_id = $_GET['modality_id'];
  // $ay_id = $_GET['ay_id'];
  $id = $_GET['offer_id'];
  $html = "";

      // $qry_res = mysqli_query($conn, "SELECT department.dep_id, department.dep_name, course.course_id, course.course, course.course_short_name, student.stud_id, student.fname, student.mname, student.lname, student.sex, student.age, level.level_id, level.level, result.result_id, result.course_id, result.stud_id, result.batch, result.dep_id, result.level_id, result.value FROM department JOIN course JOIN student JOIN level JOIN result ON department.dep_id = result.dep_id AND course.course_id = result.course_id AND student.stud_id = result.stud_id AND level.level_id = result.level_id AND result.dep_id = '".$dep."' AND result.level_id = '".$level."' AND result.batch = '".$batch."' GROUP BY result.stud_id");

      $stud = mysqli_query($conn, "SELECT student.stud_id, student.fname, student.mname, student.lname, student.entry, student.program, student.department, student.section, student.modality, course_enroll.enroll_id, course_enroll.stud_id, course_enroll.ay_id, course_enroll.semester_id, course_enroll.course_id, offer_course.offer_id, offer_course.dep_id, offer_course.ay_id, offer_course.semester_id, offer_course.batch, offer_course.modality_id, offer_course.section_id, offer_course.program_id, offer_course.course_id, offer_course.teach_id  FROM student JOIN course_enroll JOIN offer_course ON student.stud_id = course_enroll.stud_id AND student.entry = offer_course.batch AND offer_course.ay_id = course_enroll.ay_id AND student.program = offer_course.program_id AND student.department = offer_course.dep_id AND course_enroll.course_id = (SELECT course_id FROM offer_course WHERE offer_id = '$id') AND student.section = offer_course.section_id AND student.modality = offer_course.modality_id AND student.department = offer_course.dep_id AND offer_course.offer_id = '".$id."' ORDER BY student.fname, student.mname, student.lname"); 

          $html .='<div style="border-radius: 0px; border:1px solid #e6ede7;">
          <br>
          <h2 style="font-family: Times New Roman; font-style: bold;"><center>SATA Technology and Business College</center></h1>
          <h2 style="font-family: Times New Roman; font-style: bold;"><center>Office of Registrar</center></h2>
          <h3 style="font-family: Times New Roman; font-style: bold;"><center>Students Grade</center></h3><br>';
          
           $qry_header = mysqli_query($conn, "SELECT offer_course.offer_id, offer_course.dep_id, offer_course.ay_id, offer_course.batch, offer_course.modality_id, offer_course.section_id, offer_course.program_id, offer_course.course_id, offer_course.teach_id, semester.semester_id, semester.semester, semester.semester_word, modality.modality_id, modality.modality, section.section_id, section.section, program.program_id, program.program, course.course_id, course.course AS 'course_name', department.dep_id, department.department AS 'dep_name' FROM offer_course JOIN semester JOIN modality JOIN section JOIN program JOIN course JOIN department ON offer_course.semester_id = semester.semester_id AND offer_course.modality_id = modality.modality_id AND offer_course.section_id = section.section_id AND offer_course.program_id = program.program_id AND offer_course.course_id = course.course_id AND offer_course.dep_id = department.dep_id AND offer_course.offer_id = '$id'");
            $row_header = mysqli_fetch_array($qry_header); 

             $html .= '<h4 style="font-family: Times New Roman;">&nbsp;&nbsp;Department : <span class="text-danger">'.$row_header['dep_name'].'</span> | Program : <span class="text-danger">'.$row_header['program'].' </span> | Modality : <span class="text-danger">'.$row_header['modality'].'</span> | Section : <span class="text-danger">'.$row_header['section'].'</span> | Batch : <span class="text-danger">'.$row_header['batch'].'</span> | Course : <span class="text-danger">'.$row_header['course_name'].'</span></h4></div>
               <table style="border-collapse: collapse;">
                <thead>
                <tr>';
                  $qry_course = mysqli_query($conn, "SELECT DISTINCT exam_name, out_of FROM exam WHERE batch = (SELECT batch FROM offer_course WHERE offer_id = '".$_GET['offer_id']."') AND modality_id = (SELECT modality_id FROM offer_course WHERE offer_id = '".$_GET['offer_id']."') AND program_id = (SELECT program_id FROM offer_course WHERE offer_id = '".$_GET['offer_id']."') AND dep_id = (SELECT dep_id FROM offer_course WHERE offer_id = '".$_GET['offer_id']."') AND course_id = (SELECT course_id FROM offer_course WHERE offer_id = '".$_GET['offer_id']."')");
                   
        $html .= '
                  <th style="border:1px solid black;">ID</th>
                  <th style="border:1px solid black;">Name</th>';
                  
                  while($row_course = mysqli_fetch_array($qry_course)){ 
                   $html .='<th style="border:1px solid black;">'.$row_course['exam_name'].' ( '.$row_course['out_of'].' % )</th>';} 
                  $html .='<th style="border:1px solid black;">Total</th>  
                  <th style="border:1px solid black;">Grade</th>               
                  </tr>
                  </thead>
                  <tbody>';

                  // $num = 1;
                   while($row = mysqli_fetch_array($stud)){
                  
                $html .= '<tr>                  
                  <td style="border:1px solid black;">'.$row["stud_id"].'</td>
                  <td style="border:1px solid black;">'.$row["fname"]." ".$row["mname"]." ".$row["lname"].'</td>';

                $qry_res2 = mysqli_query($conn, "SELECT exam_id, course_id, exam_name, out_of, value FROM exam WHERE stud_id = '".$row['stud_id']."' AND course_id = '".$row['course_id']."' ORDER BY ex_order");
                       $qry_total_av = mysqli_query($conn, "SELECT *FROM total WHERE stud_id = '".$row['stud_id']."' AND ay_id = '".$row['ay_id']."' AND course_id = '".$row['course_id']."' AND semester_id = '".$row['semester_id']."'");
                        while($row_val = mysqli_fetch_array($qry_res2)){

                        $html .= '<td style="border:1px solid black;">'.$row_val["value"].'</td>'; 
                      } 

                        $row_total = mysqli_fetch_array($qry_total_av); 
                        $html .='<td style="border:1px solid black;">'.$row_total["value"].'</td><td style="border:1px solid black;">'; 

                        if($row_total["value"] >= 90 ){
                         $html .='A+';
                          } 
                          else if($row_total["value"] >= 85 ){
                         $html .='A';
                          }
                          else if($row_total["value"] >= 80 ){
                         $html .='A-';
                          }
                          else if($row_total["value"] >= 75 ){
                         $html .='B+';
                          }
                          else if($row_total["value"] >= 70 ){
                         $html .='B';
                          } 
                          else if($row_total["value"] >= 65 ){
                         $html .='B-';
                          } 
                          else if($row_total["value"] >= 60 ){
                         $html .='C+';
                          }  
                          else if($row_total["value"] >= 50 ){
                         $html .='C';
                          } 
                          else if($row_total["value"] >= 55 ){
                         $html .='D';
                          }   
                          else if($row_total["value"] < 55 ){
                         $html .='F';
                          } 
                          

         $html .='</td>';
                $html .='</tr>';  } 
                $html .='</tbody>
              </table>'; 

             header('Content-Type:application/xls');
             header('Content-Disposition:attachment;filename=report.xls');
             echo $html; }

           ?>
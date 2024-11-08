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

             if(isset($_GET['export_id'])){

              $stud_id = $_GET['export_id'];
              $dep_id = $_GET['department_id'];
              $batch = $_GET['student_batch'];
              $html = "";
              $arry_level = array();
              $x = 0;
              $y = 0;
              $total = 0;

              $html .='<div style="margin-left:30px; border-radius: 0px; border:1px solid #e6ede7;"><br>
                    <h2 style="font-family: Times New Roman; font-style: bold;"><center>Mirab Abaya Construction and Industrial College</center></h1>
                    <h2 style="font-family: Times New Roman; font-style: bold;"><center>Office of Registrar</center></h2>
                   <h3 style="font-family: Times New Roman; font-style: bold;"><center>Students Grade</center></h3><br>';
                   $qry_stud = mysqli_query($conn, "SELECT student.stud_id, student.fname, student.mname, student.lname, student.sex, student.dep, department.dep_id, department.dep_name FROM student JOIN department ON student.dep = department.dep_id AND stud_id = '".$stud_id."'");
                   $row = mysqli_fetch_array($qry_stud);
                   $html .= '<div style="margin-left:30px;"><h4 style="font-family:Times New Roman;"><b>ID : </b>'.$row['stud_id'].'</h4><h4 style="font-family:Times New Roman;"><b>Name : </b>'.$row['fname'].' '.$row['mname'].' '.$row['lname'].'</h4><h4 style="font-family:Times New Roman;"><b>Department : </b>'.$row['dep_name'].'</h4><h4 style="font-family:Times New Roman;"><b>Sex : </b>'.$row['sex'].'</h4></div></div>
                     <div style="margin-left:30px;"><table style="border-collapse:collapse; border:1;">
                       <thead>
                        <tr>';

                   $qry_level = mysqli_query($conn, "SELECT level.level_id, level.level, total_average.id, total_average.stud_id, total_average.level_id FROM level JOIN total_average ON level.level_id = total_average.level_id AND total_average.stud_id = '".$stud_id."'");
                   while($row_level = mysqli_fetch_array($qry_level)){ $html .='<th style="border:1px solid black;">Level'.$row_level['level'].'</th>'; $arry_level[$x] = $row_level['level_id']; $x++; }
                   $html .='<th style="border:1px solid black;"> Overall Result </th></tr></thead><tbody><tr>';
                   for($r = 0; $r < count($arry_level); $r++){
                        $qry_totl_av = mysqli_query($conn, "SELECT *FROM total_average WHERE stud_id = '".$stud_id."' AND level_id = '".$arry_level[$r]."'");
                        $row_qry = mysqli_fetch_array($qry_totl_av);
                        $total +=$row_qry['total'];
                        $html .= '<td style="border:1px solid black;">Toal = '.$row_qry['total'].' | Average = '.$row_qry['average'].'</td>'; }
                        $html .= '<td style="border:1px solid black;"> Total = '.$total.' | Average = '.($total/count($arry_level)).'</td></tr></tbody></table></div>';

                        header('Content-Type:application/xls');
                        header('Content-Disposition:attachment;filename=overall_report.xls');
                        echo $html;
             }

             if(isset($_GET['all_export'])){
              $department = $_GET['all_export'];
              $stud_batch = $_GET['stud_batch'];
              $arry_level = array();
              $html = "";
              $x = 0;
              $y = 0;

              $qry_res = mysqli_query($conn, "SELECT *FROM department WHERE dep_id = '".$department."'");
              $html .='<div style="border-radius: 0px; border:1px solid #e6ede7;"><br>
                       <h2 style="font-family: Times New Roman; font-style: bold;"><center>Mirab Abaya Construction and Industrial College</center></h1>
                       <h2 style="font-family: Times New Roman; font-style: bold;"><center>Office of Registrar</center></h2>
                       <h3 style="font-family: Times New Roman; font-style: bold;"><center>Students Grade</center></h3><br>';
                       $row_header = mysqli_fetch_array($qry_res);

                       $html .='<h4 style="font-family: Times New Roman;">&nbsp;&nbsp;Department : <span class="text-danger">'.$row_header["dep_name"].'</span> | Batch : <span class="text-danger">'.$stud_batch.'</span></h4></div>
                      ';
                $qry_course = mysqli_query($conn, "SELECT level.level_id, level.level, result.batch, result.level_id, result.dep_id FROM level JOIN result ON level.level_id = result.level_id AND result.dep_id = '".$department."' AND result.batch = '".$stud_batch."' GROUP BY result.dep_id, result.level_id");
                $html.='<table style="border-collapse:collapse">
                    <thead>
                      <tr><th style="border:1px solid black;">ID</th>
                        <th style="border:1px solid black;">Name</th>';

                while($row_level = mysqli_fetch_array($qry_course)){ $html.='<th style="border:1px solid black;">Level'.$row_level['level'].'</th>'; $arry_level[$x] = $row_level["level_id"]; $x++;}
                
                $html .='</tr>
                         </thead>
                         <tbody>'; 

                $qry_res2 = mysqli_query($conn, "SELECT student.stud_id, student.fname, student.mname, student.entry, student.dep, total_average.id, total_average.stud_id, total_average.level_id, total_average.total, total_average.average FROM student JOIN total_average ON student.stud_id = total_average.stud_id AND student.dep = '".$department."' AND student.entry = '".$stud_batch."' GROUP BY student.stud_id");
                  $num = 1;
                   while($row_stud = mysqli_fetch_array($qry_res2)){ 
                   $html .='<tr>
                           <td style="border:1px solid black;">'.$row_stud['stud_id'].'</td>
                           <td style="border:1px solid black;">'.$row_stud['fname'].' '.$row_stud['mname'].'</td>';

                    for($i = 0; $i < count($arry_level); $i++){
                       $qry_total_av = mysqli_query($conn, "SELECT total, average FROM total_average WHERE stud_id = '".$row_stud['stud_id']."' AND level_id = '".$arry_level[$i]."'");
                        $row_val = mysqli_fetch_array($qry_total_av);
                        $html .='<td style="border:1px solid black;"> Total = '.$row_val["total"].' | Average = '.$row_val["average"].'</td>'; } 
                        $html .='</tr>';
                        $num++; } 

                        $html .='</tbody></table>';
                header('Content-Type:application/xls');
                header('Content-Disposition:attachment;filename=All_overall_report.xls');
                echo $html;

             }
            
    ?>
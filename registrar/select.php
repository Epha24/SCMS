<?php

include '../conn.php';

if(isset($_GET['sem_res'])){

	$sem_res = $_GET['sem_res'];
	$ay_res = $_GET['ay_res'];
	$num = 1;

	    $qry = mysqli_query($conn,"SELECT offer_course.offer_id, offer_course.dep_id, offer_course.ay_id, offer_course.batch, offer_course.modality_id, offer_course.section_id, offer_course.program_id, offer_course.course_id, offer_course.teach_id, semester.semester_id, semester.semester, semester.semester_word, academic_year.ay_id, academic_year.academic_year, modality.modality_id, modality.modality, section.section_id, section.section, program.program_id, program.program, course.course_id, course.course, department.dep_id, department.department AS 'dep_name' FROM offer_course JOIN semester JOIN academic_year JOIN modality JOIN section JOIN program JOIN course JOIN department ON offer_course.semester_id = semester.semester_id AND offer_course.ay_id = academic_year.ay_id AND offer_course.modality_id = modality.modality_id AND offer_course.section_id = section.section_id AND offer_course.program_id = program.program_id AND offer_course.course_id = course.course_id AND offer_course.dep_id = department.dep_id AND offer_course.ay_id = '".$ay_res."' AND offer_course.semester_id = '".$sem_res."'");
	    	echo "<select class='form-control' name='course' id='course' onchange='mark()'>";

	    	while($row_query = mysqli_fetch_array($qry)){
	    		echo "<option disabled='disabled' selected='selected'>Department : ".$row_query['dep_name']." | Program : " .$row_query['program']." | Modality : ".$row_query['modality']." | Section : ".$row_query['section']."</option>";
	    		echo "<option value='".$row_query['offer_id']."'>&nbsp;&nbsp;&nbsp;&nbsp;".$row_query['course']."</option>";
	    	}
	    	echo "</select>";

}

if(isset($_GET['dep'])){

	$dep = $_GET['dep'];

	    $qry = "SELECT DISTINCT entry FROM student WHERE dep = '".$dep."'";
		$ext = mysqli_query($conn,$qry);
		echo "<select class='form-control' name='batch' id='batch'>";
		echo "<option selected='selected' disabled='disabled'>Select Batch</option>";
		while($row = mysqli_fetch_array($ext)){
			echo "<option>".$row['entry']."</option>";
		}
		echo "</select>";

}

if(isset($_GET['stud_check_id'])){
	$id = $_GET['stud_check_id'];

	if(mysqli_num_rows(mysqli_query($conn, "SELECT *FROM student WHERE stud_id = '$id'")) > 0){
		echo "Student ID already exists";
	}
}

if(isset($_GET['dep_id'])){
	$dep = $_GET['dep_id'];

	    $qry = "SELECT course.course_id, course.course, course.course_short_name, course.type, dep_course.dep_course_id, dep_course.dep_id, dep_course.course_id, department.dep_id, department.dep_name FROM course JOIN dep_course JOIN department ON department.dep_id = dep_course.dep_id AND department.dep_id = '".$dep."' AND course.course_id = dep_course.course_id";
		$ext = mysqli_query($conn,$qry);
		echo "<select class='form-control' name='course[]' multiple>";
		echo "<option selected='selected' disabled='disabled'> -- Select Course --</option>";
		while($row = mysqli_fetch_array($ext)){
			echo "<option value='".$row['course_id']."'>".$row['course']."</option>";
		}
		echo "</select>";
}

if(isset($_GET['course_dep'])){
	$dep = $_GET['course_dep'];

	    $qry = "SELECT course.course_id, course.course, course_department.cd_id, course_department.course_id, course_department.dep_id, department.dep_id, department.department FROM course JOIN course_department JOIN department ON course.course_id = course_department.course_id AND course_department.dep_id = department.dep_id AND department.dep_id = '$dep'";
		$ext = mysqli_query($conn,$qry);
		echo "<label>Course : </label><select class='form-control' name='course'>";
		echo "<option selected='selected' disabled='disabled'> -- Select Course --</option>";
		while($row = mysqli_fetch_array($ext)){
			echo "<option value='".$row['course_id']."'>".$row['course']."</option>";
		}
		echo "</select>";
}

if(isset($_GET['entry'])){
	$entry = $_GET['entry'];
	$section = $_GET['section'];
	$program = $_GET['program'];
	$modality = $_GET['modality'];
	$department = $_GET['department'];

	   $qry = mysqli_query($conn, "SELECT stud_id, fname, mname, lname, entry FROM student WHERE entry = '".$entry."' AND section = '".$section."' AND program = '".$program."' AND department = '".$department."' AND modality = '".$modality."'");

		echo "<select class='form-control' name='student' id='student' onchange='select_course()'>
		<option selected='selected' disabled='disabled'> -- Select Student --</option>";
		while($row = mysqli_fetch_array($qry)){
			echo "<option value='".$row['stud_id']."'>".$row['fname']." ".$row['mname']." ".$row['lname']."</option>";
		}
		echo "</select>";
}

if(isset($_GET['student_id'])){
	$student_id = $_GET['student_id'];
	$max = 0;

	$qry_mx = mysqli_query($conn, "SELECT MAX(class_id) AS 'max' FROM student_class WHERE stud_id = '$student_id'");
	if(mysqli_num_rows($qry_mx) > 0){
		$row = mysqli_fetch_array($qry_mx);
    $max = $row['max'];
	}else{
		$max = 0;
	}
	
	$qry_sel = mysqli_query($conn, "SELECT *FROM class WHERE class_id > '$max'");

	echo "<select class='form-control' name='class' id='class'>";
        while($row_x = mysqli_fetch_array($qry_sel)){
	    	echo "<option value='".$row_x['class_id']."'>".$row_x['class_name']." ( ".$row_x['class_word']." )</option>";

	    }
    echo "</select>";

}

if(isset($_GET['class_stud_id'])){
	$class_id = $_GET['class_stud_id'];
	$student_id = $_GET['student_id2'];
	$max = 0;
	$max_plus_one = 0;

	$qry_mx = mysqli_query($conn, "SELECT MAX(class_id) AS 'max' FROM student_class WHERE stud_id = '$student_id'");
	if(mysqli_num_rows($qry_mx) > 0){
		$row = mysqli_fetch_array($qry_mx);
    $max = $row['max'];
    $qry_max2 = mysqli_query($conn, "SELECT class_id FROM class WHERE class_id > '$max' LIMIT 1");
    $row_x1 = mysqli_fetch_array($qry_max2);
    $max_plus_one = $row_x1['class_id'];
	}else{
		$max = 0;
		$qry_max2 = mysqli_query($conn, "SELECT class_id FROM class WHERE class_id > '$max' LIMIT 1");
		$row_x1 = mysqli_fetch_array($qry_max2);
    $max_plus_one = $row_x1['class_id'];
	}

	if($class_id > $max_plus_one){
		echo "Selected student is not completed the previous class";
	}

}

if(isset($_GET['level']) && isset($_GET['depart'])){
	$level = $_GET['level'];
	$dep = $_GET['depart'];
	$batch = $_GET['batch'];

	    $qry = "SELECT *FROM result WHERE dep_id = '".$dep."' AND level_id = '".$level."' AND batch = '".$batch."'";
		$ext = mysqli_query($conn, $qry);
		$count = mysqli_num_rows($ext);

		if($count == 0){
			echo "<hr><button class='btn btn-primary' name='create_sheet'>Create Mark Sheet</button>";
		}else{

			$stud = mysqli_query($conn, "SELECT stud_id, fname, mname FROM student WHERE dep = '".$dep."' AND entry = '".$batch."'"); ?>

				<form action="result.php?manage-result" method="POST">
					<div style="border-radius: 0px; border:1px solid #e6ede7;">
						<br>
					<h2 style="font-family: roman; font-style: bold;"><center>Mirab Abaya Construction and Industrial College</center></h1>
					<h2 style="font-family: roman; font-style: bold;"><center>Office of Registrar</center></h2>
					<h3 style="font-family: roman; font-style: bold;"><center>Students' Grade</center></h3><br>
				<?php $qry_header = mysqli_query($conn, "SELECT department.dep_id, department.dep_name, department.dep_name_opt, level.level_id, level.level, result.dep_id, result.level_id FROM department JOIN level JOIN result ON department.dep_id = result.dep_id AND level.level_id =  result.level_id AND result.dep_id = '".$dep."' AND result.level_id = '".$level."'");
				   $row_header = mysqli_fetch_array($qry_header); ?>

				   	 <h5 style="font-family: roman;">&nbsp;&nbsp;Department : <span class="text-danger"><?php echo $row_header["dep_name"]; ?></span> | Batch : <span class="text-danger"><?php echo $batch; ?></span> | Level : <span class="text-danger"><?php echo $row_header["level"]; ?></span></h5></div>
				     <table class="table table-bordered example1">
                <thead>
                <tr>
                	<?php $qry_course = mysqli_query($conn, "SELECT course.course_id, course.course, course.course_short_name, result.result_id, result.course_id, result.stud_id, result.batch, result.dep_id, result.level_id FROM course JOIN result ON course.course_id = result.course_id AND result.dep_id = '".$dep."' AND result.level_id = '".$level."' AND result.batch = '".$batch."' GROUP BY result.course_id, result.dep_id, result.level_id, result.batch");
                	 ?>
                  <th>No</th>
				          <th>ID</th>
                  <th>Name</th>
                  <?php while($row_course = mysqli_fetch_array($qry_course)){ echo "<th><a href='#' title='".$row_course['course']."'>".$row_course['course_short_name']."</a></th>";} ?> 
                  <th>Total</th>  
                  <th>Average</th>
                  <th>Status</th>                
                </tr>
                </thead>
                <tbody>
                  <?php
                  $num = 1;
                   while($row = mysqli_fetch_array($stud)){
                  ?>
                <tr>
                  <td><?php echo $num; ?></td>
				          <td><?php echo $row['stud_id']?></td>
                  <td><?php echo $row['fname']." ".$row['mname'];?></td>
                  <?php $qry_res2 = mysqli_query($conn, "SELECT result_id, value FROM result WHERE stud_id = '".$row['stud_id']."' AND dep_id = '".$dep."' AND level_id = '".$level."'");
                       $qry_total_av = mysqli_query($conn, "SELECT *FROM total_average WHERE stud_id = '".$row['stud_id']."' AND level_id = '".$level."'");
                        while($row_val = mysqli_fetch_array($qry_res2)){
                        $status = mysqli_query($conn, "SELECT status FROM total_average WHERE stud_id = '".$row['stud_id']."' AND level_id = '".$level."'");
                        $row_stat = mysqli_fetch_array($status);
                        if($row_stat['status'] == 'Pending'){
                        	echo "<td><input type='number' onkeyup='this.value = minmaxvalidation(this, this.value)' min='0' max='100' name='value[]' style='border:0px; border-radius:0px; width:60px' value='".$row_val['value']."'><input type='hidden' name='result_id[]' value='".$row_val['result_id']."'></td>"; } else{ echo "<td><input type='number' name='value[]' style='border:0px; border-radius:0px; width:60px' value='".$row_val['value']."' readonly><input type='hidden' name='result_id[]' value='".$row_val['result_id']."'></td>"; } 
                        }
                        /*while(*/ $row_total = mysqli_fetch_array($qry_total_av); //){ 
                        	echo "<td><input type='number' name='total[]' style='border:0px; border-radius:0px; width:60px' value='".$row_total['total']."' readonly><input type='hidden' name='level_id' value='".$level."' readonly><input type='hidden' name='batch' value='".$batch."' readonly><input type='hidden' name='dep' value='".$dep."' readonly> </td><td><input type='number' name='average[]' style='border:0px; border-radius:0px; width:60px' value='".$row_total['average']."' readonly></td><td>"; if($row_total['status'] == 'Pending'){ echo "<input type='text' name='status[]' style='border:0px; border-radius:0px; width:70px; color:red;' value='".$row_total['status']."' readonly>"; } else{ echo "<input type='text' name='status[]' style='border:0px; border-radius:0px; width:70px; color:blue;' value='".$row_total['status']."' readonly>"; } echo "</td>"; //}?>
                </tr><?php $num++;
              } ?>
                </tbody>
                <tfoot>
                <tr>
                	<?php $qry_course = mysqli_query($conn, "SELECT course.course_id, course.course, course.course_short_name, result.result_id, result.course_id, result.stud_id, result.batch, result.dep_id, result.level_id FROM course JOIN result ON course.course_id = result.course_id AND result.dep_id = '".$dep."' AND result.level_id = '".$level."' AND result.batch = '".$batch."' GROUP BY result.course_id");
                	 ?>
                  <th>No</th>
				          <th>ID</th>
                  <th>Name</th>
                  <?php while($row_course = mysqli_fetch_array($qry_course)){ echo "<th><a href='#' title='".$row_course['course']."'>".$row_course['course_short_name']."</a></th>";} ?> 
                  <th>Total</th>  
                  <th>Average</th> 
                  <th>Status</th> 
                </tr>
                </tfoot>
              </table>
            <button class="btn btn-primary" name="save">Save</button> &nbsp; &nbsp;<a href="excel.php?level=<?php echo $level; ?>&batch=<?php echo $batch; ?>&dep=<?php echo $dep; ?>" class="btn btn-primary" name="excel" target="_blank">Generate Excel</a> </form>
			<?php }
		}

		if(isset($_GET['department']) && isset($_GET['stud_batch'])){
	    $department = $_GET['department'];
	    $stud_batch = $_GET['stud_batch'];
	    $arry_level = array();
	    $x = 0;
	    $y = 0;

			$qry_res = mysqli_query($conn, "SELECT *FROM department WHERE dep_id = '".$department."'") ?>

				<form action="result.php?manage-result" method="POST">
					<div style="border-radius: 0px; border:1px solid #e6ede7;">
						<br>
					<h2 style="font-family: roman; font-style: bold;"><center>Mirab Abaya Construction and Industrial College</center></h1>
					<h2 style="font-family: roman; font-style: bold;"><center>Office of Registrar</center></h2>
					<h3 style="font-family: roman; font-style: bold;"><center>Students' Grade</center></h3><br>

				   <?php $row_header = mysqli_fetch_array($qry_res); ?>

				   	 <h5 style="font-family: roman;">&nbsp;&nbsp;Department : <span class="text-danger"><?php echo $row_header["dep_name"]; ?></span> | Batch : <span class="text-danger"><?php echo $stud_batch; ?></span></h5></div>
				  <table class="table table-bordered example1">
                <thead>
                <tr>
                	<?php $qry_course = mysqli_query($conn, "SELECT level.level_id, level.level, result.batch, result.level_id, result.dep_id FROM level JOIN result ON level.level_id = result.level_id AND result.dep_id = '".$department."' AND result.batch = '".$stud_batch."' GROUP BY result.dep_id, result.level_id");
                	 ?>
                  <th>No</th>
				          <th>ID</th>
                  <th>Name</th>
                  <?php 

                  while($row_level = mysqli_fetch_array($qry_course)){ echo "<th>Level"." ".$row_level['level']."</th>"; $arry_level[$x] = $row_level['level_id']; $x++;} ?> 
                  <th>Action</th>                
                </tr>
                </thead>
                <tbody>
                  <?php

                  $qry_res2 = mysqli_query($conn, "SELECT student.stud_id, student.fname, student.mname, student.entry, student.dep, total_average.id, total_average.stud_id, total_average.level_id, total_average.total, total_average.average FROM student JOIN total_average ON student.stud_id = total_average.stud_id AND student.dep = '".$department."' AND student.entry = '".$stud_batch."' GROUP BY student.stud_id");
                  $num = 1;
                   while($row_stud = mysqli_fetch_array($qry_res2)){
                  ?>
                <tr>
                  <td><?php echo $num; ?></td>
				          <td><?php echo $row_stud['stud_id']?></td>
                  <td><?php echo $row_stud['fname']." ".$row_stud['mname'];?></td>
                  <?php 

                     for($i = 0; $i < count($arry_level); $i++){
                       $qry_total_av = mysqli_query($conn, "SELECT total, average FROM total_average WHERE stud_id = '".$row_stud['stud_id']."' AND level_id = '".$arry_level[$i]."'");
                        $row_val = mysqli_fetch_array($qry_total_av);

                           echo "<td><a href='#' title='Total = ".$row_val['total']."'>".$row_val['average']."</a></td>"; } 
                         ?>
                         <td><a href="excel.php?export_id=<?php echo $row_stud['stud_id'];?>&department_id=<?php echo $row_stud['dep'];?>&student_batch=<?php echo $stud_batch; ?>" class="btn btn-primary" target="_blank">Export PDF</a></td>
                </tr><?php $num++;
              } ?>
              <tfoot>
              	<tr>
                	<?php $qry_course = mysqli_query($conn, "SELECT level.level_id, level.level, result.batch, result.level_id, result.dep_id FROM level JOIN result ON level.level_id = result.level_id AND result.dep_id = '".$department."' AND result.batch = '".$stud_batch."' GROUP BY result.dep_id, result.level_id");
                	 ?>
                  <th>No</th>
				          <th>ID</th>
                  <th>Name</th>
                  <?php 

                  while($row_level = mysqli_fetch_array($qry_course)){ echo "<th>Level"." ".$row_level['level']."</th>"; } ?> 
                  <th>Action</th>                
                </tr>
              </tfoot>
                </tbody>
              </table>
            <a href="excel.php?all_export=<?php echo $department; ?>&stud_batch=<?php echo $stud_batch; ?>" class="btn btn-primary" target="_blank">Generate Excel</a> </form>
			<?php 
		}

		if(isset($_GET['assigned_course_exam'])){
	$id = $_GET['assigned_course_exam'];

	$qry_course = mysqli_query($conn, "SELECT DISTINCT exam_name, out_of FROM exam WHERE batch = (SELECT batch FROM offer_course WHERE offer_id = '".$_GET['assigned_course_exam']."') AND modality_id = (SELECT modality_id FROM offer_course WHERE offer_id = '".$_GET['assigned_course_exam']."') AND program_id = (SELECT program_id FROM offer_course WHERE offer_id = '".$_GET['assigned_course_exam']."') AND dep_id = (SELECT dep_id FROM offer_course WHERE offer_id = '".$_GET['assigned_course_exam']."') AND course_id = (SELECT course_id FROM offer_course WHERE offer_id = '".$_GET['assigned_course_exam']."')");
  if(mysqli_num_rows($qry_course) > 0){

  $stud = mysqli_query($conn, "SELECT student.stud_id, student.fname, student.mname, student.lname, student.entry, student.program, student.department, student.section, student.modality, course_enroll.enroll_id, course_enroll.stud_id, course_enroll.ay_id, course_enroll.semester_id, course_enroll.course_id, offer_course.offer_id, offer_course.dep_id, offer_course.ay_id, offer_course.semester_id, offer_course.batch, offer_course.modality_id, offer_course.section_id, offer_course.program_id, offer_course.course_id, offer_course.teach_id  FROM student JOIN course_enroll JOIN offer_course ON student.stud_id = course_enroll.stud_id AND student.entry = offer_course.batch AND offer_course.ay_id = course_enroll.ay_id AND student.program = offer_course.program_id AND student.department = offer_course.dep_id AND course_enroll.course_id = (SELECT course_id FROM offer_course WHERE offer_id = '$id') AND student.section = offer_course.section_id AND student.modality = offer_course.modality_id AND student.department = offer_course.dep_id AND offer_course.offer_id = '".$id."' ORDER BY student.fname, student.mname, student.lname");

  /*$stud = mysqli_query($conn, "SELECT stud_id, fname, mname, lname FROM student WHERE entry = (SELECT batch FROM offer_course WHERE offer_course_id = '$id') AND program_id = (SELECT program_id FROM offer_course WHERE offer_course_id = '$id') AND campus = (SELECT campus_id FROM offer_course WHERE offer_course_id = '$id') AND section = (SELECT section_id FROM offer_course WHERE offer_course_id = '$id')"); */


	$qry_header = mysqli_query($conn, "SELECT offer_course.offer_id, offer_course.dep_id, offer_course.ay_id, offer_course.batch, offer_course.modality_id, offer_course.section_id, offer_course.program_id, offer_course.course_id, offer_course.teach_id, semester.semester_id, semester.semester, semester.semester_word, modality.modality_id, modality.modality, section.section_id, section.section, program.program_id, program.program, course.course_id, course.course, department.dep_id, department.department AS 'dep_name' FROM offer_course JOIN semester JOIN modality JOIN section JOIN program JOIN course JOIN department ON offer_course.semester_id = semester.semester_id AND offer_course.modality_id = modality.modality_id AND offer_course.section_id = section.section_id AND offer_course.program_id = program.program_id AND offer_course.course_id = course.course_id AND offer_course.dep_id = department.dep_id AND offer_course.offer_id = '$id'");

	/*mysqli_query($conn, "SELECT offer_course.offer_id, offer_course.dep_id, offer_course.section_id, offer_course.program_id, offer_course.course_id, offer_course.semester_id, offer_course.modality_id, offer_course.batch, department.dep_id, department.department, modality.modality_id, modality.modality, section.section_id, section.section, program.program_id, program.program, course.course_id, course.course FROM offer_course JOIN department JOIN modality AND section JOIN program JOIN course ON offer_course.dep_id = department.dep_id AND offer_course.modality_id = modality.modality_id AND offer_course.section_id = section.section_id AND offer_course.program_id = program.program_id AND offer_course.course_id = course.course_id AND offer_course.offer_id = '$id'");*/
	$row_header = mysqli_fetch_array($qry_header);
	$semester = $row_header['semester_id'];
	$dep_id = $row_header['dep_id'];
	$course = "";
	$modality_id = $row_header['modality_id'];
	$program_id = $row_header['program_id'];
	$batch = $row_header['batch'];
	$ay_id = $row_header['ay_id'];

	echo "<br><hr><br><h6>Department : <span class='text-danger'>".$row_header['dep_name']."</span> | Program : <span class='text-danger'>".$row_header['program']." </span> | Modality : <span class='text-danger'>".$row_header['modality']."</span> | Section : <span class='text-danger'>".$row_header['section']."</span> | Batch : <span class='text-danger'>".$row_header['batch']."</span> | Course : <span class='text-danger'>".$row_header['course']."</span></h6>"; ?>
	           <table class="table table-bordered example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <?php while($row_course = mysqli_fetch_array($qry_course)){ echo "<th>".$row_course['exam_name']." ( ".$row_course['out_of']." % )</th>";} ?> 
                  <th>Total</th>  
                  <th>Grade</th>
                  <th>Status</th>                
                </tr>
                </thead>
                <tbody>
                	<?php
                  $num = 1;
                   while($row = mysqli_fetch_array($stud)){
                  ?>
                <tr>
                  <td><?php echo $num; ?></td>
                  <td><?php echo $row['fname']." ".$row['mname']." ".$row['lname']; ?></td>
                  <?php $qry_res2 = mysqli_query($conn, "SELECT exam_id, course_id, exam_name, out_of, value FROM exam WHERE stud_id = '".$row['stud_id']."' AND course_id = '".$row['course_id']."' ORDER BY ex_order");
                  $qry_total = mysqli_query($conn, "SELECT *FROM total WHERE stud_id = '".$row['stud_id']."' AND ay_id = '".$row['ay_id']."' AND course_id = '".$row['course_id']."' AND semester_id = '".$row['semester_id']."'");
                  while($row_val = mysqli_fetch_array($qry_res2)){
                  	$course_id = $row_val['course_id'];
                        	echo "<td><input type='number' name='value[]' id='value' style='border:0px; border-radius:0px; width:60px' value='".$row_val['value']."' readonly><input type='hidden' name='exam_id[]' id='exam_id' value='".$row_val['exam_id']."'></td>"; }

                        	$row_total = mysqli_fetch_array($qry_total); 
                        	echo "<td><input type='number' name='total[]' id='total' style='border:0px; border-radius:0px; width:60px' value='".$row_total['value']."' readonly><input type='hidden' name='ay_id' id='ay_id' value='".$row['ay_id']."' readonly><input type='hidden' name='course_id' id='course_id' value='".$row['course_id']."' readonly><input type='hidden' name='semester_id' id='semester_id' value='".$row['semester_id']."' readonly><input type='hidden' name='course_id' value='".$row['course_id']."' readonly><input type='hidden' name='offer_course' id='offer_course' value='".$id."' readonly><input type='hidden' name='dep_id' value='".$row['dep_id']."' readonly></td><td>";

                        	if($row_total["value"] >= 90 ){
                          	echo "<input type='text' value='A+' style='border:0px; border-radius:0px; width:60px' readonly>";
                          } else if($row_total["value"] >= 85 ){
                          	echo "<input type='text' value='A' style='border:0px; border-radius:0px; width:60px' readonly>";
                          } else if($row_total["value"] >= 80 ){
                          	echo "<input type='text' value='A-' style='border:0px; border-radius:0px; width:60px' readonly>";
                          } else if($row_total["value"] >= 75 ){
                          	echo "<input type='text' value='B+' style='border:0px; border-radius:0px; width:60px' readonly>";
                          } else if($row_total["value"] >= 70 ){
                          	echo "<input type='text' value='B' style='border:0px; border-radius:0px; width:60px' readonly>";
                          } else if($row_total["value"] >= 65 ){
                          	echo "<input type='text' value='B-' style='border:0px; border-radius:0px; width:60px' readonly>";
                          } else if($row_total["value"] >= 60 ){
                          	echo "<input type='text' value='C+' style='border:0px; border-radius:0px; width:60px' readonly>";
                          } else if($row_total["value"] >= 50 ){
                          	echo "<input type='text' value='C' style='border:0px; border-radius:0px; width:60px' readonly>";
                          } else if($row_total["value"] >= 45 ){
                          	echo "<input type='text' value='D' style='border:0px; border-radius:0px; width:60px' readonly>";
                          } else if(($row_total["value"]) < 45 && ($row_total["value"] != "")){
                          	echo "<input type='text' value='F' style='border:0px; border-radius:0px; width:60px' readonly>";
                          } else if($row_total["value"] == "" ){
                          	echo "<input type='text' value='' style='border:0px; border-radius:0px; width:60px' readonly>";
                          }

                        	echo "</td><td>".$row_total['status']."</td>"; 
                        $num++; } ?>
                </tr>
                </tbody>
              </table>
              <a href="excel.php?program_id=<?php echo $program_id; ?>&batch=<?php echo $batch; ?>&dep_id=<?php echo $dep_id; ?>&modality_id=<?php echo $modality_id; ?>&course_id=<?php echo $course_id; ?>&semester_id=<?php echo $semester; ?>&ay_id=<?php echo $ay_id; ?>&offer_id=<?php echo $id; ?>" class="btn btn-primary" name="excel" target="_blank">Generate Excel</a>


<?php } else{
	echo "<h5>Exam is not seted up for this course.<h5>";
} }


?>
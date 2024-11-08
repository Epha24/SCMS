<?php 
include 'conn.php';
session_start();

if(isset($_GET['approve-request-ex-id'])){

        $id = $_GET['approve-request-ex-id'];
        mysqli_query($conn, "UPDATE clearance SET exam_assessor_app = 'Approved' WHERE clearance_id = '$id'");
            header('Location:exam-assesment/request.php?approve-request');

  }
  if(isset($_GET['approve-request-stud-dean-id'])){

        $id = $_GET['approve-request-stud-dean-id'];
        mysqli_query($conn, "UPDATE clearance SET student_dean_app = 'Approved', student_dean_not = '0' WHERE clearance_id = '$id'");
            header('Location:student-dean/request.php?approve-request');

  }
  if(isset($_GET['approve-request-lib-id'])){

        $id = $_GET['approve-request-lib-id'];
        mysqli_query($conn, "UPDATE clearance SET librarian_app = 'Approved', librarian_not = '0' WHERE clearance_id = '$id'");
            header('Location:library/request.php?approve-request');

  }
  
  if(isset($_GET['approve-request-head-id'])){

        $id = $_GET['approve-request-head-id'];
        mysqli_query($conn, "UPDATE clearance SET dep_head_app = 'Approved', dep_head_not = '0' WHERE clearance_id = '$id'");
            header('Location:department-head/request.php?approve-request');

  }

  if(isset($_GET['approve-request-ex-id'])){

        $id = $_GET['approve-request-ex-id'];
        mysqli_query($conn, "UPDATE clearance SET exam_assessor_app = 'Approved', exam_assessor_not = '0' WHERE clearance_id = '$id'");
            header('Location:exam-assesment/request.php?approve-request');

  }

  if(isset($_GET['approve-request-finance-id'])){

        $id = $_GET['approve-request-finance-id'];
        mysqli_query($conn, "UPDATE clearance SET finance_app = 'Approved', finance_not = '0' WHERE clearance_id = '$id'");
            header('Location:finance/request.php?approve-request');

  }
  if(isset($_GET['approve-request-registrar-id'])){

        $id = $_GET['approve-request-registrar-id'];
        mysqli_query($conn, "UPDATE clearance SET registrar_app = 'Approved', registrar_not = '0' WHERE clearance_id = '$id'");
            header('Location:registrar/request.php?approve-request');

  }

  if(isset($_GET['approve-request-vice-dean-id'])){

        $id = $_GET['approve-request-vice-dean-id'];
        mysqli_query($conn, "UPDATE clearance SET vice_dean_app = 'Approved', vice_dean_not = '0' WHERE clearance_id = '$id'");
            header('Location:vice-dean/request.php?approve-request');

  }
  
  if(isset($_GET['approve-request-id'])){

        $id = $_GET['approve-request-id'];
        mysqli_query($conn, "UPDATE clearance SET dean_app = 'Approved', dean_not = '0' WHERE clearance_id = '$id'");
            header('Location:dean/request.php?approve-request');

  }
  if(isset($_GET['reject-request-ex'])){

        $id = $_GET['reject-request-ex'];
        mysqli_query($conn, "UPDATE clearance SET exam_assessor_app = 'Rejected' WHERE clearance_id = '$id'");
            header('Location:exam-assesment/request.php?approve-request');

  }
  if(isset($_GET['reject-request-finance'])){

        $id = $_GET['reject-request-finance'];
        mysqli_query($conn, "UPDATE clearance SET finance_app = 'Rejected' WHERE clearance_id = '$id'");
            header('Location:finance/request.php?approve-request');

  }
  if(isset($_GET['reject-request-library'])){

        $id = $_GET['reject-request-library'];
        mysqli_query($conn, "UPDATE clearance SET librarian_app = 'Rejected' WHERE clearance_id = '$id'");
            header('Location:library/request.php?approve-request');

  }
  if(isset($_GET['reject-request-registrar'])){

        $id = $_GET['reject-request-registrar'];
        mysqli_query($conn, "UPDATE clearance SET registrar_app = 'Rejected' WHERE clearance_id = '$id'");
            header('Location:registrar/request.php?approve-request');

  }
  if(isset($_GET['reject-request-dean'])){

        $id = $_GET['reject-request-dean'];
        mysqli_query($conn, "UPDATE clearance SET dean_app = 'Rejected' WHERE clearance_id = '$id'");
            header('Location:dean/request.php?approve-request');
  }
  if(isset($_GET['reject-request-head'])){

        $id = $_GET['reject-request-head'];
        mysqli_query($conn, "UPDATE clearance SET dep_head_app = 'Rejected' WHERE clearance_id = '$id'");
            header('Location:department-head/request.php?approve-request');
  }

if(isset($_GET['delete-account'])){
	$id = $_GET['delete-account'];
	mysqli_query($conn, "DELETE FROM user WHERE username = '$id'");
	$msg = '<div class="alert alert-danger"> Your Account has been disabled, please contact admin</div>';
	header('Location:admin/account.php?update_account');

}
if(isset($_GET['change-status'])){
	
	$active = 'Active';
	$Inactive = 'Inactive';
	$id = $_GET['change-status'];
	$qry = "SELECT *FROM user WHERE username = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			$qry_update = "UPDATE user SET status = '$Inactive' WHERE username = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/account.php?update_account');
		} if($row['status'] == $Inactive){
			$qry_update = "UPDATE user SET status = '$active' WHERE username = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/account.php?update_account');
		}
	}

}

if(isset($_GET['change-status-teacher'])){
	
	$active = 'Active';
	$Inactive = 'Inactive';
	$id = $_GET['change-status-teacher'];
	$qry = "SELECT *FROM teacher WHERE teach_id = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			$qry_update = "UPDATE teacher SET status = '$Inactive' WHERE teach_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:department-head/teacher.php?update-teacher');
		} if($row['status'] == $Inactive){
			$qry_update = "UPDATE teacher SET status = '$active' WHERE teach_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:department-head/teacher.php?update-teacher');
		}
	}

}

if(isset($_GET['change-status-dep-head']) && isset($_GET['dep'])){
	
	$active = 'Active';
	$Inactive = 'Inactive';
	$id = $_GET['change-status-dep-head'];
	$dep = $_GET['dep'];
	$qry = "SELECT *FROM dep_head WHERE dep_head_id = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			mysqli_query($conn, "UPDATE dep_head SET status = '$Inactive' WHERE dep_head_id = '$id'");
			header('Location:admin/department-head.php?update-department-head');
			mysqli_query($conn, "UPDATE user SET status = '$Inactive' WHERE type = 'department head' AND  user_name = (SELECT user_name FROM dep_head WHERE dep_head_id = '$id')");
		} 
		if($row['status'] == $Inactive){
			mysqli_query($conn, "UPDATE dep_head SET status = '$active' WHERE dep_head_id = '$id'");
			mysqli_query($conn, "UPDATE user SET status = '$active' WHERE type = 'department head' AND  user_name = (SELECT user_name FROM dep_head WHERE dep_head_id = '$id')");
			mysqli_query($conn, "UPDATE dep_head SET status = '$Inactive' WHERE dep_head_id != '$id' AND department = '$dep'");
			mysqli_query($conn, "UPDATE user SET status = '$Inactive' WHERE type = 'department head' AND  user_name != (SELECT user_name FROM dep_head WHERE dep_head_id = '$id')");
			header('Location:admin/department-head.php?update-department-head');
		}
	}

}

if(isset($_GET['change-status-avd'])){
	
	$active = 'Active';
	$Inactive = 'Inactive';
	$id = $_GET['change-status-avd'];
	$dep = $_GET['dep'];
	$qry = "SELECT *FROM academic_vice_dean WHERE avd_id = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			mysqli_query($conn, "UPDATE academic_vice_dean SET status = '$Inactive' WHERE avd_id = '$id'");
			header('Location:admin/academic-vice-dean.php?update-academic-vice-dean');
		} 
		if($row['status'] == $Inactive){
			mysqli_query($conn, "UPDATE academic_vice_dean SET status = '$active' WHERE avd_id = '$id'");
			mysqli_query($conn, "UPDATE user SET status = '$active' WHERE user_name = (SELECT user_name FROM academic_vice_dean WHERE avd_id = '$id')");
			mysqli_query($conn, "UPDATE academic_vice_dean SET status = '$Inactive' WHERE avd_id != '$id'");
			header('Location:admin/academic-vice-dean.php?update-academic-vice-dean');
			mysqli_query($conn, "UPDATE user SET status = '$Inactive' WHERE type = 'academic vice dean' AND user_name !=(SELECT user_name FROM academic_vice_dean WHERE avd_id = '$id')");
			header('Location:admin/academic-vice-dean.php?update-academic-vice-dean');
		}
	}

}

if(isset($_GET['change-status-ayear'])){
	
	$active = 'Pending...';
	$Inactive = 'Locked';
	$id = $_GET['change-status-ayear'];
	$qry = "SELECT *FROM academic_year WHERE ay_id = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			$qry_update = "UPDATE academic_year SET status = '$Inactive' WHERE ay_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/academic-year.php?update-academic-year');
		} if($row['status'] == $Inactive){
			$qry_update = "UPDATE academic_year SET status = '$active' WHERE ay_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/academic-year.php?update-academic-year');
		}
	}

}

if(isset($_GET['change-status-section'])){
	
	$active = 'Pending...';
	$Inactive = 'Locked';
	$id = $_GET['change-status-section'];
	$qry = "SELECT *FROM section WHERE section_id = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			$qry_update = "UPDATE section SET status = '$Inactive' WHERE section_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/section.php?update-section');
		} if($row['status'] == $Inactive){
			$qry_update = "UPDATE section SET status = '$active' WHERE section_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/section.php?update-section');
		}
	}

}

if(isset($_GET['change-status-mapping'])){
	
	$active = 'Pending...';
	$Inactive = 'Locked';
	$id = $_GET['change-status-mapping'];
	$qry = "SELECT *FROM course_department WHERE cd_id = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			$qry_update = "UPDATE course_department SET status = '$Inactive' WHERE cd_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/mapping.php?update-mapping');
		} if($row['status'] == $Inactive){
			$qry_update = "UPDATE course_department SET status = '$active' WHERE cd_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/mapping.php?update-mapping');
		}
	}

}

if(isset($_GET['change-status-course'])){
	
	$active = 'Pending...';
	$Inactive = 'Locked';
	$id = $_GET['change-status-course'];
	$qry = "SELECT *FROM course WHERE course_id = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			$qry_update = "UPDATE course SET status = '$Inactive' WHERE course_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/course.php?update-course');
		} if($row['status'] == $Inactive){
			$qry_update = "UPDATE course SET status = '$active' WHERE course_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/course.php?update-course');
		}
	}

}

if(isset($_GET['change-status-program'])){
	
	$active = 'Pending...';
	$Inactive = 'Locked';
	$id = $_GET['change-status-program'];
	$qry = "SELECT *FROM program WHERE program_id = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			$qry_update = "UPDATE program SET status = '$Inactive' WHERE program_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/program.php?update-program');
		} if($row['status'] == $Inactive){
			$qry_update = "UPDATE program SET status = '$active' WHERE program_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/program.php?update-program');
		}
	}

}

if(isset($_GET['change-status-stud'])){
	
	$active = 'Active';
	$Inactive = 'Inactive';
	$id = $_GET['change-status-stud'];
	$qry = "SELECT *FROM student WHERE stud_id = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			$qry_update = "UPDATE student SET status = '$Inactive' WHERE stud_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:registrar/student.php?update-student');
		} if($row['status'] == $Inactive){
			$qry_update = "UPDATE student SET status = '$active' WHERE stud_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:registrar/student.php?update-student');
		}
	}

}
if(isset($_GET['change-status-modality'])){
	
	$active = 'Pending...';
	$Inactive = 'Locked';
	$id = $_GET['change-status-modality'];
	$qry = "SELECT *FROM modality WHERE modality_id = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			$qry_update = "UPDATE modality SET status = '$Inactive' WHERE modality_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/modality.php?update-modality');
		} if($row['status'] == $Inactive){
			$qry_update = "UPDATE modality SET status = '$active' WHERE modality_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/modality.php?update-modality');
		}
	}

}
if(isset($_GET['change-status-dep'])){
	
	$active = 'Pending...';
	$Inactive = 'Locked';
	$id = $_GET['change-status-dep'];
	$qry = "SELECT *FROM department WHERE dep_id = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			$qry_update = "UPDATE department SET status = '$Inactive' WHERE dep_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/department.php?update-department');
		} if($row['status'] == $Inactive){
			$qry_update = "UPDATE department SET status = '$active' WHERE dep_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/department.php?update-department');
		}
	}

}
if(isset($_GET['delete-year'])){
	$id = $_GET['delete-year'];
	mysqli_query($conn, "DELETE FROM academic_year WHERE ay_id = '$id'");
	header('Location:admin/academic-year.php?update-academic-year');

}
if(isset($_GET['delete-department'])){
	$id = $_GET['delete-department'];
	mysqli_query($conn, "DELETE FROM department WHERE dep_id = '$id'");
	header('Location:admin/department.php?update-department');

}
if(isset($_GET['delete-modality'])){
	$id = $_GET['delete-modality'];
	mysqli_query($conn, "DELETE FROM modality WHERE modality_id = '$id'");
	header('Location:admin/modality.php?update-modality');

}

if(isset($_GET['delete-program'])){
	$id = $_GET['delete-program'];
	mysqli_query($conn, "DELETE FROM program WHERE program_id = '$id'");
	header('Location:admin/program.php?update-program');

}
if(isset($_GET['de_active'])){
	$id = $_GET['de_active'];
	$act = "active";
	mysqli_query($conn, "UPDATE user SET active = '$act' WHERE  id = '$id' AND role != 'admin'");
	header('Location:delete_account.php');

}
if(isset($_GET['delete-course'])){
	$id = $_GET['delete-course'];
	mysqli_query($conn, "DELETE FROM course WHERE course_id = '$id'");
	header('Location:admin/course.php?update-course');

}
if(isset($_GET['delete-section'])){
	$id = $_GET['delete-section'];
	mysqli_query($conn, "DELETE FROM section WHERE section_id = '$id'");
	header('Location:admin/section.php?update-section');

}
if(isset($_GET['delete-mapping'])){
	$id = $_GET['delete-mapping'];
	mysqli_query($conn, "DELETE FROM course_department WHERE cd_id = '$id'");
	header('Location:admin/mapping.php?update-mapping');

}
if(isset($_GET['delete-owner-association'])){
	$id = $_GET['delete-owner-association'];
	mysqli_query($conn, "DELETE FROM owner_association WHERE op_id = '$id'");
	header('Location:employee/association.php?edit-owner-association');

}

if(isset($_GET['delete-driver'])){
	$id = $_GET['delete-driver'];
	mysqli_query($conn, "DELETE FROM driver WHERE id = '$id'");
	header('Location:employee/driver.php?update-driver');

}
if(isset($_GET['delete-comment'])){
	$id = $_GET['delete-comment'];
	mysqli_query($conn, "DELETE FROM contact_us WHERE id = '$id'");
	header('Location:admin/comment.php');

}
if(isset($_GET['delete-mapping'])){
	$id = $_GET['delete-mapping'];
	mysqli_query($conn, "DELETE FROM class_course WHERE class_course_id = '$id'");
	header('Location:admin/mapping.php?update-mapping');

}
?>
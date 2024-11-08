<?php

session_start();
include '../security.php';
include'user.php';
include '../conn.php';
$msg = "";

 if($_SESSION['role'] != 'registrar'){
     header("Location:../logout.php");
 }

 if(isset($_POST['add_stud'])){
    $id = mysqli_escape_string($conn,$_POST['id']);
    $fname =  mysqli_escape_string($conn, $_POST['fname']);
    $mname = mysqli_escape_string($conn,$_POST['mname']);
    $lname = mysqli_escape_string($conn,$_POST['lname']);
    $sex = $_POST['sex'];
    $age = mysqli_escape_string($conn,$_POST['age']);
    $modality = $_POST['modality'];
    $program = $_POST['program'];
    $department = $_POST['department'];
	  $entry = mysqli_escape_string($conn,$_POST['entry']);
    $user_name = mysqli_escape_string($conn,$_POST['id']);
    $password = md5("pass@123");

    $qry_check = mysqli_query($conn, "SELECT *FROM student WHERE stud_id = '".$id."'");
    if(mysqli_num_rows($qry_check) > 0){
      $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Student Already Exists !!!</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
    }else{

    $qry = mysqli_query($conn,"INSERT INTO student(stud_id, fname, mname, lname, sex, age, modality, department, entry, program, user_name) VALUES('$id', '$fname', '$mname', '$lname', '$sex', '$age', '$modality', '$department', '$entry', '$program', '$user_name')");
    if($qry){

      mysqli_query($conn, "INSERT INTO user(username, password, role) VALUES('$user_name', '$password', 'student')");
     $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                               <strong><center>New Student Added Successfilly</center></strong>
                                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                               <span aria-hidden='true'>&times;</span>
                            </button></div>";
    }else{
         $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Not Added !!!</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
    }
  }
}

  if(isset($_POST['update_stud'])){
              $id = $_POST['id'];
              $fname = $_POST['fname'];
              $mname = $_POST['mname'];
              $lname = $_POST['lname'];
              $sex = $_POST['sex'];
              $age = $_POST['age'];
              $entry = $_POST['entry'];
			        $program = $_POST['program'];
              $modality = $_POST['modality'];
              $department = $_POST['department'];
			        $stud_old_id = $_POST['stud_old_id'];

              $qry_check = mysqli_query($conn, "SELECT username FROM user WHERE username = '$stud_old_id' AND edited = 'NO'");
                  if(mysqli_num_rows($qry_check) > 0){
                  
                  mysqli_query($conn, "UPDATE user SET username = '$id' WHERE username = '$stud_old_id'");
                  $upqry = "UPDATE student SET stud_id = '$id', fname = '$fname', mname = '$mname', lname = '$lname', sex = '$sex', age = '$age', entry = '$entry', program = '$program', department = '$department', modality = '$modality', user_name = '$id' WHERE stud_id = '$stud_old_id'";
                  $upext = mysqli_query($conn,$upqry);
                  if($upext){
                    $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                               <strong><center>Successfully updated</center></strong>
                                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                               <span aria-hidden='true'>&times;</span>
                            </button></div>";
                  }else{
                    $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                               <strong><center>Not updated</center></strong>
                                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                               <span aria-hidden='true'>&times;</span>
                            </button></div>";
                  }
              }else{
                       
                  $upqry = "UPDATE student SET stud_id = '$id', fname = '$fname', mname = '$mname', lname = '$lname', sex = '$sex', age = '$age', entry = '$entry', program = '$program', modality = '$modality', department = '$department' WHERE stud_id = '$stud_old_id'";
                  $upext = mysqli_query($conn,$upqry);
                  if($upext){
                    $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                               <strong><center>Successfully updated</center></strong>
                                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                               <span aria-hidden='true'>&times;</span>
                            </button></div>";
                  }else{
                    $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                               <strong><center>Not updated</center></strong>
                                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                               <span aria-hidden='true'>&times;</span>
                            </button></div>";
                  }

              }
            }


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrar | STBC Student Clearance Management System</title>
  <link rel="icon" type="image/icon" href="../pic/logo.jpg">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTable -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<style>
    .form-control, .card, .mn{
      border-radius: 0px;
    }
    .active{
      border-radius: 0px;
      background-color: #00151A;
      border-left: 2px solid orange;
    }
    #act{
      border-radius: 0px;
      background-color: #00151A;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <?php $qry_select = "SELECT *FROM clearance WHERE registrar_not = '1' AND finance_app = 'Approved'";
                            $ext_select = mysqli_query($conn,$qry_select);
                            $num = mysqli_num_rows($ext_select);
                             if($num > 0){ ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?php echo $num; ?></span>
        
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="report.php?inbox" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?php echo $num; ?> new request
          </a>
        </div>
      </li>
      <?php } ?>
      <li class="dropdown user user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><img src="../pic/user.PNG" class="user-image" alt="User Image"></span></a>
          <ul class="dropdown-menu">
            <li class="user-header bg-info">
              <img src="../pic/user.PNG" class="img-circle" alt="User Image">
              <p><span id="user"><?php echo user(); ?></span> - Registrar</p>
            </li>
            <li class="user-body">
              <div class="row">
                <div class="pull-left">
                <a href="chpassword.php" class="btn btn-default btn-flat">Change Password</a>
              </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <div class="pull-right"> 
                <a href="../logout.php" class="btn btn-default btn-flat">Logout</a>
              </div>
              </div>
            </li>
          </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

   <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link" title="Student Clearance Management System">
      &nbsp;<span class="brand-text font-weight-light"> SCMS - STBC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="profile.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview active">
            <a href="#" class="nav-link" id="act">
              <i class="nav-icon fa fa-th-list"></i>
              <p>
                Manage Student
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="student.php?add-student" class="nav-link">
                  &nbsp;&nbsp;
                  <i class="nav-icon fa fa-plus"></i>
                  <p>Add Student</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="student.php?update-student" class="nav-link">
                  &nbsp;&nbsp;
                  <i class="nav-icon fas fa-edit"></i>
                  <p>Update Student</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <?php $qry_select = "SELECT *FROM clearance WHERE registrar_not = '1' AND finance_app = 'Approved'";
                            $ext_select = mysqli_query($conn,$qry_select);
                            $num = mysqli_num_rows($ext_select);
                             if($num > 0){ ?>
            <a href="request.php?approve-request" class="nav-link">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Requests <?php echo "<span class='text-danger'> ( ".$num." ) </span>"; ?>
              </p>
            </a>
          <?php } else { ?>
              <a href="request.php?approve-request" class="nav-link">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Requests
              </p>
            </a>
          <?php } ?>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if(isset($_GET['add-student'])){;?>
      <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a>  /  <a href="#" style="cursor: unset;">Manage Student</a> / <a href="#" style="cursor: unset;">Add Student</a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        </div>
        </div> 
        <div class="row"> 
        <div class="col-md-3">
            <a href="student.php?add-student" class="btn btn-info btn-block mb-3 mn"><i class="fas fa-plus"></i> Add Student</a>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Student</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item active">
                    <a href="student.php?add-student" class="nav-link">
                      <i class="fas fa-plus"></i> Add Student
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="student.php?update-student" class="nav-link">
                      <i class="far fa-edit"></i> Update Student
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </div> 
        <div class="col-md-9">
          <?=$msg;?>
	      <form role="form" action="student.php?add-student" method="POST">
        <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Add New Student</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                 <!--  <?=$msg ?> -->
                 <div class="form-row">
                  <div class="form-group col-sm-4">
                    <label>Student's ID :</label>
                    <input type="text" class="form-control" name="id" id="stud_id" placeholder="Enter Student ID" onkeyup="id_check()" required>
                    <span id="error_id" class="text-danger"></span>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>First Name :</label>
                    <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Middle Name :</label>
                    <input type="text" class="form-control" name="mname" placeholder="Enter Middle Name" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Last Name :</label>
                    <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Gender :</label>
                    <select name="sex" class="form-control">
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Age :</label>
                    <input type="number" class="form-control" name="age" placeholder="Enter Age" required>
                  </div>
				          <div class="form-group col-sm-4">
                    <label>Entry :</label>
                    <input type="text" class="form-control" name="entry" placeholder="Enter Entry" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Modality :</label>
                    <select name="modality" class="form-control">
                      <?php $qry_modality = mysqli_query($conn, "SELECT *FROM modality ORDER BY modality");
                          while($row_mod = mysqli_fetch_array($qry_modality)){
                              echo "<option value=".$row_mod['modality_id'].">".$row_mod['modality']."</option>"; } ?>
                    </select>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Department :</label>
                    <select name="department" class="form-control">
                      <?php $qry_campus = mysqli_query($conn, "SELECT *FROM department ORDER BY department");
                          while($row_campus = mysqli_fetch_array($qry_campus)){
                              echo "<option value=".$row_campus['dep_id'].">".$row_campus['department']."</option>"; } ?>
                    </select>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Program :</label>
                    <select name="program" class="form-control">
                      <?php $qry_section = mysqli_query($conn, "SELECT *FROM program ORDER BY program");
                          while($row_section = mysqli_fetch_array($qry_section)){
                              echo "<option value=".$row_section['program_id'].">".$row_section['program']."</option>"; } ?>
                    </select>
                  </div>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="add_stud" class="btn btn-primary mn">Add</button>
                </div>
            </div>
			</form>
          </div>
        </div>
      <?php } 
      if(isset($_GET['update-student'])){;?>
         <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a> / <a href="#" style="cursor: unset;">Manage Student</a>  / <a href="#" style="cursor: unset;">Update Student</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <?=$msg;?>
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title">Update Student</h3>
              <a href="student.php?add-student" class="float-sm-right" title="Add New Student"><i class="fa fa-plus"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Entry</th>
                  <th>Program</th>
                  <th>Department</th>
                  <th>Modality</th>
                  <th>Status</th>
                  <th>Action</th>                  
                </tr>
                </thead>
                <tbody>
                  <?php
                   $qry = "SELECT student.stud_id, student.fname, student.mname, student.lname, student.sex, student.age, student.entry, student.program, student.modality, student.status, program.program_id, program.program AS 'program_name', modality.modality_id, modality.modality AS 'modality_name', department.dep_id, department.department AS 'dep_name' FROM student JOIN program JOIN modality JOIN department ON student.program = program.program_id AND student.modality = modality.modality_id AND student.department = department.dep_id ORDER BY student.fname, student.mname, student.lname ASC";
                   $ext = mysqli_query($conn,$qry);

                   while($row = mysqli_fetch_array($ext)){
                  ?>
                <tr>
                  <td><?php echo $row['stud_id']; ?></td>
                  <td><?php echo $row['fname']." ".$row['mname']." ".$row['lname'];?></td>
                  <td><?php echo $row['entry']?></td>
                  <td><?php echo $row['program_name']?></td>
                  <td><?php echo $row['dep_name']?></td>
                  <td><?php echo $row['modality_name']?></td>
                  <td><?php if($row['status'] == "Inactive"){echo "<span class='text-danger'>".$row['status']."</span>";}else{echo "<span class='text-success'>".$row['status']."</span>";}?></td>
                 <td><a href="student.php?update-detail=<?php echo $row['stud_id']; ?>&program=<?php echo $row['program_id']; ?>&modality=<?php echo $row['modality_id']; ?>&department=<?php echo $row['dep_id']; ?>"><i class="fa fa-edit" style="color: blue;" title="Update Student"></i></a> &nbsp;| &nbsp; <a href="../action.php?change-status-stud=<?php echo $row['stud_id'] ?>" onclick="return confirm('Are you sure you want to change student status?')"><i class="fa fa-ban" style="color: orange;" title="Change student status"></i></a> &nbsp;| &nbsp; <a href="student.php?profile=<?php echo $row['stud_id']; ?>"><i class="fa fa-eye" style="color: blue;" title="View Profile"></i></a></td>
                </tr><?php
              }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Entry</th>
                  <th>Program</th>
                  <th>Department</th>
                  <th>Modality</th>
                  <th>Status</th>
                  <th>Action</th>  
                </tr>
                </tfoot>
              </table>
              <button onclick="window.print();" class="btn btn-primary">Print</button> &nbsp;&nbsp;<a href="pdf.php?all-student" target="_blank" class="btn btn-primary">Generate Pdf</a>
            </div>
        </div>
      <?php } if(isset($_GET['update-detail'])){

        $_SESSION['id'] = $_GET['update-detail'];
        $id = $_SESSION['id'] ;
        ?>
      <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a> / <a href="#" style="cursor: unset;">Manage Student </a> / <a href="#" style="cursor: unset;">Update Student</a>  /  <a href="#" style="cursor: unset;">Update Detail </a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        </div>
        </div> 
          <?=$msg;?>
	<form role="form" action="student.php?update-student" method="POST">	  
        <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Update Detail</h3>
                <a href="student.php?update-student" class="float-sm-right" title="Update Account"><i class="fa fa-edit"></i></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                 <!--  <?=$msg ?> -->
                 <div class="form-row">
                  <input type="hidden" name="stud_old_id" value="<?php echo $_GET['update-detail']?>">

                  <?php
                    $qry = "SELECT *FROM student WHERE stud_id = '$id'";
                    $ext = mysqli_query($conn,$qry);
                    while($row = mysqli_fetch_array($ext)){
                  ?>
                  <div class="form-group col-sm-4">
                    <label>Student ID :</label>
                    <input type="text" class="form-control" value="<?php echo $row['stud_id']?>" name="id" placeholder="Enter Student ID" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>First Name :</label>
                    <input type="text" class="form-control" value="<?php echo $row['fname']?>" name="fname" placeholder="Enter First Name" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Middle Name :</label>
                    <input type="text" class="form-control" value="<?php echo $row['mname']?>" name="mname" placeholder="Enter Middle Name" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Last Name :</label>
                    <input type="text" class="form-control" value="<?php echo $row['lname']?>" name="lname" placeholder="Enter Last Name" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Gender : </label>
                    <select name="sex" class="form-control">
                      <?php if($row['sex'] == 'Male'){ ?><option selected="selected">Male</option> <?php } else{ ?><option>Male</option> <?php }?>
                      <?php if($row['sex'] == 'Female'){ ?><option selected="selected">Female</option> <?php } else{ ?><option>Female</option> <?php }?>
                    </select>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Age :</label>
                    <input type="number" class="form-control" value="<?php echo $row['age']?>" name="age" placeholder="Enter Age" required>
                  </div>
                   <div class="form-group col-sm-4">
                    <label>Entry :</label>
                    <input type="text" class="form-control" value="<?php echo $row['entry']?>" name="entry" placeholder="Enter Entry" required>
                  </div>
				          <div class="form-group col-sm-4">
                    <label>Program :</label>
                    <select name="program" class="form-control">
                      <?php $qry_program = mysqli_query($conn, "SELECT *FROM program ORDER BY program");
                          while($row_program = mysqli_fetch_array($qry_program)){
                            if($row_program['program_id'] == $_GET['program']){
                              echo "<option value=".$row_program['program_id']." selected='selected'>".$row_program['program']."</option>"; } else{
                                echo "<option value=".$row_program['program_id'].">".$row_program['program']."</option>";
                              } } ?>
                    </select>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Modality :</label>
                    <select name="modality" class="form-control">
                      <?php $qry_modality = mysqli_query($conn, "SELECT *FROM modality ORDER BY modality");
                          while($row_modality = mysqli_fetch_array($qry_modality)){
                            if($row_modality['modality_id'] == $_GET['modality']){
                              echo "<option value=".$row_modality['modality_id']." selected='selected'>".$row_modality['modality']."</option>"; } else{
                                echo "<option value=".$row_modality['modality_id'].">".$row_modality['modality']."</option>";
                              } } ?>
                    </select>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Department :</label>
                    <select name="department" class="form-control">
                      <?php $qry_dep = mysqli_query($conn, "SELECT *FROM department ORDER BY department");
                          while($row_dep = mysqli_fetch_array($qry_dep)){
                            if($row_dep['dep_id'] == $_GET['department']){
                              echo "<option value=".$row_dep['dep_id']." selected='selected'>".$row_dep['department']."</option>"; } else{
                                echo "<option value=".$row_dep['dep_id'].">".$row_dep['department']."</option>";
                              } } ?>
                    </select>
                  </div>
                </div>              
                  <?php }?>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="update_stud" class="btn btn-primary mn">Update</button>
                </div>        
            </div>
			</form>
      <?php } if(isset($_GET['profile'])){
              $campus = "";
              $section = "";

       ?>

     <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a> / <a href="#" style="cursor: unset;">Manage Student </a> / <a href="#" style="cursor: unset;">Update Student</a>  /  <a href="#" style="cursor: unset;">View Student Profile </a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        </div>
        </div>
         <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Student Profile</h3>
                <a href="student.php?update-student" class="float-sm-right" title="Update Account"><i class="fa fa-edit"></i></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                       <?php
                             $sql = mysqli_query($conn, "SELECT student.stud_id, student.fname, student.mname, student.lname, student.sex, student.age, student.entry, student.program, student.modality, student.status, program.program_id, program.program AS 'program_name', modality.modality_id, modality.modality AS 'modality_name', department.dep_id, department.department AS 'dep_name' FROM student JOIN program JOIN modality JOIN department ON student.program = program.program_id AND student.modality = modality.modality_id AND student.department = department.dep_id AND student.stud_id = '".$_GET['profile']."'");
                              while($row = mysqli_fetch_array($sql)){
                                echo "<h6>ID : <span class='text-success'> ".$row['stud_id']."</span></h6>";
                                echo "<h6>Name : <span class='text-success'> ".$row['fname']." ".$row['mname']." ".$row['lname']."</span></h6>";
                                echo "<h6>Gender : <span class='text-success'> ".$row['sex']."</span></h6>";
                                echo "<h6>Age : <span class='text-success'> ".$row['age']."</span></h6>";
                                echo "<h6>Entry : <span class='text-success'> ".$row['entry']."</span></h6>";
                                echo "<h6>Program : <span class='text-success'> ".$row['program_name']."</span></h6>";
                                echo "<h6>Department : <span class='text-success'> ".$row['dep_name']."</span></h6>";
                                echo "<h6>Modality : <span class='text-success'> ".$row['modality_name']."</span></h6>";
                                $program = $row['program_id'];
                                $modality = $row['modality_id'];
                                $department = $row['dep_id'];
                              }
                        ?>        
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="student.php?update-detail=<?php echo $_GET['profile']; ?>&program=<?php echo $program; ?>&modality=<?php echo $modality; ?>&department=<?php echo $department; ?>" class="btn btn-primary">Update</a>&nbsp;&nbsp;<a href="pdf.php?stud-id=<?php echo $_GET['profile']; ?>" target="_blank" class="btn btn-primary">Generate Pdf</a>
                </div>        
            </div>
      <?php } ?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="index.php">STBC Student Clearance Management System</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Developers</b>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- DataTables -->
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
</body>
</html>
<script type="text/javascript">
$(function () {
    $(".example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
  </script>
  <script>
  $(document).ready(function(){
    $('a').tooltip();
  });

function id_check(){
     var xmlhttp = new XMLHttpRequest();
     var stud_check_id = document.getElementById("stud_id").value;
     xmlhttp.open("GET","select.php?stud_check_id="+stud_check_id,false);     
     xmlhttp.send(null);
     document.getElementById("error_id").innerHTML = xmlhttp.responseText;
}
function select_student(){
     var xmlhttp = new XMLHttpRequest();
     var entry = document.getElementById("entry").value;
     var section = document.getElementById("section").value;
     var program = document.getElementById("program").value;
     var modality = document.getElementById("modality").value;
     var department = document.getElementById("department").value;
     xmlhttp.open("GET","select.php?entry="+entry+"&section="+section+"&program="+program+"&modality="+modality+"&department="+department,false); xmlhttp.send(null);
     document.getElementById("student").innerHTML = xmlhttp.responseText;
}

function select_class(){

     var xmlhttp = new XMLHttpRequest();
     var student_id = document.getElementById("student").value;
     xmlhttp.open("GET","select.php?student_id="+student_id,false);     
     xmlhttp.send(null);
     document.getElementById("class").innerHTML = xmlhttp.responseText;
}

function select_course(){

     var xmlhttp = new XMLHttpRequest();
     var course_dep = document.getElementById("department").value;
     xmlhttp.open("GET","select.php?course_dep="+course_dep,false);     
     xmlhttp.send(null);
     document.getElementById("course").innerHTML = xmlhttp.responseText;
}

function class_sel(){

     var xmlhttp = new XMLHttpRequest();
     var student_id2 = document.getElementById("student").value;
     var class_stud_id = document.getElementById("class").value;
     xmlhttp.open("GET","select.php?student_id2="+student_id2+"&class_stud_id="+class_stud_id,false);     
     xmlhttp.send(null);
     document.getElementById("error_class").innerHTML = xmlhttp.responseText;
}
</script>
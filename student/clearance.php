<?php

session_start();
include '../security.php';
include '../conn.php';
include 'user.php';
$fname_error = "";
$mname_error = "";
$lname_error = "";
$city_error = "";
$phone_error = "";
$num_error = 0;
$msg = "";

if($_SESSION['role'] != 'student'){
    header("Location:../logout.php");
}


if(isset($_POST['sub'])){
  
  $reason = $_POST['reason'];
  $req_user = $_SESSION['user_name'];
  $req_date = date('Y-m-d');


  $qry_insert = mysqli_query($conn, "INSERT INTO clearance(req_user, re_date,reason) VALUES('$req_user','$req_date', '$reason')");
  if($qry_insert){
                 $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Requested successfully</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
              }else{
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Not Requested !!!</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
              }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Student | STBC Student Clearance Management System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
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
      <li class="dropdown user user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><img src="../pic/user.PNG" class="user-image" alt="User Image"></span></a>
          <ul class="dropdown-menu">
            <li class="user-header bg-info">
              <img src="../pic/user.PNG" class="img-circle" alt="User Image">
              <p><span id="user"><?php echo user(); ?></span> - Student</p>
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
          <!-- <li class="nav-item has-treeview">
            <a href="comment.php" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Give Comment
              </p>
            </a>
          </li> -->
          <li class="nav-item has-treeview active">
            <a href="clearance.php" class="nav-link" id="act">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Request Clearance
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
  <section class="content">
    <?php if(!isset($_GET['requested-list']) && !isset($_GET['clearance-detail'])) { ?>
   <div class="container-fluid">  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a> / <a href="#" style="cursor: unset;">Request Clearance</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
                <div class="row"> 
        <div class="col-md-3">
            <a href="clearance.php" class="btn btn-info btn-block mb-3 mn"><i class="fas fa-inbox"></i> Request Clearance</a>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Request</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item active">
                    <a href="clearance.php" class="nav-link">
                      <i class="fas fa-inbox"></i> Request Clearance
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="clearance.php?requested-list" class="nav-link">
                      <i class="fa fa-th-list"></i> Requested List
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </div> 
        <div class="col-md-9">
        <?=$msg;?>
        <form role="form" action="clearance.php" method="POST">
        <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Request Clearance</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                       <?php
                             $sql = mysqli_query($conn, "SELECT student.stud_id, student.fname, student.mname, student.lname, student.sex, student.age, student.entry, student.program, student.modality, student.status, program.program_id, program.program AS 'program_name', modality.modality_id, modality.modality AS 'modality_name', department.dep_id, department.department AS 'dep_name' FROM student JOIN program JOIN modality JOIN department ON student.program = program.program_id AND student.modality = modality.modality_id AND student.department = department.dep_id AND student.user_name = '".$_SESSION['user_name']."'");
                              while($row = mysqli_fetch_array($sql)){
                                echo "<div class='row'><div class='col-sm-4'><h6>ID : <u><span class='text-success'> ".$row['stud_id']."</span></u></h6></div>";
                                echo "<div class='col-sm-4'><h6>Name : <u><span class='text-success'> ".$row['fname']." ".$row['mname']." ".$row['lname']."</span></h6></u></div>";
                                echo "<div class='col-sm-4'><h6>Gender : <u><span class='text-success'> ".$row['sex']."</span></u></h6></div></div>";
                                echo "<div class='row'><div class='col-sm-4'><h6>Age : <u><span class='text-success'> ".$row['age']."</span></u></h6></div>";
                                echo "<div class='col-sm-4'><h6>Entry : <u><span class='text-success'> ".$row['entry']."</span></u></h6></div>";
                                echo "<div class='col-sm-4'><h6>Program : <u><span class='text-success'> ".$row['program_name']."</span></u></h6></div></div>";
                                echo "<div class='row'><div class='col-sm-4'><h6>Department : <u><span class='text-success'> ".$row['dep_name']."</span></u></h6></div>";
                                echo "<div class='col-sm-4'><h6>Modality : <u><span class='text-success'> ".$row['modality_name']."</span></u></h6></div></div><label>Clearance Reason :</label>
                                  <input type='text' class='form-control' name='reason'  placeholder='Enter Clearance Reason' required>";
                                $program = $row['program_id'];
                                $modality = $row['modality_id'];
                                $department = $row['dep_id'];
                              }
                        ?>        
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" class="btn btn-danger" name="sub">
                  <!-- <a href="pdf.php?stud-id=<?php echo $_GET['profile']; ?>" target="_blank" class="btn btn-primary">Generate Pdf</a> -->
                </div>        
            </div>
          </form>
          </div>
      </div><!-- /.container-fluid -->
    <?php } 
      if(isset($_GET['requested-list'])){;?>
         <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a> / <a href="#" style="cursor: unset;">Requested Clearance List </a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <?=$msg;?>
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title">Requested Clerance List</h3>
              <a href="clearance.php" class="float-sm-right" title="Request Clearance"><i class="fa fa-inbox"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Requested Date</th>
                  <th>Reason</th>
                  <th>Action</th>                
                </tr>
                </thead>
                <tbody>
                  <?php
                  $num = 1;
                  $user_name = $_SESSION['user_name'];
                   $qry = "SELECT *FROM clearance  WHERE req_user = '$user_name'";
                   $ext = mysqli_query($conn,$qry);

                   while($row = mysqli_fetch_array($ext)){
                  ?>
                <tr>
                  <td><?php echo $num; ?></td>
                  <td><?php echo $row['re_date'];?></td>
                  <td><?php echo $row['reason']?></td>
                  <td><a href="clearance.php?clearance-detail=<?php echo $row['clearance_id']; ?>"><i class="fa fa-eye" title="View Title Detail Status"></i></a> </td>
                </tr><?php $num++;
              }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Requested Date</th>
                  <th>Reason</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
        </div>
      <?php } if(isset($_GET['clearance-detail'])){ ?>
               
   <div class="container-fluid">  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a> / <a href="#" style="cursor: unset;">Request Clearance </a> / <a href="#" style="cursor: unset;">Clearance Status Detail</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title"><strong>Clearance Status Detail</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php 
                    $id = "";
                    $dean_app = false;
                    $qry_select = "SELECT *FROM clearance WHERE clearance_id = '".$_GET['clearance-detail']."'";
                    $ext_query = mysqli_query($conn,$qry_select);
                    while($row = mysqli_fetch_array($ext_query)){ ?>
                         
                      <p><strong>Department Head:</strong> <?php if($row['dep_head_app'] == 'Approved') { echo ' <i class="fa fa-check"></i> [ Approved ]'; } else if($row['dep_head_app'] == 'Pending...'){ echo "Pending..."; } else { echo ' <i class="fa fa-times"></i> [ Rejected ]'; } ?></p>
                      <p><strong>Student Dean:</strong> <?php if($row['student_dean_app'] == 'Approved') { echo ' <i class="fa fa-check"></i> [ Approved ]'; } else if($row['student_dean_app'] == 'Pending...'){ echo "Pending..."; } else { echo ' <i class="fa fa-times"></i> [ Rejected ]'; } ?></p>
                      <p><strong>Library:</strong> <?php if($row['librarian_app'] == 'Approved') { echo ' <i class="fa fa-check"></i> [ Approved ]'; } else if($row['librarian_app'] == 'Pending...'){ echo "Pending..."; } else { echo ' <i class="fa fa-times"></i> [ Rejected ]'; } ?></p>
                      <p><strong>Exam & Assessment:</strong> <?php if($row['exam_assessor_app'] == 'Approved') { echo ' <i class="fa fa-check"></i> [ Approved ]'; } else if($row['exam_assessor_app'] == 'Pending...'){ echo "Pending..."; } else { echo ' <i class="fa fa-times"></i> [ Rejected ]'; } ?></p>
                      <p><strong>Finance:</strong> <?php if($row['finance_app'] == 'Approved') { echo ' <i class="fa fa-check"></i> [ Approved ]'; } else if($row['finance_app'] == 'Pending...'){ echo "Pending...";  } else { echo ' <i class="fa fa-times"></i> [ Rejected ]'; } ?></p>
                      <p><strong>Registrar:</strong> <?php if($row['registrar_app'] == 'Approved') { echo ' <i class="fa fa-check"></i> [ Approved ]'; } else if($row['registrar_app'] == 'Pending...'){ echo "Pending..."; } else { echo ' <i class="fa fa-times"></i> [ Rejected ]'; } ?></p>
                      <p><strong>A/V Dean:</strong> <?php if($row['vice_dean_app'] == 'Approved') { echo ' <i class="fa fa-check"></i> [ Approved ]'; } else if($row['vice_dean_app'] == 'Pending...'){ echo "Pending..."; } else { echo ' <i class="fa fa-times"></i> [ Rejected ]'; } ?></p>
                      <p><strong>Dean:</strong> <?php if($row['dean_app'] == 'Approved') { echo ' <i class="fa fa-check"></i> [ Approved ]'; $dean_app = true; } else if($row['dean_app'] == 'Pending...'){ echo "Pending..."; } else { echo ' <i class="fa fa-times"></i> [ Rejected ]'; } ?></p>
                    <?php } ?>
            </div>
            <div class="card-footer">
             <?php if($dean_app == true){ ?>
              <a href="pdf.php?clearance-id=<?php echo $_GET['clearance-detail'] ?>" target="_blank" class="btn btn-primary">Print Clearance</a>
            <?php }else{
              echo '<a href="#" class="btn btn-primary" title="Clearance is not Approved By Some or All Offices">Print Clearance</a>';
             } ?>
            </div>
        </div>
      </div>


                  <?php } ?> 
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
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

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
</script>

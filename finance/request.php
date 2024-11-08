<?php

session_start();
$msg = "";
include '../security.php';
include '../conn.php';
include 'user.php';
if($_SESSION['role'] != 'finance'){
    header("Location:../logout.php");
}

if(isset($_POST['approve'])){

             $qry_up2 = "";
             $how_many = mysqli_escape_string($conn,$_POST['how_many']);
             $measure = mysqli_escape_string($conn,$_POST['measure']);
             $req_id = mysqli_escape_string($conn,$_POST['req_id']);
             $item_id = mysqli_escape_string($conn,$_POST['item_id']);

           if($measure != 'Meter and Others'){
            $qry_check = mysqli_query($conn, "SELECT *FROM items WHERE item_id = '$item_id'");
            $res = mysqli_fetch_array($qry_check);
            $how_many2 = $res['how_many']; 
            if($how_many2 > $how_many){
              $qry_up = mysqli_query($conn, "UPDATE request SET status = 'Approved' WHERE req_id = '$req_id'");
              $qry_sel = mysqli_query($conn, "SELECT how_many FROM items WHERE item_id = '$item_id'");
              while($row_sel = mysqli_fetch_array($qry_sel)){
                $how_many = $row_sel['how_many'] - $how_many;
                $qry_up2 = mysqli_query($conn, "UPDATE items SET how_many = '$how_many' WHERE item_id = '$item_id'");
              }
              if(($qry_up) AND ($qry_up2)){
                $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Approved successfully</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
              } else {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Not approved</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
              }

           }else {
              $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Available item is less than the ordered drug</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
             } } else{
              $qry_up = mysqli_query($conn, "UPDATE request SET status = 'Approved' WHERE req_id = '$req_id'");
              if($qry_up){
                $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Approved successfully</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
              } else {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Not approved</center></strong>
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
  <title>Finance | STBC Student Clearance Management System</title>
  <link rel="icon" type="image/icon" href="../pic/logo.jpg">
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
  <!-- DataTable -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
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
      <?php $qry_select = "SELECT *FROM clearance WHERE finance_not = '1' AND exam_assessor_app = 'Approved'";
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
              <p><span id="user"><?php echo user(); ?></span> - Financer</p>
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
            <?php $qry_select = "SELECT *FROM clearance WHERE finance_not = '1' AND exam_assessor_app = 'Approved'";
                            $ext_select = mysqli_query($conn,$qry_select);
                            $num = mysqli_num_rows($ext_select);
                             if($num > 0){ ?>
            <a href="request.php?approve-request" class="nav-link" id="act">
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
        <?php if(isset($_GET['approve-request'])){;?>
      <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> / </a><a href="#" style="cursor: unset;">Manage Request </a> / <a href="#" style="cursor: unset;">Approve Request</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <?=$msg;?>
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title">Approve / Reject Request</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Requested By</th>
                  <th>Requested Date</th>
                  <th>Reason</th>
                  <th>Status</th>
                  <th>Action</th>                  
                </tr>
                </thead>
                <tbody>
                  <?php
                  $num = 1;
                   $qry = "SELECT student.stud_id, student.fname, student.mname, student.lname, student.user_name, clearance.clearance_id, clearance.req_user, clearance.re_date,clearance.reason, clearance.finance_app  FROM student JOIN clearance ON student.user_name = clearance.req_user AND clearance.exam_assessor_app = 'Approved' ORDER BY finance_app DESC";
                   $ext = mysqli_query($conn,$qry);

                   while($row = mysqli_fetch_array($ext)){
                  ?>
                <tr <?php if($row['finance_app'] == "Pending..."){ echo"style='background-color : orange;'"; } ?>>
                  <td><?php echo $num; ?></td>
                  <td><a href="request.php?stud-profile=<?php echo $row['stud_id']; ?>"><?php echo $row['fname']." ".$row['mname']." ".$row['lname']?></a> </td>
                  <td><?php echo $row['re_date'];?></td>
                  <td><?php echo $row['reason'];?></td>
                  <td><?php if($row['finance_app'] == 'Rejected'){echo "<span class='text-danger'>".$row['finance_app']."</span>"; }else{ echo $row['finance_app']; }?></td>
                 <td><?php if($row['finance_app'] == 'Pending...'){ ?><a href="../action.php?approve-request-finance-id=<?php echo $row['clearance_id'] ?>"><i class="fa fa-check" style="color: white;" title="Approve Request"></i></a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="../action.php?reject-request-finance=<?php echo $row['clearance_id'] ?>"><i class="fa fa-times" style="color: red;" title="Reject Request"></i></a><?php } else{ ?> <a href="../action.php?approve-request-finance-id=<?php echo $row['clearance_id'] ?>"><i class="fa fa-check" style="color: orange;" title="Already <?php echo $row['finance_app']; ?>"></i></a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="#"><i class="fa fa-times" style="color: red;" title="Already <?php echo $row['finance_app']; ?>"></i></a> <?php } ?></td>
                </tr><?php $num++;
              }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Requested By</th>
                  <th>Requested Date</th>
                  <th>Reason</th>
                  <th>Status</th>
                  <th>Action</th> 
                </tr>
                </tfoot>
              </table>
            </div>
        </div>
      <?php } if(isset($_GET['stud-profile'])){ ?>
               
   <div class="container-fluid">  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a> / <a href="#" style="cursor: unset;">Request </a> / <a href="#" style="cursor: unset;">Student Profile </a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title"><strong>Student Profile</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php 
                    $id = "";
                    $qry_select = "SELECT student.stud_id, student.fname, student.mname, student.lname, student.sex, student.age, student.entry, student.program, student.modality, student.status, program.program_id, program.program AS 'program_name', modality.modality_id, modality.modality AS 'modality_name', department.dep_id, department.department AS 'dep_name' FROM student JOIN program JOIN modality JOIN department ON student.program = program.program_id AND student.modality = modality.modality_id AND student.department = department.dep_id AND student.stud_id = '".$_GET['stud-profile']."'";
                    $ext_query = mysqli_query($conn,$qry_select);
                    while($row = mysqli_fetch_array($ext_query)){?>
                         
                      <p><strong>First Name:</strong> <?php echo $row['fname']; ?></p>
                      <p><strong>Middle Name:</strong> <?php echo $row['mname']; ?></p>
                      <p><strong>Last Name:</strong> <?php echo $row['lname']; ?></p>
                      <p><strong>Sex:</strong> <?php echo $row['sex']; ?></p>
                      <p><strong>Age:</strong> <?php echo $row['age']; ?></p>
                      <p><strong>Modality:</strong> <?php echo $row['modality_name']; ?></p>
                      <p><strong>Department:</strong> <?php echo $row['dep_name']; ?></p>
                      <p><strong>Entry: </strong> <?php echo $row['entry']; ?></p>
                      <p><strong>Program: </strong> <?php echo $row['program_name']; ?></p>
                    <?php } ?>
            </div>
            <div class="card-footer">
            </div>
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

<script>
  function change_role(){
     var xmlhttp = new XMLHttpRequest();
     var dep = document.getElementById("dep").value;
     xmlhttp.open("GET","../select.php?dep="+dep,false);     
     xmlhttp.send(null);
     document.getElementById("email").innerHTML = xmlhttp.responseText;
}
</script>
<?php

session_start();
include '../security.php';
include 'user.php';
include'../conn.php';
$msg = "";
if($_SESSION['role'] != 'patient'){
    header("Location:../logout.php");
}

if(isset($_POST['send'])){
  $doc_id = $_POST['id'];
  $pid = $_POST['pid'];
  $d_detail = $_POST['disease'];

   $qry = "INSERT INTO appointment(doc_id, p_id, disease) VALUES('$doc_id', '$pid', '$d_detail')";
   $ext = mysqli_query($conn, $qry);

   if($ext){
               $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Request has been sent successfully !!</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
   }else{
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Not Sent !!!</center></strong>
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
  <title>OMABS For Arba Minch Amazon Clinic</title>
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
   .card, .mn, .form-control{
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
      <?php /*$qry_select = "SELECT *FROM report WHERE receiver = '".$_SESSION['email']."' AND rn = '1'";
                            $ext_select = mysqli_query($conn,$qry_select);
                            $num = mysqli_num_rows($ext_select);
                             if($num > 0){ */?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?php //echo $num; ?></span>
        
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="report.php?inbox" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?php //echo $num; ?> new messages
          </a>
        </div>
      </li>
      <?php //} ?>
      <li class="dropdown user user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><img src="../pic/user.PNG" class="user-image" alt="User Image"></span></a>
          <ul class="dropdown-menu">
            <li class="user-header bg-info">
              <img src="../pic/user.PNG" class="img-circle" alt="User Image">
              <p><span id="user"><?php echo user(); ?></span> - Patient</p>
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
    <a href="index.php" class="brand-link" title="Online Medical Appointment Booking System">
      &nbsp;<span class="brand-text font-weight-light"> OMABS - Amazon Clinic</span>
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
          <li class="nav-item has-treeview">
            <a href="register.php?register" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Register
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="inbox.php?inbox" class="nav-link">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Inbox
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview active">
            <a href="request-appointment.php" class="nav-link" id="act">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Request Appointment
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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <?php if(!isset($_GET['request-appointment']) && !isset($_GET['view-requests']) && !isset($_GET['view-disease-detail']) && !isset($_GET['view-schedule'])){;?>
      <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a> / <a href="#" style="cursor: unset;">Request Appointment</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
         <?=$msg;?>
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title">Available Doctors</h3>
              <a href="request-appointment.php?view-requests" class="float-sm-right" title="View Sent Requests"><i class="fa fa-eye"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Speciality</th>
                  <th>Action</th>                  
                </tr>
                </thead>
                <tbody>
                <?php 
                $num = 1;
                $qry = "SELECT *FROM employee WHERE position = 'doctor'";
                $qry_ext = mysqli_query($conn,$qry);
                while($row = mysqli_fetch_array($qry_ext)){
                  ?>
                <tr>
                  <td><?=$num;?></td>
                  <td>Dr. <?=$row['fname']." ".$row['mname']." ".$row['lname'];?></td>
                  <td><?=$row['phone'];?></td>
                  <td id=""><?=$row['speciality'];?></td>
                  <td><a href="request-appointment.php?request-appointment=<?php echo $row['emp_id']; ?>&fname=<?php echo $row['fname']; ?>&mname=<?php echo $row['mname']; ?>&lname=<?php echo $row['lname']; ?>"><i class="fa fa-book" style="color: red;" title="Request Appointment"></i></a></td>
                  <?php $num++; ?>
                </tr>
              <?php }?>
                </tbody>
                <tfoot>
                <tr>
                 <th>No</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Speciality</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
        </div>
      <?php } if(isset($_GET['view-requests'])){;?>
      <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a> / <a href="#" style="cursor: unset;">Request Appointment</a> / <a href="#" style="cursor: unset;">View Requests</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title">Sent Requests</h3>
              <a href="request-appointment.php" class="float-sm-right" title="Request Appointment"><i class="fa fa-book"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>To </th>
                  <th>Status</th>        
                  <th>Action</th>          
                </tr>
                </thead>
                <tbody>
                <?php 
                $num = 1;
                $qry = "SELECT appointment.app_id, appointment.app_req, appointment.p_id, appointment.doc_id, patient.pid, employee.emp_id, employee.fname, employee.mname, employee.lname FROM appointment JOIN patient JOIN employee ON appointment.p_id = patient.pid AND appointment.doc_id = employee.emp_id AND patient.pid = (SELECT pid FROM patient WHERE email = '".$_SESSION['username']."') ORDER BY appointment.app_id DESC";
                $qry_ext = mysqli_query($conn,$qry);
                while($row = mysqli_fetch_array($qry_ext)){
                  ?>
                <tr>
                  <td><?=$num;?></td>
                  <td>Dr. <?=$row['fname']." ".$row['mname']." ".$row['lname'];?></td>
                  <td><?php if($row['app_req'] == 1){ echo "<span class='text-red'>Not Confirmed Yet</span>";}else { echo "<span class='text-success'>Confirmed</span>";}?></td>
                  <td><a href="request-appointment.php?view-disease-detail=<?php echo $row['app_id']; ?>"><i class="fa fa-eye" style="color: red;" title="View Disease Detail"></i></a> <?php if($row['app_req'] == '0'){ ?>| <a href="request-appointment.php?view-schedule=<?php echo $row['app_id']; ?>&fname=<?php echo $row['fname']; ?>&mname=<?php echo $row['mname']; ?>&lname=<?php echo $row['lname']; ?>"><i class="fa fa-eye" style="color: blue;" title="View Schedule"></i></a> <?php } ?></td>
                  <?php $num++; ?>
                </tr>
              <?php }?>
                </tbody>
                <tfoot>
                <tr>
                 <th>No</th>
                  <th>To </th>
                  <th>Status</th> 
                  <th>Action</th> 
                </tr>
                </tfoot>
              </table>
            </div>
        </div>
      <?php } if(isset($_GET['view-disease-detail'])) { ?>
   <div class="container-fluid">  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a> / <a href="#" style="cursor: unset;">Request Appointment</a> / <a href="#" style="cursor: unset;">View Disease Detail</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title"><strong>Disease Detail</strong></h3>
              <a href="request-appointment.php" class="float-sm-right" title="Request Appointment"><i class="fa fa-book"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php 
                    $id = "";
                    $qry_select = "SELECT disease FROM appointment WHERE app_id = '".$_GET['view-disease-detail']."'";
                    $ext_query = mysqli_query($conn,$qry_select);
                    while($row = mysqli_fetch_array($ext_query)){?>
                         
                      <p><?php echo $row['disease']; ?></p>

                    <?php } ?>
            </div>
            <div class="card-footer">
            </div>
        </div>
      </div><!-- /.container-fluid -->
    <?php } if(isset($_GET['view-schedule'])) { ?>
   <div class="container-fluid">  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a> / <a href="#" style="cursor: unset;">Request Appointment</a> / <a href="#" style="cursor: unset;">View Schedule</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title"><strong>Schedule</strong></h3>
              <a href="request-appointment.php" class="float-sm-right" title="Request Appointment"><i class="fa fa-book"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php 
                    $id = "";
                    $qry_select = "SELECT *FROM appointment WHERE app_id = '".$_GET['view-schedule']."'";
                    $ext_query = mysqli_query($conn,$qry_select);
                    while($row = mysqli_fetch_array($ext_query)){?>
                         
                      <p><?php echo "Date : ".$row['app_date']; ?></p>
                      <p><?php echo "Time : ".$row['app_time']; ?></p>
                      <p><?php echo "With Dr. : ".$_GET['fname']." ".$_GET['mname']." ".$_GET['lname']; ?></p>

                    <?php } ?>
            </div>
            <div class="card-footer">
            </div>
        </div>
      </div><!-- /.container-fluid -->
    <?php } if(isset($_GET['request-appointment'])){

        $id = $_GET['request-appointment'];
        ?>
      <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a> / <a href="#" style="cursor: unset;">Request Appointment</a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        </div>
        </div> 
        <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Request Appointment</h3>
                <a href="request-appointment.php" class="float-sm-right" title="Request To Other Doctors"><i class="fa fa-book"></i></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="request-appointment.php" method="POST">
                <div class="card-body">
                 <!--  <?=$msg ?> -->
                  <legend><b>Your Detail</b></legend>
                 <div class="form-row">
                  <input type="hidden" name="id" value="<?php echo $id;?>">

                  <?php
                    $qry = "SELECT *FROM patient WHERE email = '".$_SESSION['username']."'";
                    $ext = mysqli_query($conn,$qry);
                    while($row = mysqli_fetch_array($ext)){
                  ?>
                  <input type="hidden" name="pid" value="<?php echo $row['pid']?>">
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="fname" value="<?php echo "First Name : ".$row['fname']?>" placeholder="Enter First Name" readonly>
                  </div>
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="mname" value="<?php echo "Middle Name : ".$row['mname']?>" placeholder="Enter Middle Name" readonly>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="lname" value="<?php echo "Last Name : ".$row['lname']?>" placeholder="Enter Last Name" readonly>
                  </div>
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo "Address : ". $row['address']?>" placeholder="Enter City" readonly>
                  </div>
                </div>                
                <div class="form-row">                  
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo "Phone : ".$row['phone']?>" id="phone" placeholder="Enter Phone" readonly>
                  </div>
                  <div class="form-group col-sm-6" id="email">
                    <input type="email" class="form-control" name="email" value="<?php echo "Email : ".$row['email']?>" placeholder="Enter Email" readonly>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="age" value="<?php echo "Age : ".$row['age']?>" readonly>
                  </div>
                  <div class="form-group col-sm-6">
                    <input type="email" class="form-control" name="gender" value="<?php echo "Gender : ". $row['gender']?>"  readonly>
                  </div>
                </div>
                <legend><b>Request Is Sent To Dr.</b></legend>
                <div class="form-row">                  
                  <div class="form-group col-sm-4">
                    <input type="text" class="form-control" name="phone" value="<?php echo "First Name : ".$_GET['fname']?>" readonly>
                  </div>
                  <div class="form-group col-sm-4">
                    <input type="text" class="form-control" name="email" value="<?php echo "Middle Name : ".$_GET['mname']?>" readonly>
                  </div>
                  <div class="form-group col-sm-4">
                    <input type="text" class="form-control" name="email" value="<?php echo "Last Name : ".$_GET['lname']?>" readonly>
                  </div>
                </div>
                <legend><b>Disease Detail</b></legend>
                <div class="form-row">  
                <div class="form-group col-sm-12">
                  <textarea placeholder="Enter deatial about your disease..." class="form-control" name="disease" ></textarea>
                </div>                
                </div>
                  <?php }?>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="send" class="btn btn-primary mn"><i class="fa fa-paper-plane"></i> Send</button>
                </div>
              </form>
            </div>
      <?php } ?>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="index.php">Arba Minch OMABS</a>.</strong>
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
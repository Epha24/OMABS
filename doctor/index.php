<?php

session_start();
include '../security.php';
include 'user.php';
include'../conn.php';
if($_SESSION['role'] != 'doctor'){
    header("Location:../logout.php");
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
   .card, .mn{
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
      <?php $qry_select = "SELECT *FROM appointment WHERE doc_id = (SELECT emp_id FROM employee WHERE email = '".$_SESSION['username']."') AND seen_unseen = '1'";
                            $ext_select = mysqli_query($conn,$qry_select);
                            $num = mysqli_num_rows($ext_select);
                             if($num > 0){ ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge"><?php echo $num; ?></span>
        
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="book-appointment.php?make-appointment" class="dropdown-item">
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
              <p><span id="user"><?php echo user(); ?></span> - Doctor</p>
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
          <li class="nav-item has-treeview active">
            <a href="index.php" class="nav-link" id="act">
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
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-th-list"></i>
              <p>
                Manage Appointment
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="book-appointment.php?make-appointment" class="nav-link">
                  &nbsp;&nbsp;
                  <i class="nav-icon fa fa-book"></i>
                  <p>Make Appointment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="book-appointment.php?update-appointment" class="nav-link">
                  &nbsp;&nbsp;
                  <i class="nav-icon fas fa-edit"></i>
                  <p>Update Appointment</p>
                </a>
              </li>
            </ul>
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
        <?php if(!isset($_GET['employee']) && !isset($_GET['bus']) && !isset($_GET['admin']) && !isset($_GET['owner'])){?>
              <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i></a></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info mn">
              <div class="inner">
                <?php $qry = "SELECT *FROM employee WHERE position = 'doctor'";
                      $ext = mysqli_query($conn,$qry);
                      $num = mysqli_num_rows($ext);?>
                <h3><?php echo $num; ?></h3>

                <p>Doctor</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="parcel.php?update-parcel" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success mn">
              <div class="inner">
                <?php $qry_ass = "SELECT *FROM employee WHERE position = 'admin'";
                      $ext_ass = mysqli_query($conn,$qry_ass);
                      $num_ass = mysqli_num_rows($ext_ass);?>
                <h3><?php echo $num_ass; ?></h3>
                <p>Admin</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="certificate.php?view-certificate" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success mn">
              <div class="inner">
                <?php $qry_ass = "SELECT *FROM employee WHERE position = 'staff'";
                      $ext_ass = mysqli_query($conn,$qry_ass);
                      $num_ass = mysqli_num_rows($ext_ass);?>
                <h3><?php echo $num_ass; ?></h3>
                <p>Staff</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="certificate.php?view-certificate" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success mn">
              <div class="inner">
                <?php $qry_ass = "SELECT *FROM user WHERE role = 'patient'";
                      $ext_ass = mysqli_query($conn,$qry_ass);
                      $num_ass = mysqli_num_rows($ext_ass);?>
                <h3><?php echo $num_ass; ?></h3>
                <p>Patient</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="certificate.php?view-certificate" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <?php }
      if(isset($_GET['employee'])){;?>
         <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> / </a><a href="#" style="cursor: unset;">Employees' Detail</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title">Employees' Detail</h3>
              <a href="index.php" class="float-sm-right" title="Go back"><i class="fa fa-home"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Last Name</th>
                  <th>City</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Position</th>
                  <th>Status</th>                
                </tr>
                </thead>
                <tbody>
                <?php 
                $num = 1;
                $qry = "SELECT *FROM employee";
                $qry_ext = mysqli_query($conn,$qry);
                while($row = mysqli_fetch_array($qry_ext)){
                  ?>
                <tr>
                  <td><?=$num;?></td>
                  <td id=""><?=$row['fname'];?></td>
                  <td id=""><?=$row['mname'];?></td>
                  <td id=""><?=$row['lname'];?></td>
                  <td id=""><?=$row['city'];?></td>
                  <td id=""><?=$row['phone'];?></td>
                  <td id=""><?=$row['email'];?></td>
                  <td id=""><?=$row['position'];?></td>
                  <td id=""><?=$row['status'];?></td>
                  <?php $num++; ?>
                </tr>
              <?php }?>
                </tbody>
                <tfoot>
                <tr>
                 <th>No</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Last Name</th>
                  <th>City</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Position</th>
                  <th>Status</th>
                </tr>
                </tfoot>
              </table>
            </div>
        </div>
      <?php } if(isset($_GET['owner'])){?>
        <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> / </a><a href="#" style="cursor: unset;">Owners' Detail</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title">Owners' Detail</h3>
              <a href="index.php" class="float-sm-right" title="Go back"><i class="fa fa-home"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Last Name</th>
                  <th>City</th>
                  <th>Phone</th>                
                </tr>
                </thead>
                <tbody>
                <?php 
                $num = 1;
                $qry = "SELECT *FROM owner";
                $qry_ext = mysqli_query($conn,$qry);
                while($row = mysqli_fetch_array($qry_ext)){
                  ?>
                <tr>
                  <td><?=$num;?></td>
                  <td id=""><?=$row['fname'];?></td>
                  <td id=""><?=$row['mname'];?></td>
                  <td id=""><?=$row['lname'];?></td>
                  <td id=""><?=$row['city'];?></td>
                  <td id=""><?=$row['phone'];?></td>
                  <?php $num++; ?>
                </tr>
              <?php }?>
                </tbody>
                <tfoot>
                <tr>
                 <th>No</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Last Name</th>
                  <th>City</th>
                  <th>Phone</th>
                </tr>
                </tfoot>
              </table>
            </div>
        </div> <?php } if(isset($_GET['bus'])){?>
        <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> / </a><a href="#" style="cursor: unset;">Bus' Detail</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title">Bus' Detail</h3>
              <a href="index.php" class="float-sm-right" title="Go back"><i class="fa fa-home"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Plate Number</th>
                  <th>Seat Number</th>
                  <th>Model</th>   
                  <th>Level</th>                 
                </tr>
                </thead>
                <tbody>
                <?php 
                $num = 1;
                $qry_data = "SELECT *FROM bus";
                $qry_ext_data = mysqli_query($conn,$qry_data);
                while($row = mysqli_fetch_array($qry_ext_data)){
                  ?>
                <tr>
                  <td><?=$num;?></td>
                  <td id=""><?=$row['pnumber'];?></td>
                  <td id=""><?=$row['seatnumber'];?></td>
                  <td id=""><?=$row['model'];?></td>
                  <td id=""><?=$row['level'];?></td>
                  <?php $num++; ?>
                </tr>
              <?php }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Plate Number</th>
                  <th>Seat Number</th>
                  <th>Model</th>   
                  <th>Level</th>                
                </tr>
                </tfoot>
              </table>
            </div>
        </div> <?php } if(isset($_GET['admin'])){?>
        <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> / </a><a href="#" style="cursor: unset;">Admins' Detail</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title">Admins' Detail</h3>
              <a href="index.php" class="float-sm-right" title="Go back"><i class="fa fa-home"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Last Name</th>
                  <th>City</th>
                  <th>Phone</th>
                  <th>Email</th>              
                </tr>
                </thead>
                <tbody>
                <?php 
                $num = 1;
                $qry = "SELECT *FROM employee WHERE position = 'admin'";
                $qry_ext = mysqli_query($conn,$qry);
                while($row = mysqli_fetch_array($qry_ext)){
                  ?>
                <tr>
                  <td><?=$num;?></td>
                  <td id=""><?=$row['fname'];?></td>
                  <td id=""><?=$row['mname'];?></td>
                  <td id=""><?=$row['lname'];?></td>
                  <td id=""><?=$row['city'];?></td>
                  <td id=""><?=$row['phone'];?></td>
                  <td id=""><?=$row['email'];?></td>
                  <?php $num++; ?>
                </tr>
              <?php }?>
                </tbody>
                <tfoot>
                <tr>
                 <th>No</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Last Name</th>
                  <th>City</th>
                  <th>Phone</th>
                  <th>Email</th>
                </tr>
                </tfoot>
              </table>
            </div>
        </div> <?php }?>

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
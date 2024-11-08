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

if($_SESSION['role'] != 'staff'){
    header("Location:../logout.php");
}


if(isset($_POST['post'])){

  $message = $_POST['message'];
  $date = date("Y-m-d");

  if(empty($message)){
                $msg = "<div class='alert alert-danger alert-dismissible fade show mn' role='alert'>
                  <strong><center>News should not be empty !!!</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
             }else{

              $qry = "INSERT INTO news(p_date, message) VALUES('$date','$message')";
              $ext = mysqli_query($conn,$qry);

         if($ext){
             $msg = "<div class='alert alert-success alert-dismissible fade show mn' role='alert'>
                  <strong><center>Updated successfully</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
          }else{
               $msg = "<div class='alert alert-danger alert-dismissible fade show mn' role='alert'>
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
              <p><span id="user"><?php echo user(); ?></span> - Staff</p>
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
            <a href="comments.php" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                User Comments
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-th-list"></i>
              <p>
                Manage Employee
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="employee.php?add-employee" class="nav-link">
                  &nbsp;&nbsp;
                  <i class="nav-icon fa fa-plus"></i>
                  <p>Add Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="employee.php?update-employee" class="nav-link">
                  &nbsp;&nbsp;
                  <i class="nav-icon fas fa-edit"></i>
                  <p>Update Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="employee.php?update-employee" class="nav-link">
                  &nbsp;&nbsp;
                  <i class="nav-icon fas fa-edit"></i>
                  <p>Delete Employee</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview active">
            <a href="#" class="nav-link" id="act">
              <i class="nav-icon fa fa-th-list"></i>
              <p>
                Manage News
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="news.php?post-news" class="nav-link">
                  &nbsp;&nbsp;
                  <i class="nav-icon fa fa-upload"></i>
                  <p>Post News</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="news.php?update-news" class="nav-link">
                  &nbsp;&nbsp;
                  <i class="nav-icon fas fa-edit"></i>
                  <p>Update News</p>
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
    <!-- Content Header (Page header) -->

    <!-- Main content -->
  <section class="content">
    <?php if(isset($_GET['post-news'])) { ?>
   <div class="container-fluid">  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a> / <a href="#" style="cursor: unset;">Manage News </a> / <a href="#" style="cursor: unset;">Post News</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <div class="row"> 
        <div class="col-md-3">
            <a href="news.php?post-news" class="btn btn-info btn-block mb-3 mn"><i class="fas fa-upload"></i> Post News</a>

            <div class="card mn">
              <div class="card-header">
                <h3 class="card-title">Manage News</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item active">
                    <a href="news.php?post-news" class="nav-link">
                      <i class="fas fa-upload"></i> Post News
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="news.php?update-news" class="nav-link">
                      <i class="far fa-edit"></i> Update News
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="news.php?update-news" class="nav-link">
                      <i class="far fa-trash-alt"></i> Delete News
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </div> 
        <div class="col-md-9">
          <?=$msg;?>
          <form action="news.php?post-news" method="POST">
        <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Post News
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <textarea id="summernote" name="message">
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
            </div>
            <div class="card-footer">
              <button class="btn btn-danger mn" name="post">Post</button>
            </div>
          </div>
          </form>
          </div>
        </div>

    <?php } if(isset($_GET['update-detail'])) {?>
  <div class="container-fluid">  
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a> / <a href="#" style="cursor: unset;">Profile</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div>
        <form action="profile.php" method="POST"> 
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title"><strong>Update Your Profile</strong></h3>
        </div>
        <div class="card-body">
          <div class="form-row">
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="fname" placeholder="Enter First Name" value="<?php echo $_GET['fname'];?>" required>
                    <?=$fname_error;?>
                  </div>
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="mname" placeholder="Enter Middle Name" value="<?php echo $_GET['mname'];?>" required>
                    <?=$mname_error;?>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" value="<?php echo $_GET['lname'];?>" required>
                    <?=$lname_error;?>
                  </div>
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="address" placeholder="Enter Address" value="<?php echo $_GET['address'];?>" required>
                    <?=$city_error;?>
                  </div>
                </div>                
                <div class="form-row">                  
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" value="<?php echo $_GET['phone'];?>" required>
                    <?=$phone_error;?>
                  </div>
                  <div class="form-group col-sm-6" id="email">
                    <input type="hidden" class="form-control" name="email" value="<?php echo $_GET['update-detail'];?>" required>
                  </div>
                </div>
        </div>
        <div class="card-footer">
          <input type="submit" name="update-detail" class="btn btn-danger mn" value="Update">
        </div>
      </div>
    </form>
    <?php } ?> 
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
  $(function () {
    // Summernote
    $('#summernote').summernote()

  })
</script>

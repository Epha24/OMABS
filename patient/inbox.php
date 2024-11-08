<?php
$msg2 = "";
$msg = "";
$msg3 = "";
session_start();
include '../security.php';
include '../conn.php';
include 'user.php';
if($_SESSION['role'] != 'patient'){
    header("Location:../logout.php");
} 

if(isset($_POST['report'])){

  $to =  $_POST['to'];
  $from = $_SESSION['email'];
  $date = Date("l,N F Y G:i");
  $time = date("H:m:s");

  $file =    $_FILES['attach']['name'];
  $imgTemp = $_FILES['attach']['tmp_name'];
  $imgError = $_FILES['attach']['error'];
  $imgSize = $_FILES['attach']['size'];
  $imgType = $_FILES['attach']['type'];
  $fileExt = explode('.', $file);
  $fileActExt = strtolower(end($fileExt));

  $Allowed = array('doc','docx','pdf','zip');
    
  $folders = "../reports/";
    
    move_uploaded_file($imgTemp,$folders.$file);
    if(in_array($fileActExt, $Allowed)){
      $sql = "INSERT INTO report(sender,receiver,file,date,time) VALUES('$from','$to','$file','$date','$time')";
    $result = mysqli_query($conn,$sql);
    
    if($result){
        $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                   <strong><center>Successfully sent</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
    }
    else{
        $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>Faild</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
    }
    }
    else{
       $msg2 = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>You can not upload file of this kind</center></strong>
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
  <link rel="icon" type="image/icon" href="../logo.jpg">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <!-- DataTable -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
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
  <script language=" JavaScript" >
<!-- 
function LoadOnce() 
{ 
window.location.reload(); 
} 
//-->
</script>
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
          <li class="nav-item has-treeview active">
            <a href="inbox.php?inbox" class="nav-link" id="act">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Inbox
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="request-appointment.php" class="nav-link">
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
          <?php if(isset($_GET['send-chat'])){;?>
         <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i></a> / <a href="#" style="cursor: unset;">Reports </a>  / <a href="#" style="cursor: unset;">Compose</a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        </div>
        </div> 
        <div class="row"> 
        <div class="col-md-3">
            <a href="inbox.php?inbox" class="btn btn-info btn-block mb-3 mn"><i class="fas fa-plus"></i> Back to inbox</a>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Folders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item active">
                    <a href="inbox.php?inbox" class="nav-link">
                      <i class="fas fa-inbox"></i> Inbox
                      <?php $qry_select = "SELECT *FROM report WHERE receiver = '".$_SESSION['username']."' AND rn = '1'";
                            $ext_select = mysqli_query($conn,$qry_select);
                            $num = mysqli_num_rows($ext_select);
                             if($num > 0){ ?>
                      <span class="badge bg-primary float-right"><?php echo $num;?></span>
                    <?php } ?>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="inbox.php?sent" class="nav-link">
                      <i class="far fa-envelope"></i> Sent
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </div> 
        <div class="col-md-9">
          <?=$msg;?>
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Compose New Message</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="inbox.php?send-chat" method="post" enctype='multipart/form-data'>
                <div class="form-group">
                  <select class="form-control" name="to">
                    <option selected="selected" disabled="disabled">To</option>
                    <?php 
                    $username = $_SESSION['username'];
                          $qry = "SELECT *FROM user WHERE username !='$username'";
                          $ext = mysqli_query($conn,$qry);
                          while($row = mysqli_fetch_array($ext)){?>
                            <option><?php echo $row['username'];?></option>
                          <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                    <input type="file" class="form-control" name="attach" required>
                </div>
              
                <?=$msg2;?>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-left">
                  <button type="submit" name="report" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                </div>
              </div>
              </form>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      <?php } if(isset($_GET['inbox'])){;?>

        <?php $qry_update = "UPDATE inbox SET rn = '0' WHERE rn = '1' AND receiver = '".$_SESSION['username']."'";
              $ext = mysqli_query($conn,$qry_update);?>
         <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a> / <a href="#" style="cursor: unset;">Inbox </a>  / <a href="#" style="cursor: unset;">Compose</a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        </div>
        </div> 
        <div class="row"> 
        <div class="col-md-3">
            <a href="inbox.php?send-chat" class="btn btn-info btn-block mb-3 mn"><i class="fas fa-plus"></i> Compose</a>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Folders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item active">
                    <a href="inbox.php?inbox" class="nav-link">
                      <i class="fas fa-inbox"></i> Inbox
                      <?php $qry_select = "SELECT *FROM inbox WHERE receiver = '".$_SESSION['username']."' AND rn = '1'";
                            $ext_select = mysqli_query($conn,$qry_select);
                            $num = mysqli_num_rows($ext_select);
                             if($num > 0){ ?>
                      <span class="badge bg-primary float-right"><?php echo $num;?></span>
                    <?php } ?>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="inbox.php?sent" class="nav-link">
                      <i class="far fa-envelope"></i> Sent
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </div> 
          <div class="col-md-9">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Inbox</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
          <div class="card-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>From</th>
                  <th>Date</th>
                  <th>Attachment</th>
                  <th>Action</th>                  
                </tr>
                </thead>
                <tbody>
                <?php 
                $num = 1;
                $qry = "SELECT *FROM report WHERE receiver = '".$_SESSION['username']."'";
                $qry_ext = mysqli_query($conn,$qry);
                while($row = mysqli_fetch_array($qry_ext)){
                  ?>
                <tr>
                  <td><?=$num;?></td>
                  <td id=""><?=$row['sender'];?></td>
                  <td id=""><?=$row['date'];?></td>
                  <td><a href="../reports/<?php echo $row['file'];?>"><?=$row['file'];?></a></td>
                  <td><a href="../action.php?delete-report=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" style="color: red;" title="Delete Employee"></i></a></td>
                  <?php $num++; ?>
                </tr>
              <?php }?>
                </tbody>
                <tfoot>
                <tr>
                 <th>No</th>
                  <th>From</th>
                  <th>Date</th>
                  <th>Attachment</th>
                  <th>Action</th>    
                </tr>
                </tfoot>
              </table>
            </div>
        </div>
        </div>
      <?php } if(isset($_GET['sent'])){;?>
         <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a> / <a href="#" style="cursor: unset;">Inbox </a>  / <a href="#" style="cursor: unset;">Compose</a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        </div>
        </div> 
        <div class="row"> 
        <div class="col-md-3">
            <a href="inbox.php?send-chat" class="btn btn-info btn-block mb-3 mn"><i class="fas fa-plus"></i> Compose</a>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Folders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item active">
                    <a href="inbox.php?inbox" class="nav-link">
                      <i class="fas fa-inbox"></i> Inbox
                      <span class="badge bg-primary float-right">12</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="inbox.php?sent" class="nav-link">
                      <i class="far fa-envelope"></i> Sent
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </div> 
          <div class="col-md-9">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Sent</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
          <div class="card-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>To</th>
                  <th>Date</th>
                  <th>Attachment</th>
                  <th>Action</th>                  
                </tr>
                </thead>
                <tbody>
                <?php 
                $num = 1;
                $qry = "SELECT *FROM inbox WHERE sender = '".$_SESSION['email']."'";
                $qry_ext = mysqli_query($conn,$qry);
                while($row = mysqli_fetch_array($qry_ext)){
                  ?>
                <tr>
                  <td><?=$num;?></td>
                  <td id=""><?=$row['receiver'];?></td>
                  <td id=""><?=$row['date'];?></td>
                  <td><a href="../reports/<?php echo $row['file'];?>"><?=$row['file'];?></a></td>
                  <td><a href="../action.php?delete-admin-report=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" style="color: red;" title="Delete Report"></i></a></td>
                  <?php $num++; ?>
                </tr>
              <?php }?>
                </tbody>
                <tfoot>
                <tr>
                 <th>No</th>
                  <th>To</th>
                  <th>Date</th>
                  <th>Attachment</th>
                  <th>Action</th>    
                </tr>
                </tfoot>
              </table>
            </div>
        </div>
        </div>
      <?php }?>
        </div>
  </div>
</section>
</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="index.php">Hawassa TMS</a>.</strong>
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

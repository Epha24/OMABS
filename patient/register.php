<?php

session_start();
include '../security.php';
include'user.php';
include '../conn.php';
$msg = "";

 if($_SESSION['role'] != 'patient'){
     header("Location:../logout.php");
 }

     if(isset($_POST['update_detail'])){
              $email = mysqli_escape_string($conn,$_POST['email']);
              $newpassword = mysqli_escape_string($conn,$_POST['newpassword']);
              $confpassword = mysqli_escape_string($conn,$_POST['confpassword']);
              $oldpassword = mysqli_escape_string($conn,$_POST['oldpassword']);

              $qry = "SELECT *FROM user WHERE username = '$email'";
              $ext = mysqli_query($conn,$qry);
              while($row = mysqli_fetch_array($ext)){
                if(md5($oldpassword) != $row['password']){
                  $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Old password do not match !!!</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
                } else if($newpassword != $confpassword){
              $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Password do not match !!!</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
             } else if(strlen($newpassword) < 7){

                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Password length should be greater than 6 !!!</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";

             }else{
              $password = md5($newpassword);

                  $upqry = "UPDATE user SET password = '$password'";
                  $upext = mysqli_query($conn,$upqry);
                  if($upext){
                    $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                               <strong><center>Successfilly updated</center></strong>
                                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                               <span aria-hidden='true'>&times;</span>
                            </button></div>";
                  }
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
  <link rel="icon" type="image/icon" href="../logo.jpg">
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
    <a href="index.php" class="brand-link" title="Onine Medical Appointment Booking System">
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
          <li class="nav-item has-treeview active">
            <a href="register.php?register" class="nav-link" id="act">
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
        <?php if(isset($_GET['register'])){;?>
      <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> / </a><a href="#" style="cursor: unset;">Register</a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        </div>
        </div>
        <?php $qry = "SELECT *FROM patient WHERE email = '".$_SESSION['username']."'";
                $ext = mysqli_query($conn, $qry);
                $num_row = mysqli_num_rows($ext);
                if($num_row > 0){ ?>
          <div class="card"><div class="card-body"><center>You have already registered. Go to <a href="profile.php">Profile</a></center></div></div>
                <?php } else{ ?> 
        <div class="row"> 
        <div class="col-md-3">
            <a href="account.php?register" class="btn btn-info btn-block mb-3 mn"><i class="fas fa-plus"></i> Register</a>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Register</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item active">
                    <a href="register.php?register" class="nav-link">
                      <i class="fas fa-plus"></i> Register
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="register.php?update" class="nav-link">
                      <i class="far fa-edit"></i> Update Profile
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </div> 
        <div class="col-md-9">
          <?=$msg;?>
        <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Register</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="profile.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                 <!--  <?=$msg ?> -->
                 <div class="form-row">
                  <div class="form-group col-sm-4">
                    <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <input type="text" class="form-control" name="mname" placeholder="Enter Middle Name" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-sm-4">
                    <input type="number" class="form-control" name="age" placeholder="Enter Age" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <select name="gender" class="form-control">
                      <option selected="selected" disabled="disabled">Select Gender</option>
                      <!--<option value="passenger">Passenger</option>-->
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="other">Other</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-4">
                    <select name="mstatus" class="form-control">
                      <option selected="selected" disabled="disabled">Select Marital Status</option>
                      <!--<option value="passenger">Passenger</option>-->
                      <option value="single">Single</option>
                      <option value="married">Married</option>
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-sm-4">
                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['username'];?>" readonly="">
                  </div>
                  <div class="form-group col-sm-4">
                    <input type="text" class="form-control" name="address" placeholder="Enter Address" required>
                  </div>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="register" class="btn btn-primary mn">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php } }
      if(isset($_GET['update_account'])){;?>
         <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> / </a><a href="#" style="cursor: unset;">Manage Account / </a> <a href="#" style="cursor: unset;">Update Account</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <?=$msg;?>
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title">Update Account</h3>
              <a href="account.php?create_account" class="float-sm-right" title="Create New Account"><i class="fa fa-plus"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Account Status</th>
                  <th>Action</th>                  
                </tr>
                </thead>
                <tbody>
                  <?php
                  $num = 1;
                  $email = $_SESSION['username'];
                   $qry = "SELECT *FROM user  WHERE username != '$email'";
                   $ext = mysqli_query($conn,$qry);

                   while($row = mysqli_fetch_array($ext)){
                  ?>
                <tr>
                  <td><?php echo $num; ?></td>
                  <td><?php echo $row['username'];?></td>
                  <td><?php echo $row['role']?></td>
                  <td><?php if($row['status'] == "Inactive"){echo "<span class='text-danger'>".$row['status']."</span>";}else{echo "<span class='text-success'>".$row['status']."</span>";}?></td>
                 <td><a href="../action.php?delete-account=<?php echo $row['username'] ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" style="color: red;" title="Delete Account"></i></a>&nbsp; | &nbsp; <a href="account.php?update-detail=<?php echo $row['username']; ?>"><i class="fa fa-edit" style="color: blue;" title="Update Account"></i></a> &nbsp;| &nbsp; <a href="../action.php?change-status=<?php echo $row['username'] ?>" onclick="return confirm('Are you sure you want to change account status?')"><i class="fa fa-ban" style="color: orange;" title="Change account status"></i></a></td>
                </tr><?php $num++;
              }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Account Status</th>
                  <th>Action</th> 
                </tr>
                </tfoot>
              </table>
            </div>
        </div>
      <?php } if(isset($_GET['update-detail'])){

        $_SESSION['id'] = $_GET['update-detail'];
        $id = $_SESSION['id'];
        ?>
      <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a> / <a href="#" style="cursor: unset;">Manage Account </a> / <a href="#" style="cursor: unset;">Update Account</a>  /  <a href="#" style="cursor: unset;">Update Detail </a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        </div>
        </div> 
          <?=$msg;?>
        <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Update Detail</h3>
                <a href="account.php?update_account" class="float-sm-right" title="Update Account"><i class="fa fa-edit"></i></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="account.php?update_account" method="POST">
                <div class="card-body">
                 <!--  <?=$msg ?> -->
                 <div class="form-row">
                  <input type="hidden" name="id" value="<?php echo $_GET['update-detail']?>">

                  <?php
                    $qry = "SELECT *FROM user WHERE username = '$id'";
                    $ext = mysqli_query($conn,$qry);
                    while($row = mysqli_fetch_array($ext)){
                  ?>
                  <div class="form-group col-sm-4">
                    <input type="password" class="form-control" name="oldpassword" placeholder="Enter old password" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <input type="password" class="form-control" name="newpassword" placeholder="Enter new password" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <input type="password" class="form-control" name="confpassword" placeholder="Confirm password" required>
                  </div>
                    <input type="hidden" class="form-control" name="email" value="<?php echo $row['username'] ?>">
                </div>              
                  <?php }?>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="update_detail" class="btn btn-primary mn">Submit</button>
                </div>
              </form>
            </div>
            <div class='alert alert-warning alert-dismissible fade show' role='alert' style="border-radius: 0px;">
                               <strong><center>Update users' password using their email. User's Email - <?php echo $id; ?></center></strong>
                                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                               <span aria-hidden='true'>&times;</span>
                            </button></div>
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
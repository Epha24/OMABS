<?php

session_start();
$msg = "";
$fname_error = "";
$mname_error = "";
$lname_error = "";
$city_error = "";
$phone_error = "";
$position_error = "";
$emp_id_error = "";
$num_error = 0;
$img_error = "";
include '../conn.php';
include 'user.php';
include '../security.php';
 if($_SESSION['role'] != 'staff'){
     header("Location:../logout.php");
 }

if(isset($_POST['submit'])){
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $city = $_POST['city'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $position = $_POST['position'];
  $speciality = $_POST['speciality'];
  $emp_id = $_POST['emp_id'];
  $pic = $_FILES['pic']['name'];
  $imgTemp = $_FILES['pic']['tmp_name'];
  $imgError = $_FILES['pic']['error'];
  $imgSize = $_FILES['pic']['size'];
  $imgType = $_FILES['pic']['type'];
  $fileExt = explode('.', $pic);
  $fileActExt = strtolower(end($fileExt));

  $Allowed = array('jpg','jfif','jpeg','png');
    
  $folders = "../pic/doctor/";
    
  //  if(array_key_exists('phone', $_POST))
  // {
  //   if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $_POST['phone']))
  //   {
  //     $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  //                 <strong><center>Invalid phone</center></strong>
  //                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  //                      <span aria-hidden='true'>&times;</span>
  //                </button></div>";
  //   }
  // }

             if(!preg_match("/^[a-zA-Z ]*$/",$fname)){
                $fname_error = "<p class='text-danger'>Invalid First Name</p>";
                $num_error++;
             }
             if(!preg_match("/^[a-zA-Z ]*$/",$mname)){
                $mname_error = "<p class='text-danger'>Invalid Middle Name</p>";
                $num_error++;
             }
             if(!preg_match("/^[a-zA-Z ]*$/",$lname)){
                $lname_error = "<p class='text-danger'>Invalid Last Name</p>";
                $num_error++;
             }
             if(!preg_match("/^[a-zA-Z ]*$/",$city)){
                $city_error = "<p class='text-danger'>Invalid City</p>";
                $num_error++;
             }
             if(!preg_match("/^[a-zA-Z ]*$/",$fname)){
                $position_error = "<p class='text-danger'>Invalid Position</p>";
                $num_error++;
             }
             if(strlen($phone) < 10 || !ctype_digit($phone)){
                 $phone_error = "<p class='text-danger'>Invalid phone</p>";
                 $num_error++;
             }
             if(!in_array($fileActExt, $Allowed)){
                 $img_error = "<p class='text-danger'>You can not upload this kind of file.</p>";
                 $num_error++;
             }
             if(empty($speciality)){
              $speciality = null;
             }
         if($num_error == 0){

    $qry = "SELECT *FROM employee WHERE phone = '$phone' OR email = '$email' OR emp_id = '$emp_id'";
    $ext = mysqli_query($conn, $qry);
    $num = mysqli_num_rows($ext);

    $qry2 = "SELECT *FROM user WHERE email = '$email'";
    $ext2 = mysqli_query($conn, $qry);
    $num2 = mysqli_num_rows($ext);

    if($num > 0 || $num2 > 0){
      $msg = "<div class='alert alert-danger alert-dismissible fade show mn' role='alert' style='border-radius:0px;'>
                  <strong><center>Employee already Exists</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
    }else{
      move_uploaded_file($imgTemp,$folders.$pic);
      $insert = "INSERT INTO employee(emp_id,fname, mname, lname, address, phone, email, position, img, speciality) VALUES('$emp_id','$fname','$mname','$lname','$city','$phone','$email', '$position', '$pic', '$speciality')";
      $ext = mysqli_query($conn, $insert);
      if($ext){
        $msg = "<div class='alert alert-success alert-dismissible fade show mn' role='alert' style='border-radius:0px;'>
                  <strong><center>Successfully added</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
      }else{
        $msg = "<div class='alert alert-danger alert-dismissible fade show mn' role='alert' style='border-radius:0px;'>
                  <strong><center>Not added</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
      }
    }
  }
}
if(isset($_POST['update-detail'])){

  $id = $_POST['id'];
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $position = $_POST['position'];

  $update = "UPDATE employee SET fname = '$fname', mname = '$mname', lname = '$lname', address = '$address', phone = '$phone', email = '$email', position = '$position' WHERE emp_id = '$id'";
  $ext = mysqli_query($conn,$update);

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

?><!DOCTYPE html>
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
          <li class="nav-item has-treeview active">
            <a href="#" class="nav-link" id="act">
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
        <?php if(isset($_GET['add-employee'])){;?>
      <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> / </a><a href="#" style="cursor: unset;">Manage Employee / </a> <a href="#" style="cursor: unset;">Add Employee</a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        </div>
        </div> 
        <div class="row"> 
        <div class="col-md-3">
            <a href="employee.php?add_employee" class="btn btn-info btn-block mb-3 mn"><i class="fas fa-plus"></i> Add Employee</a>

            <div class="card mn">
              <div class="card-header">
                <h3 class="card-title">Manage Employee</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item active">
                    <a href="employee.php?add-employee" class="nav-link">
                      <i class="fas fa-plus"></i> Add Employee
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="employee.php?update-employee" class="nav-link">
                      <i class="far fa-edit"></i> Update Employee
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="employee.php?update-employee" class="nav-link">
                      <i class="far fa-trash-alt"></i> Delete Employee
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
                <h3 class="card-title">Add Employee</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="employee.php?add-employee" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                 <!--  <?=$msg ?> -->
                 <div class="form-row">
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required>
                    <?=$fname_error;?>
                  </div>
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="mname" placeholder="Enter Middle Name" required>
                    <?=$mname_error;?>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" required>
                    <?=$lname_error;?>
                  </div>
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="city" placeholder="Enter City" required>
                    <?=$city_error;?>
                  </div>
                </div>                
                <div class="form-row">                  
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" required>
                    <?=$phone_error;?>
                  </div>
                  <div class="form-group col-sm-6" id="email">
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-sm-6">
                  <select class="form-control" name="position" onchange="change_pos()" id="position">
                    <option selected="select" disabled="disabled">Select Position</option>
                    <option value="doctor">Doctor</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                  </select>
                  <?=$position_error;?>
                  </div>
                  <div class="form-group col-sm-6" id="email">
                    <input type="text" class="form-control" name="emp_id" placeholder="Enter Employee ID" required>
                    <?=$emp_id_error;?>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <input type="file" name="pic" class="form-control" required="">
                    <?=$img_error;?>
                  </div>
                  <div class="form-group col-sm-6" id="spec">
                  </div>
                </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary mn">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php }
      if(isset($_GET['update-employee'])){;?>
         <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> / </a><a href="#" style="cursor: unset;">Manage Employee / </a> <a href="#" style="cursor: unset;">Update Employee</a></li>
            </ol>
          </div>
        </div>
        </div>
        </div> 
        <?=$msg;?>
        <div class="card"> 
        <div class="card-header">
              <h3 class="card-title">Update Employee</h3>
              <a href="employee.php?add-employee" class="float-sm-right" title="Add New Employee"><i class="fa fa-plus"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped example1">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Position</th>
                  <th>Action</th>                  
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
                  <td id=""><?=$row['fname']." ".$row['mname']." ".$row['lname'];?></td>
                  <td id=""><?=$row['address'];?></td>
                  <td id=""><?=$row['phone'];?></td>
                  <td id=""><?=$row['email'];?></td>
                  <td id=""><?=$row['position'];?></td>
                  <td><a href="../action.php?delete-employee=<?php echo $row['emp_id'] ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" style="color: red;" title="Delete Employee"></i></a>&nbsp; | &nbsp; <a href="employee.php?update-detail=<?php echo $row['emp_id']; ?>"><i class="fa fa-edit" style="color: blue;" title="Update Employee"></i></a></td>
                  <?php $num++; ?>
                </tr>
              <?php }?>
                </tbody>
                <tfoot>
                <tr>
                 <th>No</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Position</th>
                  <th>Action</th> 
                </tr>
                </tfoot>
              </table>
            </div>
        </div>
      <?php } if(isset($_GET['update-detail'])){

        $id = $_GET['update-detail'];
        ?>
      <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> / </a><a href="#" style="cursor: unset;">Manage Employee / </a> <a href="#" style="cursor: unset;">Update Employee / </a> <a href="#" style="cursor: unset;">Update Detail / </a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        </div>
        </div> 
          <?=$msg;?>
        <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Update Detail</h3>
                <a href="employee.php?update-employee" class="float-sm-right" title="Update Employee"><i class="fa fa-edit"></i></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="employee.php?update-employee" method="POST">
                <div class="card-body">
                 <!--  <?=$msg ?> -->
                 <div class="form-row">
                  <input type="hidden" name="id" value="<?php echo $_GET['update-detail']?>">

                  <?php
                    $qry = "SELECT *FROM employee WHERE emp_id = '$id'";
                    $ext = mysqli_query($conn,$qry);
                    while($row = mysqli_fetch_array($ext)){
                  ?>
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="fname" value="<?php echo $row['fname']?>" placeholder="Enter First Name" required>
                  </div>
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="mname" value="<?php echo $row['mname']?>" placeholder="Enter Middle Name" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="lname" value="<?php echo $row['lname']?>" placeholder="Enter Last Name" required>
                  </div>
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $row['address']?>" placeholder="Enter City" required>
                  </div>
                </div>                
                <div class="form-row">                  
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']?>" id="phone" placeholder="Enter Phone" required>
                  </div>
                  <div class="form-group col-sm-6" id="email">
                    <input type="email" class="form-control" name="email" value="<?php echo $row['email']?>" placeholder="Enter Email" required>
                  </div>
                  <div class="form-group col-sm-6">
                  <select class="form-control" name="position">
                    <?php if($row['position'] == 'doctor') {?><option selected="selected" value="doctor">Doctor</option> <?php } else {?><option value="doctor">Doctor</option><?php } if($row['position'] == 'staff') {?><option selected="selected" value="staff">Staff</option><?php } else {?><option value="staff">Staff</option><?php } if($row['position'] == 'admin'){ ?> <option selected="selected" value="admin">Admin</option> <?php } else { ?><option value="admin">Admin</option> <?php } ?>
                  </select>
                </div>
                  <div class="form-group col-sm-6">
                  <input type="text" class="form-control" name="emp_id" value="<?php echo $row['emp_id']?>" placeholder="Enter Position" required>
                  </div>
                </div>
                  <?php }?>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="update-detail" class="btn btn-primary mn">Submit</button>
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
     alert(xmlhttp.responseText);
     document.getElementById("email").innerHTML = xmlhttp.responseText;
}
</script>
<script>
  function change_pos(){
     var xmlhttp = new XMLHttpRequest();
     var position = document.getElementById("position").value;
     xmlhttp.open("GET","../select.php?position="+position,false);     
     xmlhttp.send(null);
     document.getElementById("spec").innerHTML = xmlhttp.responseText;
}
</script>
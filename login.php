 <?php
    include'conn.php';
    $msg = "";
    $p = "";
    $pass = "";
    session_start();
    if(isset($_POST['login'])){
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);
      
    
      $sql = "SELECT *FROM user WHERE username = '".$username."'";
      $result = mysqli_query($conn,$sql);
      $num = mysqli_num_rows($result);
    if($num > 0){ while($row = mysqli_fetch_array($result)){

       if($row['status'] == "Inactive"){
        $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>You account has been disabled. Please contact admin</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
       }else{

      $pass = md5($password);
      if($row['password'] == $pass){
    if($row['role'] == "doctor"){
      $_SESSION['username'] = $row['username'];
      $_SESSION['role'] = $row['role'];
      header('Location:doctor/index.php');
    }
    if($row['role'] == "patient"){
      $_SESSION['username'] = $row['username'];
      $_SESSION['role'] = $row['role'];
      header('Location:patient/index.php');
    }
    else if($row['role'] == "admin"){
      $_SESSION['username'] = $row['username'];
      $_SESSION['role'] = $row['role'];
      header('Location:admin/index.php');
    }
    else if($row['role'] == "staff"){
      $_SESSION['username'] = $row['username'];
      $_SESSION['role'] = $row['role'];
      header('Location:staff/index.php');
    }
  }else{
     $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Incorrect Password</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
  }
  }
}
}
  else{
         $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius:0px;'>
                  <strong><center>Incorrect Email</center></strong>
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
  <title>Log In | Arba Minch LMIS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">
    .login-page{
         background:url(pic/page-banner-7.jpg);
         background-repeat: no-repeat;
         background-size: cover;
         background-position: center;
       }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php" title="Online Medical Appointment Booking System"><b> Arba Minch </b>OMABS</a>
  </div>
  <!-- /.login-logo -->
  <?=$msg;?>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required style="border-radius: 0px;">
          <div class="input-group-append">
            <div class="input-group-text" style="border-radius: 0px;">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required style="border-radius: 0px;">
          <div class="input-group-append">
            <div class="input-group-text" style="border-radius: 0px;">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block" style="border-radius: 0px;">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1">
        <a href="forgot-password.php">I forgot my password</a>
      </p>
      <!--<p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>-->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>

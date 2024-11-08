<?php

include'conn.php';
$msg = "";

if(isset($_POST['register'])){

  if(empty($_POST['email']) || empty($_POST['password'])){
      $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius: 0px;'>
                  <strong><center>Please Fill All Filds</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
        }else{

             $email = mysqli_escape_string($conn,$_POST['email']);
             $password = mysqli_escape_string($conn,$_POST['password']);
             $confpassword = mysqli_escape_string($conn,$_POST['confpassword']);

             if($password != $confpassword){
              $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius: 0px;'>
                  <strong><center>Password do not match</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
             }else if(strlen($password) < 7){

                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius: 0px;'>
                  <strong><center>Password length should be greater than 6</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";

             }else{

              $enc_password = md5($password);
              $role = "patient";
              $status = "Inactive";
              $chech_qry = "SELECT *FROM user WHERE username = '$email'";
              $ext_chech = mysqli_query($conn,$chech_qry);
              $num = mysqli_num_rows($ext_chech);
              if($num > 0){
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius: 0px;'>
                  <strong><center>User Already Exists</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
              }else{
              $qry_insert = "INSERT INTO user VALUES('$email', '$enc_password','$role','$status')";
              $ext = mysqli_query($conn,$qry_insert);

              if($ext){
                 $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='border-radius: 0px;'>
                  <strong><center>Request has been sent successfully</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
              }else{
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='border-radius: 0px;'>
                  <strong><center>Not Sent</center></strong>
                       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                 </button></div>";
              }
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
  <title>Arba Minch OMABS | Registration Page</title>
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
    .register-page{
         background:url(pic/page-banner-7.jpg);
         background-repeat: no-repeat;
         background-size: cover;
         background-position: center;
       }
  </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="index.php"><b>Arba Minch </b> OMABS</a>
  </div>
   <?=$msg;?>
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="register.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required style="border-radius: 0px;">
          <div class="input-group-append">
            <div class="input-group-text" style="border-radius: 0px;">
              <span class="fas fa-envelope"></span>
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
        <div class="input-group mb-3">
          <input type="password" name="confpassword" class="form-control" placeholder="Retype password" required style="border-radius: 0px;">
          <div class="input-group-append">
            <div class="input-group-text" style="border-radius: 0px;">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="register" class="btn btn-primary btn-block" style="border-radius: 0px;">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

<?php
include'conn.php';
// require'config_api.php';
$msg = "";
$msg2 = "";
$cred = "";
$phone2 = "";
$schedule = "";

$fname_error = "";
$mname_error = "";
$lname_error = "";
$phone_error = "";
$city_error = "";
$zone_error = "";
$woreda_error = "";
$kebele_error = "";
$acc_error = "";
$num_error = 0;

if(isset($_POST['checkin'])){
  
  $fname = mysqli_real_escape_string($conn,$_POST['fname']);
  $mname = mysqli_real_escape_string($conn,$_POST['mname']);
  $lname = mysqli_real_escape_string($conn,$_POST['lname']);
  $phone = mysqli_real_escape_string($conn,$_POST['phone']);
  $city = mysqli_real_escape_string($conn,$_POST['city']);
  $zone = mysqli_real_escape_string($conn,$_POST['zone']);
  $woreda = mysqli_real_escape_string($conn,$_POST['woreda']);
  $kebele = mysqli_real_escape_string($conn,$_POST['kebele']);
  $acc_number = mysqli_real_escape_string($conn,$_POST['acc_number']);
  $id = mysqli_real_escape_string($conn,$_POST['id']);
  $tarif = mysqli_real_escape_string($conn,$_POST['tarif']);

  if(!preg_match("/^[a-zA-Z ]*$/",$fname)){
                $fname_error = "<p class='text-danger'>Invalid First Name</p>";
                $num_error++;
                $msg2 = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>Not Reserved</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
             }
             if(!preg_match("/^[a-zA-Z ]*$/",$mname)){
                $mname_error = "<p class='text-danger'>Invalid Middle Name</p>";
                $num_error++;
                $msg2 = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>Not Reserved</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
             }
             if(!preg_match("/^[a-zA-Z ]*$/",$lname)){
                $lname_error = "<p class='text-danger'>Invalid Last Name</p>";
                $num_error++;
                $msg2 = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>Not Reserved</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
             }
             if(strlen($phone) < 10 || !ctype_digit($phone)){
                 $phone_error = "<p class='text-danger'>Invalid phone</p>";
                 $num_error++;
                 $msg2 = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>Not Reserved</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
             }
             if(!preg_match("/^[a-zA-Z ]*$/",$city)){
                $city_error = "<p class='text-danger'>Invalid City</p>";
                $num_error++;
                $msg2 = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>Not Reserved</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
             }
             if(!preg_match("/^[a-zA-Z ]*$/",$zone)){
                $zone_error = "<p class='text-danger'>Invalid Zone</p>";
                $num_error++;
                $msg2 = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>Not Reserved</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
             }if(!preg_match("/^[a-zA-Z ]*$/",$woreda)){
                $woreda_error = "<p class='text-danger'>Invalid Wereda</p>";
                $num_error++;
                $msg2 = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>Not Reserved</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
             }if(!preg_match("/^[a-zA-Z ]*$/",$kebele)){
                $kebele_error = "<p class='text-danger'>Invalid Kebele</p>";
                $num_error++;
                $msg2 = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>Not Reserved</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
             }if(!(is_numeric($_POST['acc_number']))){
                $acc_error = "<p class='text-danger'>Invalid Account Number</p>";
                $num_error++;
                $msg2 = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>Not Reserved</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
             } if($num_error == 0){

  $qry_check = "SELECT balance FROM bank_account WHERE account_number = '$acc_number'";
  $ext = mysqli_query($conn,$qry_check);
  $num = mysqli_num_rows($ext);

  if($num == 0){
    $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>Account Not Exist</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
  }else{

  $qry_check_balance = "SELECT balance FROM bank_account WHERE account_number = '$acc_number' AND balance > '$tarif'";
  $ext_balance = mysqli_query($conn,$qry_check_balance);
  $num = mysqli_num_rows($ext_balance);

  if($num == 0){
    $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>Insufficient balance</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
  }else{

    $res = "SELECT schedule FROM reserve WHERE schedule = '$id'";
    $ext_res = mysqli_query($conn,$res);
    $num_res = mysqli_num_rows($ext_res);
    $seat = $num_res + 1;
     
     while($row = mysqli_fetch_array($ext)){
       
       $cre = $row['balance'] - $tarif;
         
       $update = "UPDATE bank_account SET balance = '$cre' WHERE account_number = '$acc_number'";
       $ext_update = mysqli_query($conn,$update);  

       $insert = "INSERT INTO reserve(fname,mname,lname,phone,city,zone,woreda,kebele,schedule,seat) VALUES('$fname','$mname','$lname','$phone','$city','$zone','$woreda','$kebele','$id','$seat')";
       $result = mysqli_query($conn,$insert);
       if($result){
        $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                   <strong><center>Successfully Reserved</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
                  $phone2 = $phone;
                  $schedule = $id;
       }else{
        $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong><center>Not Reserved</center></strong>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                  </button></div>";
       }
     }
     }
  }
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home | Arba Minch OMABS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/icon" href="pic/logo.jpg">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css.style.css">
  <link rel="stylesheet" type="text/css" href="css.style.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <!-- DataTable -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTable -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn/js.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAegi-gvPpygGwfl_tIaZyn2o2UmFmb7kA&callback=initMap"
  type="text/javascript"></script>


<!--<script type="text/javascript">
    
     x = navigator.geolocation;
     x.getCurrentPosition(success, failure);
      
      function success(position){
        var myLat = position.coords.latitude;
        var myLong = postion.coords.longitude;

        var coords = new google.maps.Lating(myLat, myLong);

        var mapOptions = {

          zoom:9,
          center: coords,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var marker = new google.maps.Marker({map:map, position:coords});
      }
      function failure(){}

  </script>-->

	<style type="text/css">
		.navbar-brand img{
      border-radius: 50%;
    }
    .navbar{
      border-bottom:1px solid #c9c6bb;
    }
  .navbar a{
       font-size: 21px;
      font-family: "Times New Roman", Times, serif;
      font-style:bold;
		}
		.text1{
		 font-family: fantasy;
		 font-size: 30px;
     margin-top: 19%;
     marg/in-left: 30%;
     color:white;
     text-align: center;
		}
    .text2{
     font-family: "Times New Roman", Times, serif;;
     font-weight: 70;
     margin-top: 5%;
     margin-left: 47%;
     color:white;
    }
    .btn-danger{
      padding:5px 10px 5px 10px;
      font-size: 22px;
    }
		.container-fluid{
         padding-bottom: 30px;
         padding-top: 20px;
         background:url(pic/c5.jpg);
         background-repeat: no-repeat;
         background-size: cover;
         background-position: center;
         height: 561px;
       }
       .card, .card-header, .card-body{
        border-radius: 0px;
       }
       #ma/p{
        width: 400px;
        height: 200px;
       }
	</style>
  
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-light">
  <a class="navbar-brand" href="index.php" title="Online Medical Appointment Booking System"><span class="header">&nbsp;&nbsp; <i class="fa fa-hospital" style="color: orange;"></i> OMABS</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-danger" href="index.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about-us.php">About Us</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="news.php">News</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="contact-us.php">Contact Us</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="help.php">Help</a>
    </li>
  </ul>
    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="login.php"><span class="text-secondary"><i class="fa fa-sign-in"></i> Login</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php"><span class="text-secondary"><i class="fa fa-user-plus"></i> Register</span></a>
      </li>
    </ul>
  </div>
</nav>
	<div class="container-fluid"> 
		
      <div class="text1">Welcome To Arba Minch Online Medical Appointment Booking System</div>
      <div><span class="text2"><a href="contact-us.php" class="btn btn-danger">Contact Us</a></span></div>
	</div>
  <div class="container">
      <!--<div class="row">
      <div class="alert alert-success alert-dismissible fade show col-sm-7 ml-2 mr-3" role="alert">
             <strong>Hello Welcome!</strong> You can search using departure and destination city and reserve.
    </div>
  </div>-->
  <div>
  <br><br><br>
  <section class="about-us">
    <h1 style="font-size: 45px; font-style: bold; font-weight: 900;"><center>About Us</center></h1>
    <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50">
                        <h3>Welcome to Arba Minch OMABS </h3>
                    </div> <!-- section title -->
                    <div class="about-cont">
                        <p align="justify">This website provides all the information of the several clinics located in Gamo Gofa Zone. This website also a many clinic appointment system site </b>that providing health care for out-patients all around AMU is located at the heart of AM city. They are Multi speciality Clinics like Abaya, Selam, Betelehem, Grand, Elshaday, Kulufo, Nibil, St Gebreal, Asha, Abriham, First Level Womens etc..., offering a wide range of health care services under a single roof, was by speciality Doctors.</p>
                    </div>
                </div> <!-- about cont -->
                <div class="col-lg-7">
                    <div class="about-image mt-50">
                        <img src="pic/c7.jpg" alt="About" style="height: 300px; width:100%">
                    </div>  <!-- about imag -->
                </div> 
            </div> <!-- row -->
  </section>
  <br><br><br>
  <h1 style="font-size: 45px; font-style: bold; font-weight: 900;"><center>Specialities</center></h1>
  <br>
  <div class="row">
    <div class="col-6">
      <a href="#" class="card-link">
      <div class="card pt-2 pb-2">
        <div class="card-body">
          <h3><center>Micro-Ear Surgery</center></h3>
        </div>
      </div>
    </a>
    </div>
    <div class="col-6">
      <a href="#">
      <div class="card pt-2 pb-2">
        <div class="card-body">
          <h3><center>Micro-Laryngeal Surgery</center></h3>
        </div>
      </div>
    </a>
    </div>
  </div>
  <div class="row">
    <div class="col-6">
      <a href="#">
      <div class="card pt-2 pb-2">
        <div class="card-body">
          <h3><center>Laser ENT Surgery</center></h3>
        </div>
      </div>
    </a>
    </div>
    <div class="col-6">
      <a href="#">
      <div class="card pt-2 pb-2">
        <div class="card-body">
          <h3><center>Thyroid Surgery</center></h3>
        </div>
      </div>
     </a>
      </div>
    </div>
  </div>  
  </div>
  <br>
  <h1 style="font-size: 45px; font-style: bold; font-weight: 900;"><center>Doctors</center></h1>
  <br>
  <div class="container">
  <div class="carousel slide" data-ride="carousel" id="multi_item">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="row">
          <div class="col-sm"><img class="d-block w-100" src="//www.tutsmake.com/wp-content/uploads/2019/03/install-sublime-on-ubunut.jpeg" alt="1 slide"></div>
          <div class="col-sm"><img class="d-block w-100" src="//www.tutsmake.com/wp-content/uploads/2019/03/boostrap-datetimepicker.jpeg" alt="2 slide"></div>
          <div class="col-sm"><img class="d-block w-100" src="//www.tutsmake.com/wp-content/uploads/2019/03/laravel-razorpay-payment.jpeg" alt="3 slide"></div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="row">
          <div class="col-sm"><img class="d-block w-100" src="//www.tutsmake.com/wp-content/uploads/2019/03/install-sublime-on-ubunut.jpeg" alt="4 slide"></div>
          <div class="col-sm"><img class="d-block w-100" src="//www.tutsmake.com/wp-content/uploads/2019/03/boostrap-datetimepicker.jpeg" alt="5 slide"></div>
          <div class="col-sm"><img class="d-block w-100" src="//www.tutsmake.com/wp-content/uploads/2019/03/laravel-razorpay-payment.jpeg" alt="6 slide"></div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#multi_item" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#multi_item" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<br><br>
  <div class="container">
    <div class="card text-center pt-2 pb-2 "><?php echo date("Y")?> &copy; All rights Reserved</div>
  </div>
  <script src="https://js.str/ipe.com/v3/"></script>
</body>
</html>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->

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
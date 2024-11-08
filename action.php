<?php 
include 'conn.php';
session_start();
if(isset($_GET['delete-route'])){
	$id = $_GET['delete-route'];
	mysqli_query($conn, "DELETE FROM route WHERE id = '$id'");
	$msg = '<div class="alert alert-success"> Successfully Deleted</div>';
	header('Location:employee/route.php?edit-route');

}

if(isset($_GET['delete-bus'])){
	$id = $_GET['delete-bus'];
	mysqli_query($conn, "DELETE FROM bus WHERE pnumber = '$id'");
	$msg = '<div class="alert alert-danger"> Your Account has been disabled, please contact admin</div>';
	header('Location:employee/bus.php?edit-bus');

}
if(isset($_GET['delete-schedule'])){
	$id = $_GET['delete-schedule'];
	mysqli_query($conn, "DELETE FROM schedule WHERE id = '$id'");
	$msg = '<div class="alert alert-danger"> Your Account has been disabled, please contact admin</div>';
	header('Location:employee/schedule.php?edit-schedule');

}
if(isset($_GET['delete-account'])){
	$id = $_GET['delete-account'];
	mysqli_query($conn, "DELETE FROM user WHERE username = '$id'");
	$msg = '<div class="alert alert-danger"> Your Account has been disabled, please contact admin</div>';
	header('Location:admin/account.php?update_account');

}
if(isset($_GET['delete-employee'])){
	$id = $_GET['delete-employee'];
	mysqli_query($conn, "DELETE FROM employee WHERE emp_id = '$id'");
	$msg = '<div class="alert alert-danger"> Your Account has been disabled, please contact admin</div>';
	header('Location:staff/employee.php?update-employee');

}
if(isset($_GET['change-status'])){
	
	$active = 'Active';
	$Inactive = 'Inactive';
	$id = $_GET['change-status'];
	$qry = "SELECT *FROM user WHERE username = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			$qry_update = "UPDATE user SET status = '$Inactive' WHERE username = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/account.php?update_account');
		} if($row['status'] == $Inactive){
			$qry_update = "UPDATE user SET status = '$active' WHERE username = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:admin/account.php?update_account');
		}
	}

}
if(isset($_GET['change-schedule-status'])){
	
	$active = 'Active';
	$Inactive = 'Inactive';
	$id = $_GET['change-schedule-status'];
	$qry = "SELECT *FROM schedule WHERE pnumber = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			$qry_update = "UPDATE schedule SET status = '$Inactive' WHERE pnumber = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:employee/schedule.php?edit-schedule');
		} if($row['status'] == $Inactive){
			$qry_update = "UPDATE schedule SET status = '$active' WHERE pnumber = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:employee/schedule.php?edit-schedule');
		}
	}

}
if(isset($_GET['change-owner-ass-status'])){
	
	$active = 'Active';
	$Inactive = 'Inactive';
	$id = $_GET['change-owner-ass-status'];
	$qry = "SELECT *FROM owner_association WHERE op_id = '$id'";
	$ext = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($ext)){

		if($row['status'] == $active){
			$qry_update = "UPDATE owner_association SET status = '$Inactive' WHERE op_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:manager/request.php');
		} if($row['status'] == $Inactive){
			$qry_update = "UPDATE owner_association SET status = '$active' WHERE op_id = '$id'";
			$extup = mysqli_query($conn,$qry_update);
			header('Location:manager/request.php');
		}
	}

}
if(isset($_GET['delete-owner'])){
	$id = $_GET['delete-owner'];
	mysqli_query($conn, "DELETE FROM owner WHERE id = '$id'");
	$msg = '<div class="alert alert-danger"> Your Account has been disabled, please contact admin</div>';
	header('Location:employee/owner.php?update-owner');

}
if(isset($_GET['delete-admin-report'])){
	$id = $_GET['delete-admin-report'];
	mysqli_query($conn, "DELETE FROM report WHERE id = '$id'");
	header('Location:admin/report.php?sent');

}
if(isset($_GET['delete-manager-report'])){
	$id = $_GET['delete-manager-report'];
	mysqli_query($conn, "DELETE FROM report WHERE id = '$id'");
	header('Location:manager/report.php?sent');

}

if(isset($_GET['delete-rs'])){
	$id = $_GET['delete-rs'];
	mysqli_query($conn, "DELETE FROM bus_owner WHERE id = '$id'");
	header('Location:employee/bus_owner.php?edit');

}
if(isset($_GET['de_active'])){
	$id = $_GET['de_active'];
	$act = "active";
	mysqli_query($conn, "UPDATE user SET active = '$act' WHERE  id = '$id' AND role != 'admin'");
	header('Location:delete_account.php');

}
if(isset($_GET['delete-city'])){
	$id = $_GET['delete-city'];
	mysqli_query($conn, "DELETE FROM city WHERE id = '$id'");
	header('Location:employee/city.php?edit-city');

}
if(isset($_GET['delete-bus-model'])){
	$id = $_GET['delete-bus-model'];
	mysqli_query($conn, "DELETE FROM model WHERE id = '$id'");
	header('Location:employee/model.php?edit-bus-model');

}
if(isset($_GET['delete-association'])){
	$id = $_GET['delete-association'];
	mysqli_query($conn, "DELETE FROM association WHERE id = '$id'");
	header('Location:employee/association.php?edit-association');

}
if(isset($_GET['delete-owner-association'])){
	$id = $_GET['delete-owner-association'];
	mysqli_query($conn, "DELETE FROM owner_association WHERE op_id = '$id'");
	header('Location:employee/association.php?edit-owner-association');

}

if(isset($_GET['delete-driver'])){
	$id = $_GET['delete-driver'];
	mysqli_query($conn, "DELETE FROM driver WHERE id = '$id'");
	header('Location:employee/driver.php?update-driver');

}
if(isset($_GET['delete-comment'])){
	$id = $_GET['delete-comment'];
	mysqli_query($conn, "DELETE FROM contact_us WHERE id = '$id'");
	header('Location:admin/comment.php');

}
if(isset($_GET['delete-reseretion'])){
	$id = $_GET['delete-reseretion'];
	mysqli_query($conn, "DELETE FROM reserve WHERE id = '$id'");
	header('Location:employee/reserved-passengers.php');

}
?>
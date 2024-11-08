<?php

include 'conn.php';

if(isset($_GET['dep'])){

	$dep = $_GET['dep'];

	if($dep == "patient"){
		echo "<input type='email' name='email' class='form-control' placeholder='Enter Patient Email' required>";
	} else if($dep == "admin"){
	    $qry = "SELECT *FROM employee WHERE position = 'admin'";
		$ext = mysqli_query($conn,$qry);
		echo "<select class='form-control' name='email'>";
		echo "<option selected='selected' disabled='disabled'>Select Email</option>";
		while($row = mysqli_fetch_array($ext)){
			echo "<option>".$row['email']."</option>";
		}
		echo "</select>";
	}
	else{
		if($dep = 'doctor')
		$qry = "SELECT *FROM employee WHERE position = 'doctor'";
		$ext = mysqli_query($conn,$qry);
		echo "<select class='form-control' name='email'>";
		echo "<option selected='selected' disabled='disabled'>Select Email</option>";
		while($row = mysqli_fetch_array($ext)){
			echo "<option>".$row['email']."</option>";
		}
		echo "</select>";

	}
}

if(isset($_GET['position'])){
	if($_GET['position'] == "doctor"){
		echo "<input type='text' name='speciality' class='form-control' placeholder='Enter doctor speciality' required >";
	}else{
		echo "";
	}
}


?>
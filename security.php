<?php

if(!isset($_SESSION['email']) && !isset($_SESSION['role'])){
	header("Location:login.php");
}

?>
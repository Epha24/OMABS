<?php 
function user(){

$conn = mysqli_connect("localhost", "root","","omabs");

$select = "SELECT fname, mname FROM employee WHERE email = '".$_SESSION['username']."'";
$ext = mysqli_query($conn, $select);

while($row = mysqli_fetch_array($ext)){
	return ($row['fname']." ".$row['mname']);

}
}


?>
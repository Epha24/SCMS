<?php 
function user(){

$conn = mysqli_connect("localhost", "root","","clearance");

$select = "SELECT fname, mname FROM student WHERE user_name = '".$_SESSION['user_name']."'";
$ext = mysqli_query($conn, $select);

while($row = mysqli_fetch_array($ext)){
	return ($row['fname']." ".$row['mname']);

}
}


?>
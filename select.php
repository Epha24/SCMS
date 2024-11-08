<?php

include 'conn.php';

if(isset($_GET['role'])){

	$role = $_GET['role'];

	if($role == "department head"){

        $qry = "SELECT *FROM department";
		$ext = mysqli_query($conn,$qry);
		echo "<label>Department : </label>
		<div class='form-group col-sm-12' id='dep' name='dep'>
		<select class='form-control' name='dep' id='dep'>";
		echo "<option selected='selected' disabled='disabled'>Select Department</option>";
		while($row = mysqli_fetch_array($ext)){
			echo "<option value='".$row['dep_id']."'>".$row['department']."</option>";
		}
		echo "</select></div>";
	}
	else{
		echo '<div class="form-group col-sm-6" id="dep" name="dep">
                  </div>';

	}
}

?>
<?php

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'magang';

	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	if($conn->connect_error){
		die('Connection Error :'.$conn->connect_error);
	}
	
if($_POST){
	$nik = $_POST['txt_nik'];
	$fname = $_POST['txt_fname'];
	$lname = $_POST['txt_lname'];
	$email = $_POST['txt_email'];
	$phno = $_POST['txt_mobile'];
	$postion = $_POST['txt_position'];
	$division = $_POST['txt_division'];


	$sql = "INSERT INTO biodata_it (nik, fname, lname, email, phone, position, division) VALUES('$nik','$fname', '$lname', '$email','$phno','$postion','$division')";

	if($conn->query($sql)){

		?>
		<div class="alert alert-info">
			<strong>Data Submitted Successfully</strong>
		</div>
		<?php
	}else{

		?>
		<div class="alert alert-danger">
			<strong>Failed Submit Data</strong>
		</div>

		<?php
	}
}
$conn->close();


?>



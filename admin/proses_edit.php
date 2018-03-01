<?php
	include "dbconfig.php";
	
	$nik = $_POST['nik'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$position = $_POST['position'];
	$division = $_POST['division'];
	$modal=mysqli_query($conn,"UPDATE biodata_it SET fname = '$fname',lname = '$lname',email = '$email',phone = '$phone',position = '$position',division = '$division' WHERE nik = '$nik'");
	header('location:admin.php');

	$response = array(
			'status'=>'sukses', // Set status
			'pesan'=>'Data berhasil diubah', // Set pesan
			'html'=>$html // Set html
		);

		$response = array(
			'status'=>'gagal', // Set status
			'pesan'=>'Gambar gagal untuk diupload', // Set pesan
		);

?>
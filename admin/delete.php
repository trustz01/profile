<?php

	require_once 'dbconfig.php';
	
	if ($_REQUEST['delete']) {
		
		$id = $_REQUEST['delete'];
		$query = "DELETE FROM biodata_it WHERE id='$id'";
		$stmt = $DBcon->prepare( $query );
		$stmt->execute(array('id'=>$id));
		
		if ($stmt) {
			echo "Data Deleted Successfully!";
		}
		
	}

	
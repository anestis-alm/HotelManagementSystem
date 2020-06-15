<?php
	session_start();
	session_regenerate_id();
			

	include '../db_connection.php';	

	
	
	
		$username = $_GET['username'];
		$result  = mysqli_query($db , "UPDATE user SET rights='user'WHERE username='$username'");
		header('location: ../index.php?verif=true' );
		
?>
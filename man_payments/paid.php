<?php

session_start();
session_regenerate_id();
 include '../db_connection.php'; 


if (isset($_POST['insert_paid'])){	
		
		
		$name = mysqli_real_escape_string($db,$_POST['name']);
		$phone = mysqli_real_escape_string($db,$_POST['phone']);
		$iban = mysqli_real_escape_string($db,$_POST['iban']);	
		$role = mysqli_real_escape_string($db,$_POST['role']);
		
			
			$sql = "INSERT INTO paid ( name , phone , iban, role) 
					VALUES ('$name','$phone','$iban','$role')";
			

		
			
			
		mysqli_query($db, $sql);
		
	header('location: ../index.php' );	
	
	
	}
	
	?>
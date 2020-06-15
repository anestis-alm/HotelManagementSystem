<?php
include '../db_connection.php'; 


if(isset($_POST['name'])){
	
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$iban = $_POST['iban'];
	$role = $_POST['role'];
	$id = $_POST['id'];
	
		$result  = mysqli_query($db , "UPDATE paid SET name='$name',phone='$phone',iban='$iban',role='$role'
								WHERE id_paid='$id'");

	if($result){
		echo 'data updated';
	}else{
		echo mysqli_error($db);
	}	
}
?>
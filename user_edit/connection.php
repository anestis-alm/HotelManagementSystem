<?php
include '../db_connection.php'; 


if(isset($_POST['email'])){
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$rights = $_POST['rights'];
	$id = $_POST['id'];
	

		$result  = mysqli_query($db , "UPDATE user SET name='$name',email='$email',password='$password',rights='$rights'
								WHERE user_id='$id'");
	
	if($result){
		echo 'data updated';
	}else{
		echo mysqli_error($db);
	}	
}
?>
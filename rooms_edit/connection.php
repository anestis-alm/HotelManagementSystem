<?php
include '../db_connection.php'; 


if(isset($_POST['type'])){
	
	$type = $_POST['type'];
	$title = $_POST['title'];
	$price = $_POST['price'];
	$price_break = $_POST['price_break'];
	$price_canc = $_POST['price_canc'];
	$description = $_POST['description'];
	$id = $_POST['id'];
	
	
		$result  = mysqli_query($db , "UPDATE room SET type='$type',title='$title',price='$price',price_break='$price_break',price_canc='$price_canc',description='$description'
								WHERE room_number='$id'");
	
	if($result){
		echo 'data updated';
	}else{
		echo mysqli_error($db);
	}	
}
?>
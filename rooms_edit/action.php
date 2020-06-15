<?php
include '../db_connection.php'; 


if(isset($_POST['room_number'])){
	$room_number = $_POST['room_number'];
	$type = $_POST['type'];
	$title = $_POST['title'];
	$price = $_POST['price'];
	$price_break = $_POST['price_break'];
	$price_canc = $_POST['price_canc'];
	$description = $_POST['description'];
	
		$sql = "INSERT INTO room (room_number, type, title,price,price_break,price_canc,description) 
				VALUES ('$room_number', '$type','$title','$price','$price_break','$price_canc','$description')";
	
mysqli_query($db, $sql);	
}
?>
<?php

include '../db_connection.php'; 


if(isSet($_POST['username']))
{
$username = $_POST['username'];


$query = "SELECT * FROM user WHERE username = '$username'";
			$result=mysqli_query($db, $query);
			if (mysqli_num_rows($result))
			{
				echo '<font color="white">Το όνομα χρήτη <STRONG>'.$username.'</STRONG> υπάρχει ήδη.</font>';
			}


}

if(isSet($_POST['email']))
{
$email = $_POST['email'];


$query = "SELECT * FROM user WHERE email = '$email'";
			$result=mysqli_query($db, $query);
			if (mysqli_num_rows($result))
			{
				echo '<font color="white">Η διεύθυνση email <STRONG>'.$email.'</STRONG> υπάρχει ήδη.</font>';
			}


}

?>
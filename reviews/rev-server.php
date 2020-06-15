<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
	background-color: #F4F4FD;
    background-image: url("../img/logo.png");
	background-repeat: no-repeat;
	background-position: center top;
}

.loader {
  position: relative;
  left: 50%;
  top: 580px;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}



.bottom h2{
	font-family: Verdana;
	color: #000066;
	padding: 700px 0;
    text-align: center;
}
</style>
</head>
<body>

<div class="loader"></div>
<div class="bottom">
<h2><b>Η κριτική σας κατοχυρώθηκε με επιτυχία!</b></h2>
</div>

</body>
</html>

<?php

	session_start();
	session_regenerate_id();	
	include '../db_connection.php'; 
	
	

	if (isset($_POST['submit'])){
		
		$Rating= $_POST['rate'];
		$Title=$_POST['tit_rev'];
		$Review=$_POST['rev_rev'];
		$usr=$_SESSION['username'];
		

		
		$sql = "INSERT INTO reviews ( rating, title, review, date, username ) 
					VALUES ('$Rating', '$Title', '$Review', now(), '$usr')";


			mysqli_query($db, $sql);
			
		
		header( "refresh:4;../index.php" );
			
			
		
	}
		
?>
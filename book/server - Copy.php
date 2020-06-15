<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
	background-color: #F4F4FD;
    background-image: url("logo.png");
	background-repeat: no-repeat;
    background-position: center top; 
}

.loader {
  position: relative;
  left: 50%;
  top: 480px;
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
	padding: 500px 0;
    text-align: center;
}
</style>
</head>
<body>

<div class="loader"></div>
<div class="bottom">
<h2><b>Η κράτηση σας καταχωρήθηκε με επιτυχία! </br> Σας έχει σταλεί email με την απόδειξη σας! </br> Ευχαριστούμε για την προτίμηση σας!</b></h2>
</div>

</body>
</html>

<?php

	session_start();
	session_regenerate_id();
	include '../db_connection.php'; 
	
	if (isset($_POST['submit'])){
		$Name = mysqli_real_escape_string($db,$_POST['name']);
		$Lastname = mysqli_real_escape_string($db,$_POST['lastname']);
		$Email = mysqli_real_escape_string($db,$_POST['email']);
		$Address = mysqli_real_escape_string($db,$_POST['address']);
		$Telephone = mysqli_real_escape_string($db,$_POST['telephone']);
		$Comments = mysqli_real_escape_string($db,$_POST['comments']);
		$Invoice_type= $_POST['type'];
		$Rec_name=$_POST['rec_name'];
		$Rec_afm=$_POST['rec_afm'];
		$Rec_doy=$_POST['rec_doy'];
		$Rec_address=$_POST['rec_address'];
		$Rec_tax=$_POST['rec_tax'];
		$Rec_city=$_POST['rec_city'];
		$Rec_country=$_POST['rec_country'];
		
		
		
		$Start_date = $_SESSION['Start_date'];
		$End_date = $_SESSION['End_date'];
		$Type = $_SESSION['Type'];
		$Room_number = $_SESSION['room_number'];
		$Final_pirce = $_SESSION['final_price'];
		$price = $_SESSION['price'];
	    $payment = $_POST['payment'];
		$breakfast=$_SESSION['breakfast'];
		$cancel=$_SESSION['cancel'];
	
		
			$usr=$_SESSION['username']; 
			
			$sqli = "SELECT name FROM user WHERE username='$usr'";
			$sqldat = mysqli_query($db,$sqli) or die("error");
			
			while($row = mysqli_fetch_array($sqldat,MYSQLI_ASSOC)){ 
					
					$fullname=$row['name'];
			
			}
			
			$sql_c = "SELECT * FROM customer WHERE username='$usr'";
			$res_c = mysqli_query($db,$sql_c) or die("error");
			
			if (mysqli_num_rows($res_c) == 0) {
			$query = "INSERT INTO customer (username, name)
					 VALUES ('$usr','$fullname')";
			
			mysqli_query($db, $query);
			
			}
			
			$sql = "INSERT INTO reservation (start_date , end_date , username, room_number , price, final_price, r_fname, r_lname, r_address, r_email ,telephone, r_comments, pay, breakfast, cancel ) 
					VALUES ('$Start_date', '$End_date', '$usr','$Room_number' , '$price', '$Final_pirce' , '$Name', '$Lastname', '$Address', '$Email', '$Telephone', '$Comments', '$payment' , '$breakfast', '$cancel')";
					

			mysqli_query($db, $sql);
			$last_id = mysqli_insert_id($db);
			
	
			
			
			if ($Invoice_type == 'receipt' ) {
				$sql_t = "INSERT INTO receipt (id_reserv, type ,res_date)
						 VALUES ('$last_id', '$Invoice_type' , CURDATE())";			
			}else if ($Invoice_type == 'invoice' ){
				$sql_t = "INSERT INTO receipt (id_reserv, type, res_date, r_name, afm, doy, address, tk, city, country)
						 VALUES ('$last_id', '$Invoice_type', CURDATE(),'$Rec_name', '$Rec_afm', '$Rec_doy', '$Rec_address', '$Rec_tax', '$Rec_city', '$Rec_country')";
					
			}
				
			mysqli_query($db, $sql_t);
			
			
			header( "refresh:3;invoice.php?id=".$last_id."" );
		}
		
?>
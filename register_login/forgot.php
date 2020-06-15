<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/login_style.css">
  </head>
  <body>
<div class="login-box">
	  <h2>Ορισμός νέου κωδικού</h2>
  <form  id="forgot" action="server.php" method="POST" >
	 
	  <div class="textbox">
		<i class="fas fa-user"></i>
		<input type="text"  placeholder="Όνομα χρήστη" id="user" name="user" autocomplete="off"  spellcheck="false" required>
	  </div>
	  
	  <div class="textbox">
		<i class="fas fa-envelope"></i>
		<input type="email" id="email" name="email" placeholder="Διεύθυνση Email" autocomplete="off"  spellcheck="false" required>
	  </div>
	  
		
	
	<input type="submit" class="btn"  name="forgot" value="Αποστολή συνδέσμου" />
  
			<div class="wrong">
				 <?php 
				 if(isset($_GET['error'])==1){	
					echo '<font color="#4CAF50"><p align="left"><strong>Τα στοιχεία δεν επαληθεύτηκαν</strong></p></font>';
				 } 
				 ?>
			 </div> 
  </form> 
</div>

 </body>
</html>

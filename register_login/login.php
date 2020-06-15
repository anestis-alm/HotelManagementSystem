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
	  <h1>Είσοδος</h1>
  <form  id="login" action="server.php" method="POST" >
	  <div class="textbox">
		<i class="fas fa-user"></i>
		<input type="text"  placeholder="Όνομα χρήστη" id="user" name="user" autocomplete="off"  spellcheck="false" required>
	  </div>

	  <div class="textbox">
		<i class="fas fa-lock"></i>
		<input type="password" placeholder="Κωδικός πρόσβασης" id="pass" name="pass" required>
	  </div>
  
	<a class="link" href="signup.php">Δεν είστε μέλος? Εγγραφείτε εδώ!</a>
	<a class="link" href="forgot.php">Ξεχάσατε το κωδικό πρόσβασης?</a>
	
	<input type="submit" class="btn"  name="login" value="Είσοδος" />
  
			 <div class="wrong">
				 <?php 
				 if(isset($_GET['error'])==1){	
					echo '<font color="#4CAF50"><p align="left"><strong>Λάθος στοιχεία.</strong></p></font>';
				 } 
				 if(isset($_GET['success'])==1){	
					echo '<font color="#4CAF50"><p align="left"><strong>Σας έχουν σταλεί οδηγίες στο email!</strong></p></font>';
				 } 
				 if(isset($_GET['succ'])==1){	
					echo '<font color="#4CAF50"><p align="left"><strong>Ο κωδικός σας άλλαξε!</strong></p></font>';
				 } 
				 ?>
			 </div>
  </form> 
</div>

 </body>
</html>

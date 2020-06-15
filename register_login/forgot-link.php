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
  <form  id="new_pas" action="server.php" method="POST" >
	<?php $id_user = $_GET['id'];  ?>

	  <div class="textbox">
		<i class="fas fa-lock"></i>
		<input type="password" placeholder="Νέος κωδικός πρόσβασης" id="pass1" name="pass1" required>
	  </div>
	  
	  <div class="textbox">
		<i class="fas fa-lock"></i>
		<input type="password" placeholder="Επαλήθευση νέου κωδικού" id="pass2" name="pass2" required>
	  </div>
	  
		<input type="hidden" name="user_id" value="<?php echo $id_user; ?>"/>
	
	<input type="submit" class="btn"  name="new_pas" value="Επιβεβαίωση" />
  
			<div class="wrong">
				 <?php 
				 if(isset($_GET['error'])==1){	
					echo '<font color="#4CAF50"><p align="left"><strong>Οι κωδικοί δεν ταιριάζουν!</strong></p></font>';
				 } 
				 ?>
			 </div> 
  </form> 
</div>

 </body>
</html>

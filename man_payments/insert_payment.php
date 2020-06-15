<?php session_start();
	  session_regenerate_id();
	  include '../db_connection.php'; 
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Εκχώρηση Νέας Πληρωμής</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/manager.css">

  
</head>

<body>
       
	
   

   <div class="man-box">
        <form id="contact" action="payments.php" method="POST" enctype="multipart/form-data"> 
		
				<h1>Εισάγετε νέα πληρωμή</h1>

			
			  <div class="textbox">
			    <h5>Άτομο για πληρωμή</h5>
				
				
		    <?php $sqlget="SELECT name FROM paid ";
			$sqldata= mysqli_query($db,$sqlget) or die("error"); ?>
			
				
				
	
		        <?php echo '<select name="DROP">'; 
					while($row = mysqli_fetch_array($sqldata,MYSQLI_ASSOC)){
					echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
				
					}
				echo '</select>'; ?>
				
				</div>
				
			<div class="textbox">
			    <h5>Ημερομηνία</h5>
				<i class="fa fa-calendar " aria-hidden="true"></i>
				<input type="date" id="date" name="date" placeholder="Ημερομηνία*" required>		
			</div>
			
			<div class="textbox">
			    <h5>Ποσό</h5>
				<i class="fa fa-money" " aria-hidden="true"></i>
				<input type="number"  step="any" id="amount" name="amount" placeholder="Ποσό*" required>
				
			</div>  
		  
		  <div class="textbox">
		  <h5>Τύπος</h5>
			  <select name = "type">
					<option value="Μετρητά" name="metrita">Μετρητά</option>
					<option value="Κατάθεση"  name="katathesi">Κατάθεση</option>
							
			  </select>
		  </div>
		  
		  <div class="textbox">
				<i class="fa fa-edit" aria-hidden="true"></i>
				<input type="text"   id="description" name="description" placeholder="Περιγραφή*" required>
				
		 </div>
		  
          <input type="submit" class="btn" name="insert_payment"  value="Εκχώρηση">
		
		  
         
         </form>
     </div>
</body>
</html>
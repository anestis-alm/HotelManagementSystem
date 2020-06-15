<?php session_start();
	  session_regenerate_id();
	  include '../db_connection.php'; ?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Εκχώρηση Νέου Προμηθευτή/Νέου Μέλους του Προσωπικού</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/manager.css">

  
</head>

<body>
       
	
   

      <div class="man-box">
        <form id="contact" action="paid.php" method="POST" enctype="multipart/form-data"> 
			
				<h1>Εισάγετε νέο προμηθευτή/προσωπικό</h1>
				
			
			
			
				
			  <div class="textbox">
			    <h5>Όνοματεπώνυμο</h5>
				<i class="fa fa-user-circle " aria-hidden="true"></i>
				<input type="text" id="name" name="name" placeholder="Ονοματεπώνυμο*" required>
				
			</div>
			
			  <div class="textbox">
			    <h5>Τηλέφωνο</h5>
				<i class="fa fa-phone" " aria-hidden="true"></i>
				<input type="number" id="phone" name="phone" placeholder="Τηλέφωνο*" required>
				
			</div> 
			
             <div class="textbox">
				<h5>IBAN</h5>
				<input type="text" id="iban" name="iban" placeholder="ΙΒΑΝ*" required>
			</div>			
			
		  
		  <div class="textbox">
		  <h5>Τύπος</h5>
		  <select name = "role">
				<option value="Προμηθευτής" name="provider">Προμηθευτής</option>
				<option value="Προσωπικό"  name="staff">Προσωπικό</option>
					
		  </select>
			
		  
		 
		  </div>
          <input type="submit" class="btn" name="insert_paid"  value="Εκχώρηση">
		
		  
         
         </form>
        </div>
</body>
</html>
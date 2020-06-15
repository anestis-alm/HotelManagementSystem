<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Εκχώρηση Νέου Εσόδου-Εξόδου Ξενοδοχείου</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/manager.css">

  
</head>

<body>
       
	
   

      <div class="man-box">
        <form id="contact" action="financial.php" method="POST" enctype="multipart/form-data"> 
	
				<h1>Εισάγετε έσοδα-έξοδα</h1>
					
			<div class="textbox">
			
			    <h5>Ημερομηνία</h5>
				<i class="fa fa-calendar " aria-hidden="true"></i>
				<input type="date" id="date" name="date" placeholder="Date*" required>
				
			</div>
			
			<div class="textbox">
			    <h5>Ποσό</h5>
				<input type="number"  step="any" id="amount" name="amount" placeholder="Ποσό*" required>
				
			</div>  
		  
		  <div class="textbox">
		  <h5>Τύπος</h5>
		  <select name = "type">
				<option value="esoda" name="esoda">Έσοδα</option>
				<option value="eksoda"  name="eksoda">Έξοδα</option>
					
		  </select>
			
		  </div>
		  
		  <div class="textbox">
		  <i class="fa fa-edit" aria-hidden="true"></i>
				<input type="text"   id="description" name="description" placeholder="Περιγραφή*" required>
				
			</div>
		  
          <input type="submit" class="btn" name="insert_fin"  value="Εκχώρηση">
         
         </form>
        </div>
</body>
</html>
<?php session_start(); 
	  session_regenerate_id();
include '../db_connection.php'; ?>

<!DOCTYPE html>

<html >
<head>


<script type="text/javascript">
function show1(){
  document.getElementById('div1').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
}
</script>



  <meta charset="UTF-8">
  <title>Επιβεβαίωση</title>
  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/paym_style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>

<body>

<form id="payment" action="server - Copy.php" method="POST" enctype="multipart/form-data">
<?php

	
		if (isset($_POST['use_button'])){	
			$button = $_POST['use_button'];	
			$_SESSION['breakfast']='no';
			$_SESSION['cancel']='no';
			$pr='price';
		}else if (isset($_POST['use_button_break'])){
			$button = $_POST['use_button_break'];
			$pr='price_break';
			$_SESSION['breakfast']='yes';
			$_SESSION['cancel']='no';
		}else if (isset($_POST['use_button_cancel'])){
			$button = $_POST['use_button_cancel'];
			$pr='price_canc';
			$_SESSION['breakfast']='yes';
			$_SESSION['cancel']='yes';
		}
			$_SESSION['room_number']=$button; 
			$start_date = $_SESSION['Start_date'];
			$end_date = $_SESSION['End_date'];
			
		    
		
		
		$sqli = "SELECT price,price_break,price_canc FROM room WHERE room_number='$button'";
			$sqldat = mysqli_query($db,$sqli) or die("error");
			
			while($row = mysqli_fetch_array($sqldat,MYSQLI_ASSOC)){ 
					$price=$row['price'];
					$f_price=$row[$pr];			
			}
				
		$Final_price = $_SESSION['Numdays']*$f_price;
		$_SESSION['final_price']=$Final_price;
		
		$price = $_SESSION['Numdays']*$price;
		$_SESSION['price']=$price;
		?>
		
		
 
	  <span class="dot"></span>
	  <span class="dot"></span>
	  <span class="dot" id="curr"></span>




<div class="row">
 
	<div class="column1" style="background-color:#FFFFFF;">	
		<h3><b>1.Στοιχεία κράτησης</b></h3>
		<div class="column1 name" id="name">
				<h4>Όνομα*</h4>
				<input type="text" id="f_name" name="name" required>			
		</div>
		
		<div class="column1 lastname" id="name">
				<h4>Επώνυμο*</h4>
				<input type="text" id="l_name" name="lastname" required>			
		</div>
		
		<div class="column1 address*" id="addr">
				<h4>Διεύθυνση*</h4>
				<input type="text" id="address" name="address" required>			
		</div>
		<div class="column1 email" id="em">
				<h4>Email*</h4>
				<input type="email" id="email" name="email" required>			
		</div>
		<div class="column1 telephone*" id="tel">
				<h4>Τηλέφωνο επικοινωνίας*</h4>
				<input type="tel" id="telephone" name="telephone" required>			
		</div>
		
		<div class="column1 comments" id="com" >
				<h4>Σχόλια κράτησης</h4>
				<textarea id="comments" name="comments"></textarea>			
		</div>
		
		<div class="column1 receipt" id="rec" >				
			<input type="radio"  name="type" value="receipt" checked="checked" onclick="show1();"><b>Απόδειξη</b>	
		</div>
		<div class="column1 receipt" id="rec" >	
			<input type="radio" name="type" value="invoice" onclick="show2();"> <b>Τιμολόγιο</b>
		</div>  
			

			<div id="div1" class="hide" style="background-color:#FFFFFF;">
					<div class="div1 name" id="rec_na">
							<h4>Επωνυμία*</h4>
							<input type="text" id="rec_name" name="rec_name">			
					</div>
					
					<div class="div1 afm" id="afm">
							<h4>Α.Φ.Μ*</h4>
							<input type="text" id="rec_afm" name="rec_afm">			
					</div>
					
					<div class="div1 doy*" id="doy">
							<h4>Δ.Ο.Υ*</h4>
							<input type="text" id="rec_doy" name="rec_doy">			
					</div>
					
					<div class="div1 address*" id="rec_addr">
						<h4>Διεύθυνση*</h4>
						<input type="text" id="rec_address" name="rec_address">			
					</div>
					
					<div class="div1 tk*" id="rec_tk">
						<h4>Τ.Κ.*</h4>
						<input type="text" id="rec_tax" name="rec_tax">			
					</div>
					
					<div class="div1 city*" id="rec_cit">
						<h4>Πόλη*</h4>
						<input type="text" id="rec_city" name="rec_city">			
					</div>
					
					<div class="div1 country*" id="rec_coun">
						<h4>Χώρα*</h4>
						<input type="text" id="rec_country" name="rec_country">			
					</div>
			</div>
			
		
</div>
	
	<div class="column2" style="background-color:#FFFFFF;">
	

		<h3><b>2.Τρόπος πληρωμής</b></h3>	
			<p id="circle1">
			<input type="radio" id="payment" name="payment" value="cash" checked> <b>Μετρητά</b><br><br>	
			Πληρώνεις με μετρητά κατά την επίσκεψη σου στο ξενοδοχείο μας.
			</p>
			
			<p id="circle2">
			<input type="radio" name="payment" value="credit"> <b>Πιστωτική/χρεωστική κάρτα</b><br><br>	
			Δυνατότητα πληρωμής με πιστωτική/χρεωστική κάρτα.<br>
			<img src="../img/master.ico" style="width:50px;height:50px;">
			<img src="../img/visa.ico" style="width:50px;height:50px;">
			<img src="../img/Maestro.png" style="width:50px;height:50px;"><br>
			</p>
			
			<p id="circle3">
			<input type="radio" name="payment" value="deposit"><b> Κατάθεση</b><br><br>	
			Δυνατότητα πληρωμής με κατάθεση στον τραπεζικό μας λογαριασμό.
			</p>
			
	 
	</div>
	
	<div class="column3" style="background-color:#FFFFFF;">
	
	<h5><b>3.Επιβεβαίωση</b></h5>
		<h4>Σύνολο</h4><br> 
		<h3><?php echo $Final_price ?> &euro;</h3>
		
		<button type="submit" name="submit" class="btn btn-success" >
                    <i class="fas fa-external-link-alt"></i> Επιβεβαίωση Κράτησης
        </button>
		
		
	</div>
	
</div>

</form>
      
</body>
</html>













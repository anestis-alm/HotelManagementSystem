<?php session_start(); 
	  session_regenerate_id();
include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Available rooms</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/rooms.css">

</head>

<body>
<form id="rooms" action="payment_form.php" method="POST" enctype="multipart/form-data">
<div class="container-fluid">

	
	  <span class="dot"></span>
	  <span class="dot" id="curr"></span>
	  <span class="dot"></span>
			
	
	<br /><br /><br />
	<?php
				if (isset($_POST['search'])){
			
		$Start_date = mysqli_real_escape_string($db,$_POST['start_date']);
		$_SESSION['Start_date']=$Start_date; 
		$End_date = mysqli_real_escape_string($db,$_POST['end_date']);
		$_SESSION['End_date']=$End_date; 		
		$Type = mysqli_real_escape_string($db,$_POST['type']);
		$_SESSION['Type']=$Type; 
		$Numdays = mysqli_real_escape_string($db,$_POST['numdays']);
		if ($Numdays==0){
			$_SESSION['Numdays']=1;
		}else{
		$_SESSION['Numdays']=$Numdays;
		}
		
		
			$num=0;
			$bool=true;
			if ($Type=='single'){
			$sqlget="SELECT * FROM room order by type desc";
			}
			else if ($Type=='double'){
			$sqlget="SELECT * FROM room WHERE type='double'||type='family' order by type";
			}
			else if ($Type=='family'){
			$sqlget="SELECT * FROM room WHERE type='family'";
			}
			$sqldata= mysqli_query($db,$sqlget) or die("error");
			while($r = mysqli_fetch_array($sqldata,MYSQLI_ASSOC)){ 
				$room=$r['room_number'];
		
				$sql="SELECT * FROM reservation WHERE room_number='$room'";
				$sqli= mysqli_query($db,$sql) or die("error");
				while($row = mysqli_fetch_array($sqli,MYSQLI_ASSOC)){ 
				
				
					if (($Start_date>=$row['start_date'] && $Start_date<$row['end_date']) || ($Start_date<=$row['start_date'] && $End_date>=$row['start_date']) ) {
					
						$bool=false;	
							 						
					 } 
				
				  
															
				} ?>
				
					
				<?php if ($bool){ ?>
		
			<div class="head-row">	
				<table id="data-table" class="table">
					<tr>
						<td>
						<div class="col-lg-6 col-md-6 col-sm-6 col-6">
				
				
				
										
								<?php
									$sql_r = "SELECT * FROM rooms_images WHERE room_number='$room'";
											$sql_ro = mysqli_query($db,$sql_r) or die("error");
											
										if(mysqli_num_rows($sql_ro) >0){	
											while($r_row = mysqli_fetch_array($sql_ro,MYSQLI_ASSOC)){ 
													
													$array[] = $r_row['path'];
											}
										}	
									
								?>
								
								<div class="carous">
							
									  <div id="carouselExample" class="carousel slide" data-ride="carousel">
									
										<ol class="carousel-indicators">
												<?php                               
														for($i=0;$i<count($array);$i++){
															if($i==0){
																echo ' <li data-target="#carouselExample" data-slide-to="'.$i.'" class="active"></li>';
															}else{
																echo ' <li data-target="#carouselExample" data-slide-to="'.$i.'"></li>';
															}
														}
												?>
										</ol>

										<!-- Wrapper for slides -->
										<div class="carousel-inner">
								
											<?php for($i=0;$i<count($array);$i++){
																	   

												if($i==0){		
												echo '<div class="item active" style="height: 40vh;background-image: url('.$array[$i].'); background-size: cover;
												background-repeat: no-repeat);"></div>';
												}
												else {	
												echo '<div class="item" style="height: 40vh; background-image: url('.$array[$i].'); background-size: cover;
												background-repeat: no-repeat"></div>';
												}
											  
											}	
											?> 

										</div>

											<a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
											  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
											  <span class="sr-only">Previous</span>
											</a>
											<a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
											  <span class="carousel-control-next-icon" aria-hidden="true"></span>
											  <span class="sr-only">Next</span>
											</a>
									</div>
								</div>
							</div>
						</td>
						<td>
						<div class="col-lg-6 col-md-6 col-sm-6 col-6">
								<div class="column1">														
									<?php 	echo $r['title']; ?>															
								</div>
								
								<div class="column2">
									<i class="fas fa-check"></i> Wifi &nbsp;&nbsp;/&nbsp;&nbsp; <i class="fas fa-check"></i> Room Service	<br />
								</div>
								
								<div class="column3">
									<p><?php echo $r['description']; ?></p>	
								</div>
						</div>	
						</td>
					</tr>
				</table>
					
		</div>
		
		<div class="row">
		
			 <div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="offers">
				
				<table id="tab">
				<tr style="border-top:1px solid #808080;">
					<td>
							<h3>Τιμή Δωματίου</h3>
							<h5 id="best">ΚΑΛΥΤΕΡΗ ΤΙΜΗ!</h5>
							<p>Η τιμή περιλαμβάνει όλους τους φόρους & δωρεάν WIFI.</p>							
					</td>
					<td>
							<h4>Tιμή ανά βράδυ / <?php echo $r['price']; ?> &euro;</h4> 	
							<button type="submit" id="button" name="use_button" 
							value='<?php echo $r['room_number']; ?>'><b>Κράτηση</b></button>
					</td>
				</tr>
					
					
				<tr style="border-top:1px solid #808080;">
					<td>
							<h3>Τιμή με Πρωινό</h3>
							<i class="fa fa-coffee" style="color:blue;"></i>
							<h5>Με πρωινό</h5>
							<p>Η τιμή περιλαμβάνει πρωινό, όλους τους φόρους & δωρεάν WIFI.</p>
					</td>
					<td>
							<h4>Tιμή ανά βράδυ / <?php echo $r['price_break']; ?> &euro;</h4> 	
							<button type="submit" id="button" name="use_button_break" value='<?php echo $r['room_number']; ?>'><b>Κράτηση</b></button>
					</td>
				</tr>
				
				<tr style="border-top:1px solid #808080;border-bottom:1px solid #808080;"">
					<td>				
							<h3>Τιμή με Πρωινό και δυνατότητα ακύρωσης.</h3>
							<i class="fa fa-coffee" style="color:blue;"></i>
							<h5>Με πρωινό</h5>
							<h5 id="canc">Δωρεάν Ακύρωση</h5>		
							<p>Η τιμή περιλαμβάνει πρωινό, όλους τους φόρους & δωρεάν WIFI.</p>
						
					</td>
					
					<td>
							<h4>Tιμή ανά βράδυ / <?php echo $r['price_canc']; ?> &euro;</h4> 	
							<button type="submit" id="button" name="use_button_cancel" value='<?php echo $r['room_number']; ?>'><b>Κράτηση</b></button>
					</td>
				</tr>
				
				</table>
				<br /><br /><br /><br /><br /><br />
				</div>
				
			</div>
		
	 </div>
	
				<?php unset($array); } ?>	
					
					
												
				<?php $bool=true; ?>
				
			<?php } ?>
			

<?php		} ?>






	
</div>
</form>	

</body>

</html>

<script>
$(document).ready(function() {
    var table = $('#data-table').DataTable();
     


} );


</script>
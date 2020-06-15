<?php

session_start();
session_regenerate_id();
 include '../db_connection.php'; 


if (isset($_POST['insert_payment'])){	
		
		$username = $_SESSION['username'];
		$date = mysqli_real_escape_string($db,$_POST['date']);
		$amount = mysqli_real_escape_string($db,$_POST['amount']);
		$type = mysqli_real_escape_string($db,$_POST['type']);	
		$description = mysqli_real_escape_string($db,$_POST['description']);
		$paid = mysqli_real_escape_string($db,$_POST['DROP']);
		
			$sqli = "SELECT id_paid FROM paid WHERE name='$paid'";
			$sqldat = mysqli_query($db,$sqli) or die("error");
			while($row = mysqli_fetch_array($sqldat,MYSQLI_ASSOC)){ 
					$id_paid=$row['id_paid'];
			
			}
			
			$sql = "INSERT INTO payment (date , amount , type, description, username, id_paid) 
					VALUES ('$date','$amount','$type','$description','$username','$id_paid')";
			
          
			
			
		mysqli_query($db, $sql);
		
		
		

	
	
	}
	
	?>
	
	<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Πληρωμές</title>
  
   

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="../css/table.css" rel="stylesheet">
	
  
  
  
  
</head>

<body>

<header class="business-header">

<div class="row">

  <div class="container">
            <div class="row">
                <div class="col-lg-12">
				
                    <h1 class="tagline">Πληρωμές</h1>
                </div>
            </div>
        </div>
</header>






  <div class="row">
  
         <div class="col-lg-12">
	<div class="table-form">
		<div class="container">	
		
			
			<table class="table table-hover">
			<thead>
			<tr> 
			
				<th>Ημερομηνία</th>
				<th>Ποσό</th>
				<th>Τρόπος πληρωμής</th>
				<th>Περιγραφή</th>
				<th>Υπεύθυνος</th>
				<th>Πληρώμενο Πρόσωπο</th>
				
				
			</tr>
			</thead>
		  <?php
		
			
			$sqlget="SELECT * FROM payment ";
			$sqldata= mysqli_query($db,$sqlget) or die("error");
			while($row = mysqli_fetch_array($sqldata,MYSQLI_ASSOC)){ 
			    $id_paym = $row['id_paym'];
				$id_paid = $row['id_paid'];
				$date=$row['date'];
				$amount=$row['amount'];
				$type=$row['type'];
				$description=$row['description'];
				
				$sql="SELECT name FROM paid WHERE id_paid = '$id_paid' ";
				$sqlda= mysqli_query($db,$sql) or die("error");
				while($row = mysqli_fetch_array($sqlda,MYSQLI_ASSOC)){ 
	              
				?>
			
			
					<tr>
				
					<td><?php echo $date ; ?></td>
					<td><?php echo $amount; ?>€</td>
					<td><?php echo $type ; ?></td>
					<td><?php echo $description; ?></td>
					<td><?php echo $_SESSION['username']; ?></td>
				    <td><?php echo $row['name']; ?></td>
					
				    <td><a <?php echo " href=\"delete_pay.php?id= ".$id_paym."\"";?> id="delete_payment" name="delete_payment" style="color: white; text-decoration: none;" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i><a/>

					
                    </tr>					
				<?php		} ?>
				
		<?php		} ?>
				</table>
			
			
			<a href="../index.php" class="btn btn-dark btn-lg js-scroll-trigger"> Αρχική </a>
			<a href="insert_payment.php" class="btn btn-dark btn-lg js-scroll-trigger"> Εκχώρηση νέας πληρωμής </a>
		</div>  

	</div>
	
</div>



			
</div>

			


</body>
</html>

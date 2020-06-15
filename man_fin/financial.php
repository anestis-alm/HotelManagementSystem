<?php

session_start();
session_regenerate_id();
include '../db_connection.php'; 


if (isset($_POST['insert_fin'])){	
		
		$username = $_SESSION['username'];
		$date = mysqli_real_escape_string($db,$_POST['date']);
		$amount = mysqli_real_escape_string($db,$_POST['amount']);
		$type = mysqli_real_escape_string($db,$_POST['type']);	
		$description = mysqli_real_escape_string($db,$_POST['description']);
		
			
			$sql = "INSERT INTO financial (date , amount , description, inc_or_outc, username) 
					VALUES ('$date','$amount','$description','$type','$username')";
			

		
			
			
		mysqli_query($db, $sql);
		
	header('location: ../index.php');
	
	
	}
	
	?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Έσοδα και Έξοδα</title>
  
   

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
				
                    <h1 class="tagline">Έσοδα και Έξοδα</h1>
                </div>
            </div>
        </div>
</header>







  
         <div class="col-lg-12">
	<div class="table-form">
		<div class="container">	
		
			
			<table class="table table-hover">
			<thead>
			<tr> 
			
				<th>Ημερομηνία</th>
				<th>Ποσό</th>
				<th>Έσοδα/Έξοδα</th>
				<th>Περιγραφή</th>
				<th>Υπεύθυνος</th>
				
			</tr>
			</thead>
		  <?php
		
			
			$sqlget="SELECT * FROM financial ";
			$sqldata= mysqli_query($db,$sqlget) or die("error");
			while($row = mysqli_fetch_array($sqldata,MYSQLI_ASSOC)){ 
			$id_financ = $row['id_financ'];			
				?>
			
			
					<tr>
				
					<td><?php echo $row['date']; ?></td>
					<td><?php echo $row['amount']; ?>€</td>
					<td><?php echo $row['inc_or_outc']; ?></td>
					<td><?php echo $row['description']; ?></td>
					<td><?php echo $_SESSION['username']; ?></td>
					
				    <td><a <?php echo " href=\"delete_fin.php?id= ".$id_financ."\"";?>  id="delete_financ" name="delete_financ" style="color: white; text-decoration: none;" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i> <a/>

					
                    </tr>					
				
		<?php		} ?>
				</table>
			
			
			<a href="../index.php" class="btn btn-dark btn-lg js-scroll-trigger"> Αρχική </a>
		
		</div>  

	</div>
	
</div>






			
</div>

			





</body>
</html>

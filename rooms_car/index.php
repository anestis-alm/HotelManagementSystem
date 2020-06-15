<?php  include '../db_connection.php'; ?>
<!DOCTYPE html>  
<html>  
 <head>  
  <meta charset="UTF-8">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
 
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
	

	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
 </head> 
 
 <body>  
 <form id="rooms_car" action="rooms_im.php" method="POST" enctype="multipart/form-data">
 
  <div class="container-fluid"  style="width:100%;float:left; ">  
		<h3 align="center">Rooms Images</h3>  
		<br />
   
   
   
   <?php
	     $query = "SELECT * FROM rooms_images GROUP BY room_number";
			  $result = mysqli_query($db, $query);		?>	
	
			   <table class="table table-bordered table-striped">  
				<tr>
					 <th>Room Number</th>
					 <th>Open Folder</th>
					
				</tr>
			
			  
			  
	<?php while($row = mysqli_fetch_array($result))
			  { ?>
			

				<tr>
						<td><?php echo $row['room_number'] ?></td>						
						<td><button type="submit" id="button" name="open_button" class="btn btn-warning"  value='<?php echo $row['room_number']; ?>'><b>Open</b></button></td>					
				</tr>
			 
			 <?php } ?>
		 </table>
	   
 
   <div align="left">	
			<a href="../index.php" class="btn btn-success btn-lg js-scroll-trigger"> Back </a>
	</div>	
  </div>  
  
  </form>	
 </body>  
</html>


		 


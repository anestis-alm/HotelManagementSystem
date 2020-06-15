<?php
session_start();
session_regenerate_id();
include '../db_connection.php'; 
	
	
		            $sql = "SELECT * FROM payment";
					$res = mysqli_query($db,$sql);
					
						if(isset($_GET['id'])){
							
							
							$id_paym = $_GET['id'];
							
						 						
							$sqla = "DELETE FROM payment WHERE id_paym = \"".$id_paym."\"";
							mysqli_query($db,$sqla) or die(mysql_error());
							if(mysqli_query($db,$sqla))
							{
								echo "Data deleted Successfuly..";
							    header('location: payments.php');
								
								
								

							}else{
								echo "Data doesnt deleted...";
								
							}
						}
									
						
						
						
			
	?>
			
<?php
session_start();
session_regenerate_id();
 include '../db_connection.php'; 
			
		            $sql = "SELECT * FROM financial";
					$res = mysqli_query($db,$sql);
					
						if(isset($_GET['id'])){
							
							
							$id_financ = $_GET['id'];
							
						 						
							$sqla = "DELETE FROM financial WHERE id_financ = \"".$id_financ."\"";
							mysqli_query($db,$sqla) or die(mysql_error());
							if(mysqli_query($db,$sqla))
							{
								echo "Data deleted Successfuly..";
							    header('location: financial.php');
								
								
								

							}else{
								echo "Data doesnt deleted...";
								
							}
						}
										
				?>
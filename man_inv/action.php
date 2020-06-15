<?php session_start(); 
session_regenerate_id();
include '../db_connection.php'; 

 if(isset($_POST["action"]))
  {
	
	
	
		if($_POST["action"] == "fetch")
		 {
			  $query = "SELECT * FROM man_inv ORDER BY id";
			  $result = mysqli_query($db, $query);														
		
		
		$output = '
			   <table class="table table-bordered table-striped">  
				<tr>
					 <th width="15%">ID</th>
					 <th width="20%">File Name</th>
					 <th width="50%">File</th>
					 <th width="15%">Remove</th>
				</tr>
			  ';
			  
			  
			while($row = mysqli_fetch_array($result))
			  {
			   $output .= '

				<tr>
						<td>'.$row["id"].'</td>
						<td>'.$row["name"].'</td>
						<td>
							<a href="'.$row['path'].'">Download File</a>
						</td>
						<td><button type="button" name="delete"
							class="btn btn-danger bt-xs delete"
							id="'.$row["id"].'">Remove</button></td>
				</tr>
			   ';
			  }
		  $output .= '</table>';
		  echo $output;
		 }
		 
		 if($_POST["action"] == "insert")
			 {	
				$name = $_FILES['image']['name'];
				$file = $_FILES['image']['tmp_name'];
				$path = '../manager_invoices/'.$name;
			
				 if (move_uploaded_file ($file, $path)) {
						$query = "INSERT INTO man_inv(name,path) VALUES ('$name','$path')";
						mysqli_query($db, $query);		  
						echo "The file has been uploaded.";
				} else {
					exit("Error While uploading image on the server");

				}	  
				
			 }
			 
			 
			 
		
 
 
		 if($_POST["action"] == "delete")
		 {
			 		
				$sqlb = "SELECT name FROM man_inv WHERE id = '".$_POST["image_id"]."'";
				$resb = mysqli_query($db,$sqlb) or die("error");
				$row = mysqli_fetch_array($resb,MYSQLI_ASSOC);			
							
				$query = "DELETE FROM man_inv WHERE id = '".$_POST["image_id"]."'";
					if(mysqli_query($db, $query))
					{
						echo 'File Deleted from Database';
					}
					unlink("../manager_invoices/".$row['name']);
		 }
 }
 
 ?>
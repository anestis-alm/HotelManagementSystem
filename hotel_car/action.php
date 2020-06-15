<?php session_start(); 
include '../db_connection.php'; 

 if(isset($_POST["action"]))
  {
	
	
	
	
		if($_POST["action"] == "fetch")
		 {
			  $query = "SELECT * FROM hotel_images ORDER BY id";
			  $result = mysqli_query($db, $query);														
		
		
		$output = '
			   <table class="table table-bordered table-striped">  
				<tr>
					 <th width="10%">ID</th>
					 <th width="20%">Image Name</th>
					 <th width="50%">Image</th>
					 <th width="10%">Change</th>
					 <th width="10%">Remove</th>
				</tr>
			  ';
			  
			  
			while($row = mysqli_fetch_array($result))
			  {
			   $output .= '

				<tr>
						<td>'.$row["id"].'</td>
						<td>'.$row["name"].'</td>
						<td>
							<img src="../'.$row['path'].'"  height="60" width="75" class="img-thumbnail" />
						</td>
						
						<td><button type="button" name="update" 
							class="btn btn-warning bt-xs update" 
							id="'.$row["id"].'">Change</button></td>
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
				$path = '../hotel_images/'.$name;
				$db_path = 'hotel_images/'.$name;
				 if (move_uploaded_file ($file, $path)) {
						$query = "INSERT INTO hotel_images(name,path) VALUES ('$name','$db_path')";
						mysqli_query($db, $query);		  
						echo "The file has been uploaded.";
				} else {
					exit("Error While uploading image on the server");

				}	  
				
			 }
			 
			 
			 
		 if($_POST["action"] == "update")
		 {
			
			$sqlb = "SELECT name FROM hotel_images WHERE id = '".$_POST["image_id"]."'";
			$resb = mysqli_query($db,$sqlb) or die("error");
			$row = mysqli_fetch_array($resb,MYSQLI_ASSOC);	
				
				
				$name = $_FILES['image']['name'];
				$file = $_FILES['image']['tmp_name'];
				$path = '../hotel_images/'.$name;
				$db_path = 'hotel_images/'.$name;
				 if (move_uploaded_file ($file, $path)) {
						$query = "UPDATE hotel_images SET name = '$name', path= '$db_path' WHERE id = '".$_POST["image_id"]."'";
						unlink("../hotel_images/".$row['name']);	
						mysqli_query($db, $query);										
						echo "The file has been udated.";
				} else {
					exit("Error While uploading image on the server");

				}	  
				
		}
 
 
		 if($_POST["action"] == "delete")
		 {
			 
			
							
				$sqlb = "SELECT name FROM hotel_images WHERE id = '".$_POST["image_id"]."'";
				$resb = mysqli_query($db,$sqlb) or die("error");
				$row = mysqli_fetch_array($resb,MYSQLI_ASSOC);			
							
				$query = "DELETE FROM hotel_images WHERE id = '".$_POST["image_id"]."'";
					if(mysqli_query($db, $query))
					{
						echo 'Image Deleted from Database';
					}
					unlink("../hotel_images/".$row['name']);
		 }
 }
 
 ?>
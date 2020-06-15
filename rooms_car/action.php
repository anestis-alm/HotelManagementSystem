<?php session_start(); 
session_regenerate_id();
include '../db_connection.php'; 

 if(isset($_POST["action"]))
  {
	
	$open = $_POST['open_but'];
	
	
		if($_POST["action"] == "fetch")
		 {		  
			  $query = "SELECT * FROM rooms_images WHERE room_number = $open";
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
							<img src="'.$row['path'].'"  height="60" width="75" class="img-thumbnail" />
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
				$path = "../rooms_images/".$open. "/" .$name;
				$db_path = "../rooms_images/".$open. "/" .$name;
				 if (move_uploaded_file ($file, $path)) {
						$query = "INSERT INTO rooms_images(room_number,name,path) VALUES ('$open','$name','$db_path')";
						mysqli_query($db, $query);		  
						echo "The file has been uploaded.";
				} else {
					exit("Error While uploading image on the server");

				}	  
				
			 }
			 
			 
			 
		 if($_POST["action"] == "update")
		 {
			
			$sqlb = "SELECT name FROM rooms_images WHERE id = '".$_POST["image_id"]."'";
			$resb = mysqli_query($db,$sqlb) or die("error");
			$row = mysqli_fetch_array($resb,MYSQLI_ASSOC);	
				
				
				$name = $_FILES['image']['name'];
				$file = $_FILES['image']['tmp_name'];
				$path = "../rooms_images/".$open. "/" .$name;
				$db_path = "../rooms_images/".$open. "/" .$name;
				 if (move_uploaded_file ($file, $path)) {
						$query = "UPDATE rooms_images SET name = '$name', path= '$db_path' WHERE id = '".$_POST["image_id"]."'";
						unlink("../rooms_images/".$open. "/" .$row['name']);	
						mysqli_query($db, $query);										
						echo "The file has been udated.";
				} else {
					exit("Error While uploading image on the server");

				}	  
				
		}
 
 
		 if($_POST["action"] == "delete")
		 {
			 
			
							
				$sqlb = "SELECT name FROM rooms_images WHERE id = '".$_POST["image_id"]."'";
				$resb = mysqli_query($db,$sqlb) or die("error");
				$row = mysqli_fetch_array($resb,MYSQLI_ASSOC);			
							
				$query = "DELETE FROM rooms_images WHERE id = '".$_POST["image_id"]."'";
					if(mysqli_query($db, $query))
					{
						echo 'Image Deleted from Database';
					}
					unlink("../rooms_images/".$open. "/" .$row['name']);
		 }
 }
 
 ?>
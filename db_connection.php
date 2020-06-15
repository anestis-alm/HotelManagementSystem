 <?php 
 
			$dbhost = "localhost";
			$dbuser = "root";
			$dbpass = "";
			$dbname = "hotel";

			// Create connection
			 $db = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);
				mysqli_query($db, "SET CHARACTER SET utf8");
				mysqli_query($db, "SET NAMES utf8");
			// Check connection
			if (!$db) {
				die("Connection failed: " . mysqli_connect_error());
			}			
?>
	

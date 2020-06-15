<?php session_start();

include '../db_connection.php'; 
include 'connection.php';
if($_SESSION['rights'] == 'admin') { 
 if(isset($_GET["delete"]))
  {
	  $id=$_GET['id'];
	  $sqlb = "DELETE FROM customer WHERE username= \"".$id."\"";
	  mysqli_query($db,$sqlb) or die(mysqli_error($db));
	  $sqla = "DELETE FROM user WHERE username= \"".$id."\"";
	  mysqli_query($db,$sqla) or die(mysqli_error($db));
	  
    header("index.php");
  }
 ?> 


<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	

	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
	

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">


</head>


<body>

<?php 
$sql = "SELECT * FROM user";
$result = mysqli_query($db,$sql);
mysqli_fetch_all($result,MYSQLI_ASSOC);


$total_rows = $result->num_rows;

?>


    <div class="container-fluid">

	
			<br />
			<table id="data-table" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>User_ID</th>
						<th>Username</th>
						<th>Name</th>
						<th>Email</th>
						<th>Password</th>
						<th>Rights</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					</thead>

					<?php
						if ($total_rows > 0)
						{
							foreach($result as $row)
							{?>	
								
									<tr id="<?php echo $row['user_id']; ?>">
										<td data-target="user_id"><?php echo $row['user_id']; ?></td>
										<td data-target="username"><?php echo $row['username']; ?></td>
										<td data-target="name"><?php echo $row['name']; ?></td>
										<td data-target="email"><?php echo $row['email']; ?></td>
										<td data-target="password"><?php echo $row['password']; ?></td>
										<td data-target="rights"><?php echo $row['rights']; ?></td>														
										<td><a href="#" data-role="update" data-id="<?php echo $row['user_id']; ?>"><span class="fa fa-edit"></span></a></td>
						<?php echo '	<td><a href="#" id="'.$row['username'].'" class="delete" name="delete"> <span class="fa fa-remove"></span></a></td> '; ?>
									</tr>
							
					<?php }
						}?>
						   
			</table>
			<a href="../index.php" class="btn btn-dark btn-lg js-scroll-trigger"> Αρχική </a>
	</div>

	  <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit</h4>
          </div>
          <div class="modal-body">
              		
			  <div class="form-group">
                <label>Name</label>
                <input type="text" id="name" class="form-control">
              </div>
			  <div class="form-group">
                <label>Email</label>
                <input type="email" id="email" class="form-control">
              </div>
			  <div class="form-group">
                <label>Password</label>
                <input type="text" id="password" class="form-control">
              </div>
			  <div class="form-group">
                <label>Rights</label>
				 <select name="rights" type="text" id="rights" class="form-control">
					<option value="user" name="user">User</option>
					<option value="reception" name="reception">Reception</option>
					<option value="manager"  name="manager">Manager</option>
					<option value="admin"  name="admin">Admin</option>
				 </select>
              </div>
              <input type="hidden" id="userId" class="form-control">
			  
          </div>
          <div class="modal-footer">
            <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
	

<script src="js/FileSaver.js"></script>

</body>

</html>
<script>
$(document).ready(function() {
    var table = $('#data-table').DataTable();
     
$(document).on('click', '.delete', function() {
	var  id = $(this).attr("id");	
	if(confirm("Are you sure you want to remove this?"))
	{
		window.location.href="index.php?delete=1&id="+id;
	}
	else
	{
		return false;
	}
});
} );


</script>


<script>
  $(document).ready(function(){

    //  append values in input fields
      $(document).on('click','a[data-role=update]',function(){
            var id  = $(this).data('id');
		
			var name  = $('#'+id).children('td[data-target=name]').text();
			var email  = $('#'+id).children('td[data-target=email]').text();
			var password  = $('#'+id).children('td[data-target=password]').text();
			var rights  = $('#'+id).children('td[data-target=rights]').text();
			
			$('#name').val(name);
			$('#email').val(email);
	       	$('#password').val(password);
			$('#rights').val(rights);
			
            $('#userId').val(id);
            $('#myModal').modal('toggle');
      });

      // now create event to get data from fields and update in database 

       $('#save').click(function(){
		  var id  = $('#userId').val(); 
		  
		  var name = $('#name').val();
		  var email = $('#email').val();
		  var password = $('#password').val();
		  var rights = $('#rights').val();
        
          $.ajax({
              url      : 'connection.php',
              method   : 'post', 
              data     : {  name:name, email:email, password:password,rights:rights, id: id},
              success  : function(response){
                            // now update user record in table 
							
							 $('#'+id).children('td[data-target=name]').text(name);
							 $('#'+id).children('td[data-target=email]').text(email);
							 $('#'+id).children('td[data-target=password]').text(password);
							 $('#'+id).children('td[data-target=rights]').text(rights);
                             $('#myModal').modal('toggle'); 

                         }
          });
       });
  });
</script>


<?php } else { 
session_destroy(); 
header('Location: ../index.php'); 
}?>
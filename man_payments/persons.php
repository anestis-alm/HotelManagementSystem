<?php session_start();

include '../db_connection.php'; 
include 'connection.php';
if($_SESSION['rights'] == 'manager') { 
 if(isset($_GET["delete"]))
  {
	  $id=$_GET['id'];
	  
	  $sqla = "DELETE FROM paid WHERE id_paid= \"".$id."\"";
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
$sql = "SELECT * FROM paid";
$result = mysqli_query($db,$sql);
mysqli_fetch_all($result,MYSQLI_ASSOC);


$total_rows = $result->num_rows;

?>


    <div class="container-fluid">

	
			<br />
			<table id="data-table" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Όνομα</th>
						<th>Τηλέφωνο</th>
						<th>IBAN</th>
						<th>Τύπος</th>
						<th>Επεξεργασία</th>
						<th>Διαγραφή</th>
					</tr>
					</thead>

					<?php
						if ($total_rows > 0)
						{
							foreach($result as $row)
							{?>	
								
									<tr id="<?php echo $row['id_paid']; ?>">
										<td data-target="id"><?php echo $row['id_paid']; ?></td>
										<td data-target="name"><?php echo $row['name']; ?></td>
										<td data-target="phone"><?php echo $row['phone']; ?></td>
										<td data-target="iban"><?php echo $row['iban']; ?></td>
										<td data-target="role"><?php echo $row['role']; ?></td>														
										<td><a href="#" data-role="update" data-id="<?php echo $row['id_paid']; ?>"><span class="fa fa-edit"></span></a></td>
						<?php echo '	<td><a href="#" id="'.$row['id_paid'].'" class="delete" name="delete"> <span class="fa fa-remove"></span></a></td> '; ?>
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
                <label>Όνομα</label>
                <input type="text" id="name" class="form-control">
              </div>
			  <div class="form-group">
                <label>Τηλέφωνο</label>
                <input type="text" id="phone" class="form-control">
              </div>
			  <div class="form-group">
                <label>IBAN</label>
                <input type="text" id="iban" class="form-control">
              </div>
			  <div class="form-group">
                <label>Τύπος</label>
				<select name="role" type="text" id="role" class="form-control">
					<option value="Προμηθευτής" name="Προμηθευτής">Προμηθευτής</option>
					<option value="Προσωπικό" name="Προσωπικό">Προσωπικό</option>
              </div>
              <input type="hidden" id="id" class="form-control">
			  
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
	if(confirm("Είστε σίγουρος ότι θέλετε να το διαγράψετε?"))
	{
		window.location.href="persons.php?delete=1&id="+id;
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
			var phone  = $('#'+id).children('td[data-target=phone]').text();
			var iban  = $('#'+id).children('td[data-target=iban]').text();
			var role  = $('#'+id).children('td[data-target=role]').text();
			
			$('#name').val(name);
			$('#phone').val(phone);
	       	$('#iban').val(iban);
			$('#role').val(role);
			
            $('#id').val(id);
            $('#myModal').modal('toggle');
      });

      // now create event to get data from fields and update in database 

       $('#save').click(function(){
		  var id  = $('#id').val(); 
		  
		  var name = $('#name').val();
		  var phone = $('#phone').val();
		  var iban = $('#iban').val();
		  var role = $('#role').val();
        
          $.ajax({
              url      : 'connection.php',
              method   : 'post', 
              data     : {  name:name, phone:phone, iban:iban,role:role, id: id},
              success  : function(response){
                            // now update user record in table 
							
							 $('#'+id).children('td[data-target=name]').text(name);
							 $('#'+id).children('td[data-target=phone]').text(phone);
							 $('#'+id).children('td[data-target=iban]').text(iban);
							 $('#'+id).children('td[data-target=role]').text(role);
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
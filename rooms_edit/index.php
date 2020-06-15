<?php session_start();
session_regenerate_id();
include '../db_connection.php'; 
include 'connection.php';
include 'action.php';
if($_SESSION['rights'] == 'admin') { 
 if(isset($_GET["delete"]))
  {
	  
	  $id=$_GET['id'];
	  $sqlb = "DELETE FROM room WHERE room_number= \"".$id."\"";
	  mysqli_query($db,$sqlb) or die(mysqli_error($db));
	  
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
$sql = "SELECT * FROM room";
$result = mysqli_query($db,$sql);
mysqli_fetch_all($result,MYSQLI_ASSOC);


$total_rows = $result->num_rows;

?>


    <div class="container-fluid">

	<div class="add">
		<a href="#"  name="add_room" class="add_room">
		<button type="button" class="btn btn-primary">Add Room
		</button></a>
	</div>
	
			<br />
			<table id="data-table" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Room</th>
						<th>Type</th>
						<th>Title</th>
						<th>Price</th>
						<th>Price + Breakfast</th>
						<th>Price + Breakfast/Cancel</th>
						<th>Description</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					</thead>

					<?php
						if ($total_rows > 0)
						{
							foreach($result as $row)
							{?>	
								
									<tr id="<?php echo $row['room_number']; ?>">
										<td data-target="room_number"><?php echo $row['room_number']; ?></td>
										<td data-target="type"><?php echo $row['type']; ?></td>
										<td data-target="title"><?php echo $row['title']; ?></td>
										<td data-target="price"><?php echo $row['price']; ?></td>
										<td data-target="price_break"><?php echo $row['price_break']; ?></td>
										<td data-target="price_canc"><?php echo $row['price_canc']; ?></td>	
										<td data-target="description"><?php echo $row['description']; ?></td>											
										<td><a href="#" data-role="update" data-id="<?php echo $row['room_number']; ?>"><span class="fa fa-edit"></span></a></td>
						<?php echo '	<td><a href="#" id="'.$row['room_number'].'" class="delete" name="delete"> <span class="fa fa-remove"></span></a></td> '; ?>
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
            <h4 class="modal-title">New</h4>
          </div>
          <div class="modal-body">
				
			<div class="form-group">
                <label>Room</label>
                <input type="number" id="room_number" class="form-control">
              </div>
			  
			  <div class="form-group">
                <label>Type</label>
                <select name="type" type="text" id="type" class="form-control">
					<option value="single" name="single">Single</option>
					<option value="double" name="double">Double</option>
					<option value="family"  name="family">Family</option>
				 </select>
              </div>
			  <div class="form-group">
                <label>Title</label>
                <input type="text" id="title" class="form-control">
              </div>
			  <div class="form-group">
                <label>Price</label>
                <input type="number" step="0.01" id="price" class="form-control">
              </div>
			  <div class="form-group">
                <label>Price + Breakfast</label>
                <input type="number" step="0.01" id="price_break" class="form-control">
              </div>
			  <div class="form-group">
                <label>Price + Breakfast/Cancel</label>
                <input type="number" step="0.01" id="price_canc" class="form-control">
              </div>
			  <div class="form-group">
                <label>Description</label>
                <input type="text" id="description" class="form-control">
              </div>
			  
              <input type="hidden" id="userId" class="form-control">
			  
          </div>
          <div class="modal-footer">
			<a href="#" id="add" class="btn btn-primary pull-right">Add Room</a>
            <a href="#" id="save" class="btn btn-primary pull-right">Update Room </a>		
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close</button>
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
	esle
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
			
			var type  = $('#'+id).children('td[data-target=type]').text();
			var title  = $('#'+id).children('td[data-target=title]').text();
			var price  = $('#'+id).children('td[data-target=price]').text();
			var price_break  = $('#'+id).children('td[data-target=price_break]').text();
			var price_canc  = $('#'+id).children('td[data-target=price_canc]').text();
			var description  = $('#'+id).children('td[data-target=description]').text();
			
		
			$('#type').val(type);
			$('#title').val(title);
	       	$('#price').val(price);
			$('#price_break').val(price_break);
			$('#price_canc').val(price_canc);
			$('#description').val(description);
			
            $('#userId').val(id);
            $('#myModal').modal('toggle');
      });

      // now create event to get data from fields and update in database 

       $('#save').click(function(){
		  var id  = $('#userId').val(); 

		  var type = $('#type').val();
		  var title = $('#title').val();
		  var price = $('#price').val();
		  var price_break = $('#price_break').val();
		  var price_canc = $('#price_canc').val();
		  var description = $('#description').val();
        
          $.ajax({
              url      : 'connection.php',
              method   : 'post', 
              data     : {  type:type, title:title, price:price,price_break:price_break, price_canc:price_canc, description:description, id: id},
              success  : function(response){
                            // now update user record in table 
						
							 $('#'+id).children('td[data-target=type]').text(type);
							 $('#'+id).children('td[data-target=title]').text(title);
							 $('#'+id).children('td[data-target=price]').text(price);
							 $('#'+id).children('td[data-target=price_break]').text(price_break);
							 $('#'+id).children('td[data-target=price_canc]').text(price_canc);
							 $('#'+id).children('td[data-target=description]').text(description);
                             $('#myModal').modal('toggle'); 

                         }
          });
       });
  });
</script>

<script>
  $(document).ready(function(){

    //  append values in input fields
      $(document).on('click','.add_room',function(){
		
            $('#myModal').modal('toggle');
      });

      // now create event to get data from fields and update in database 

       $('#add').click(function(){
	
		    var room_number  = $('#room_number').val(); 
			var type  = $('#type').val(); 
			var title  = $('#title').val(); 
			var price  = $('#price').val();
			var price_break  = $('#price_break').val(); 
			var price_canc  = $('#price_canc').val();
			var description  = $('#description').val(); 
		
        
          $.ajax({
              url      : 'action.php',
              method   : 'post', 
              data     : { 
							room_number:room_number,
							type:type,
							title:title,
							price:price,
							price_break:price_break,
							price_canc:price_canc,
							description:description},
			  success  : function(response){
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
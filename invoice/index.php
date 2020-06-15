<?php session_start();
session_regenerate_id();
include '../db_connection.php'; 
include 'connection.php';
if($_SESSION['rights'] == 'reception') {

 if(isset($_GET["delete"]) && isset($_GET["id"]))
  {
	
	  $id=$_GET['id'];
	  $sqla = "DELETE FROM reservation WHERE id_reserv = \"".$id."\"";
	  mysqli_query($db,$sqla) or die(mysql_error());
	  $sqlb = "DELETE FROM receipt WHERE id_reserv = \"".$id."\"";
	  mysqli_query($db,$sqlb) or die(mysql_error());
    header("location:../fullcalendar/index.php");
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
if(isset($_GET["id"]))
{
$id=$_GET['id'];
$sql = "SELECT * FROM receipt,reservation WHERE receipt.id_reserv = \"".$id."\" AND reservation.id_reserv = \"".$id."\" AND receipt.id_reserv=reservation.id_reserv";
$result = mysqli_query($db,$sql);
mysqli_fetch_all($result,MYSQLI_ASSOC);


$total_rows = $result->num_rows;

}else{
$sql = "SELECT * FROM receipt,reservation WHERE receipt.id_reserv=reservation.id_reserv";
$result = mysqli_query($db,$sql);
mysqli_fetch_all($result,MYSQLI_ASSOC);


$total_rows = $result->num_rows;
}
?>


    <div class="container-fluid">

	
			<br />
			<table id="data-table" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Book No.</th>
						<th>Book Date</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Room No.</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Address</th>
						<th>Email</th>
						<th>Telephone</th>
						<th>Extra</th>
						<th>Invoice Total</th>
						<th>Invoice PDF</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					</thead>

					<?php
						if ($total_rows > 0)
						{
							foreach($result as $row)
							{?>	
								
									<tr id="<?php echo $row['id_reserv']; ?>">
										<td data-target="Book No"><?php echo $row['id_reserv']; ?></td>
										<td data-target="book_date"><?php echo $row['res_date']; ?></td>
										<td data-target="start_date"><?php echo $row['start_date']; ?></td>
										<td data-target="end_date"><?php echo $row['end_date']; ?></td>
										<td data-target="room_no"><?php echo $row['room_number']; ?></td>
										<td data-target="f_name"><?php echo $row['r_fname'];?></td>
										<td data-target="l_name"><?php echo $row['r_lname'];?></td>
										<td data-target="address"><?php echo $row['r_address']; ?></td>
										<td data-target="email"><?php echo $row['r_email']; ?></td>
										<td data-target="telephone"><?php echo $row['telephone']; ?></td>
							<?php		if ( $row['breakfast']=='no' &&  $row['cancel']=='no'){ ?>
											<td>None</td>
							<?php		}else if ($row['breakfast']=='yes' && $row['cancel']=='no'){ ?>
											<td>Breakfast</td>
							<?php		}else if ($row['breakfast']=='yes' && $row['cancel']=='yes' ){ ?>
											<td>Breakfast/Cancel</td>
							<?php		} else if ($row['breakfast']=='no' && $row['cancel']=='yes'){ ?>
											<td>Cancel</td>
								<?php	} ?>
										<td data-target="total"><?php echo $row['final_price']; ?></td>
								<?php echo '	<td><a href="../receipt_files/Invoice-'.$row['id_reserv'].'.pdf" style="color:red;">PDF</a></td> '; ?>
										<td><a href="#" data-role="update" data-id="<?php echo $row['id_reserv']; ?>"><span class="fa fa-edit"></span></a></td>
								<?php echo '	<td><a href="#" id="'.$row['id_reserv'].'" class="delete" name="delete"> <span class="fa fa-remove"></span></a></td> '; ?>
									</tr>
								
						<?php	}
						}?>
					
				
			   
			</table>
			<a href="../index.php" class="btn btn-dark btn-lg js-scroll-trigger"> Αρχική </a>
			<button id="csv" class="btn btn-dark btn-lg js-scroll-trigger"> ->Export to csv</button>
			<a href="../book/index.php" class="btn btn-dark btn-lg js-scroll-trigger"> <i class="fa fa-calendar-plus-o" aria-hidden="true"></i></a>
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
                <label>Start Date</label>
                <input type="date" id="start_date" class="form-control">
              </div>
			  <div class="form-group">
                <label>End Date</label>
                <input type="date" id="end_date" class="form-control">
              </div>
			  <div class="form-group">
                <label>Room No.</label>
                <input type="number" id="room_no" class="form-control">
              </div>
			  <div class="form-group">
                <label>First Name</label>
                <input type="text" id="f_name" class="form-control">
              </div>
			  <div class="form-group">
                <label>Last Name</label>
                <input type="text" id="l_name" class="form-control">
              </div>
               <div class="form-group">
                <label>Address</label>
                <input type="text" id="address" class="form-control">
              </div>
			  <div class="form-group">
                <label>Telephone</label>
                <input type="text" id="telephone" class="form-control">
              </div>
			  
			  <div class="form-group">
			  <label>Extra</label>
				  <select name="extra" type="text" id="extra" class="form-control">
					<option value="None" name="None">None</option>
					<option value="Breakfast" name="Breakfast">Breakfast</option>
					<option value="Cancel"  name="Cancel">Cancel</option>
					<option value="Breakfast/Cancel"  name="Breakfast/Cancel">Breakfast/Cancel</option>
				 </select>
			 </div>
			<div class="form-group">
                <label>Invoice Total</label>
                <input type="number" step="0.01" id="total" class="form-control">
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
			var start_date  = $('#'+id).children('td[data-target=start_date]').text();
			var end_date  = $('#'+id).children('td[data-target=end_date]').text();
			var room_no  = $('#'+id).children('td[data-target=room_no]').text();
			var f_name  = $('#'+id).children('td[data-target=f_name]').text();
			var l_name  = $('#'+id).children('td[data-target=l_name]').text();		
            var address  = $('#'+id).children('td[data-target=address]').text();
			var telephone  = $('#'+id).children('td[data-target=telephone]').text();
			var extra  = $('#'+id).children('td[data-target=extra]').text();
			var total  = $('#'+id).children('td[data-target=total]').text();
     
			$('#start_date').val(start_date);
			$('#end_date').val(end_date);
			$('#room_no').val(room_no);
			$('#f_name').val(f_name);
			$('#l_name').val(l_name);
            $('#address').val(address);
			$('#telephone').val(telephone);
			$('#extra').val(extra);
			$('#total').val(total);
			
            $('#userId').val(id);
            $('#myModal').modal('toggle');
      });

      // now create event to get data from fields and update in database 

       $('#save').click(function(){
          var id  = $('#userId').val(); 
		  var start_date = $('#start_date').val();
		  var end_date = $('#end_date').val();
		  var room_no = $('#room_no').val();
		  var f_name = $('#f_name').val();
		  var l_name = $('#l_name').val();
		  var address =  $('#address').val();
		  var telephone =  $('#telephone').val();
		  var extra =  $('#extra').val();
		  var total =  $('#total').val();
        
          $.ajax({
              url      : 'connection.php',
              method   : 'post', 
              data     : {start_date:start_date, end_date:end_date, room_no:room_no, f_name:f_name, l_name:l_name, address : address  ,telephone:telephone, extra:extra, total:total, id: id},
              success  : function(response){
                            // now update user record in table 
							 $('#'+id).children('td[data-target=start_date]').text(start_date);
							 $('#'+id).children('td[data-target=end_date]').text(end_date);
							 $('#'+id).children('td[data-target=room_no]').text(room_no);
							 $('#'+id).children('td[data-target=f_name]').text(f_name);
							 $('#'+id).children('td[data-target=l_name]').text(l_name);
                             $('#'+id).children('td[data-target=address]').text(address);
							 $('#'+id).children('td[data-target=telephone]').text(telephone);
							 $('#'+id).children('td[data-target=extra]').text(extra);
							 $('#'+id).children('td[data-target=total]').text(total);
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
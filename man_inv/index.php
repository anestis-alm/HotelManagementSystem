<!DOCTYPE html>  
<html>  
 <head>  
  <meta charset="UTF-8">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
 
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
	

	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
 </head>  
 <body>  
  <br /><br />  
  <div class="container-fluid"  style="width:100%;float:left; ">  
		<h3 align="center">Manager Invoices</h3>  
		<br />
   
   
	   <div align="right">
				<button type="button" name="add" id="add" class="btn btn-success">Add Invoice</button>
	   </div>
		<br />
   
   
	   <div id="image_data">

	   
	   </div>
   
    <div align="left">	
			<a href="../index.php" class="btn btn-success btn-lg js-scroll-trigger"> Back </a>
	</div>	
  </div>  
  
  
 </body>  
</html>

<div id="imageModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Add Invoice</h4>
   </div>
   <div class="modal-body">
    <form id="image_form" method="post" enctype="multipart/form-data">
     <p><label>Select Invoice</label>
     <input type="file" name="image" id="image" /></p><br />
     <input type="hidden" name="action" id="action" value="insert" />
     <input type="hidden" name="image_id" id="image_id" />
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />
      
    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>


<script>  
$(document).ready(function(){
 
 fetch_data();

 function fetch_data()
 {
  var action = "fetch";
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{action:action},
   success:function(data)
   {
    $('#image_data').html(data);
   }
  })
 }
 
	 
	 $('#add').click(function(){
		  $('#imageModal').modal('show');
		  $('#image_form')[0].reset();
		  $('.modal-title').text("Add Image");
		  $('#image_id').val('');
		  $('#action').val('insert');
		  $('#insert').val("Insert");
	});
	 $('#image_form').submit(function(event){
	  event.preventDefault();
	 
				$.ajax({
				 url:"action.php",
				 method:"POST",
				 data:new FormData(this),
				 contentType:false,
				 processData:false,
				 success:function(data)
				 {
				  alert(data);
				  fetch_data();
				  $('#image_form')[0].reset();
				  $('#imageModal').modal('hide');
				 }
				});
		   
	  
	 });
	 

 
 
 $(document).on('click', '.delete', function(){
  var image_id = $(this).attr("id");
  var action = "delete";
  if(confirm("Are you sure you want to remove this image from database?"))
  {
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{image_id:image_id, action:action},
    success:function(data)
    {
     alert(data);
     fetch_data();
    }
   })
  }
  else
  {
   return false;
  }
 });
});  
</script>

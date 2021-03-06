<?php session_start();
	  session_regenerate_id();
	  if($_SESSION['rights'] == 'user' || $_SESSION['rights'] == 'reception') { 
?>
<!DOCTYPE html>
<html >
<head>

<script>
window.onload = function() {
   document.getElementById("start_date").min = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000).toISOString().split("T")[0];
};
</script>

<script>	
window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore.
    window.location.reload();
  }
});
</script>

<script type="text/javascript">


        function GetDays(){
                var dropdt = new Date(document.getElementById("end_date").value);
                var pickdt = new Date(document.getElementById("start_date").value);
                return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
        }

        function cal(){
			
        if(document.getElementById("end_date")){
            document.getElementById("numdays2").value=GetDays();
			}  
		}
	
	function updatedate() {
	
		var firstdate = document.getElementById("start_date").value;
		document.getElementById("end_date").value = "";
		document.getElementById("end_date").setAttribute("min",firstdate);
		
	}
</script>
	
  <meta charset="UTF-8">
  <title>Book</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/style.css">

  
</head>

<body>
	 
      <div class="box">
	  <span class="dot" id="curr"></span>
	  <span class="dot"></span>
	  <span class="dot"></span>
        <form id="contact" action="rooms.php" method="POST" enctype="multipart/form-data"> 
		
			
			<div class="textbox">
			    <h5>Ημερομηνία άφιξης</h5>
				<i class="fa fa-calendar " aria-hidden="true"></i>
				<input type="date" id="start_date" name="start_date"  placeholder="Start_date*" onchange="updatedate()" onchange="cal()" required>
				
			</div>
			
			<div class="textbox">
			    <h5>Ημερομηνία αναχώρησης</h5>
				<i class="fa fa-calendar " aria-hidden="true"></i>
				<input type="date" id="end_date" name="end_date" placeholder="End_date*" min="" onchange="cal()" required>
				
			</div>  
		  
		  <div class="textbook">
			  <h5>Τύπος δωματίου</h5>
			  <i class="fa fa-user-plus  " aria-hidden="true"></i>
			  <select name="type">
					<option value="single" name="single">Μονόκλινο</option>
					<option value="double"  name="double">Δίκλινο</option>
					<option value="family" name="family">Οικογενιακά δωμάτια</option>
			  </select>
			
		  </div>
		  
		  <input type="hidden"  id="numdays2" name="numdays">
          <input type="submit" class="btn" name="search"  value="Αναζήτηση">

         </form>
       </div>
</body>
</html>
<?php } else { 
session_destroy();
header('Location: ../index.php'); 
}?>
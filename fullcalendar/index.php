<?php session_start();
	  session_regenerate_id();
include '../db_connection.php'; ?>

<?php if($_SESSION['rights'] == 'reception') {?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Calendar</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400|Roboto+Condensed:400|Fjalla+One:400'>
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>

  <script src="dist/vis.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <link href="dist/vis.css" rel="stylesheet" type="text/css" />

  
 
 
</head>
<body>

  <h1>Πλάνο Δωματίων</h1>
  <button id="moveTo" type="button"><i class="fas fa-reply"></i></button>
  <button id="moveLeft" type="button"><i class="fas fa-angle-left"></i></button>
  <button id="moveRight" type="button"><i class="fas fa-angle-right"></i></button>
 

<div id="visualization"></div>


<script type="text/javascript">
var container = document.getElementById('visualization');
<?php $sql="SELECT * FROM room";			
				$sqli= mysqli_query($db,$sql) or die("error");
				
	  $sql_res="SELECT * FROM reservation";	
				$sqli_res= mysqli_query($db,$sql_res) or die("error");
?>	 							
						
				
				
  var groups = new vis.DataSet([
  <?php while($r = mysqli_fetch_array($sqli,MYSQLI_ASSOC)){ ?>
    {
	id: <?php echo $r['room_number']; ?>, 
	content: 'Room <?php echo $r['room_number']; ?>', 
	value: <?php echo $r['room_number']; ?>
	},
    
  <?php } ?>
  ]);


  var items = new vis.DataSet([	
  <?php while($row = mysqli_fetch_array($sqli_res,MYSQLI_ASSOC)){
	  list($s_year, $s_month, $s_day) = explode("-",$row['start_date']);
	  list($e_year, $e_month, $e_day) = explode("-",$row['end_date']);
	  $s_month=$s_month-1;
	  $e_month=$e_month-1;

  ?>
    {
		id: <?php echo $row['id_reserv']; ?>,
		group: <?php echo $row['room_number']; ?>,
		content: '<a href="../invoice/index.php?&id=<?php echo $row['id_reserv'] ?>"><?php echo $row['r_fname'] ," ",$row['r_lname'];?></a>',
		start: new Date(<?php echo $s_year ?>, <?php echo $s_month ?>, <?php echo $s_day ?>),
		end: new Date(<?php echo $e_year ?>, <?php echo $e_month ?>, <?php echo $e_day+1 ?>)
	},
	  <?php } ?>
  ]);

  // create visualization
  var container = document.getElementById('visualization');
  var options = {
   
    groupOrder: function (a, b) {
      return a.value - b.value;
    },
    
    start: new Date((new Date()).getTime() - 10*24*60 *60 * 1000),
    end: new Date((new Date()).getTime() + 1000 * 60 * 60 * 24 * 10),
    editable: false,
    zoomMax: 1000 * 60 * 60 * 24 * 20,
	zoomMin: 1000 * 60 * 60 * 24 *5, 
	orientation: 'top',
	showCurrentTime: false
  };

  function move (percentage) {
        var range = timeline.getWindow();
        var interval = range.end - range.start;
        timeline.setWindow({
            start: range.start.valueOf() - interval * percentage,
            end:   range.end.valueOf()   - interval * percentage
        });
    }

  var timeline = new vis.Timeline(container);
  timeline.setOptions(options);
  timeline.setGroups(groups);
  timeline.setItems(items);
 

document.getElementById('moveTo').onclick = function() { timeline.moveTo(new Date()); };
document.getElementById('moveLeft').onclick  = function () { move(0.9); };
document.getElementById('moveRight').onclick = function () { move(-0.9); };	
	  

	
</script>
<a href="../index.php" class="btn btn-dark btn-lg js-scroll-trigger"> Αρχική </a>
</body>
</html>

<?php } else { 
session_destroy(); 
header('Location: ../index.php'); 
}?>
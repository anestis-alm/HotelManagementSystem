<!DOCTYPE html>

<html >
<head>




  <meta charset="UTF-8">
  <title>Κριτικές</title>
  
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../css/reviews.css">

  
</head>

<body>

<form id="hotel_reviews" action="rev-server.php" method="POST" enctype="multipart/form-data">

		
<div class="up">  
		<img src="../img/logo.png" id="img" >
</div>

<div style="clear: both;"></div>	

<div class="row">
 
	<div class="column">
		<div class="rate" id="rat">
				<h5><b>Συνολική βαθμολογία</b></h5>		
							 <input type="radio" id="star5" name="rate" value="5" />
								<label for="star5" title="text">5 stars</label>
								<input type="radio" id="star4" name="rate" value="4" />
								<label for="star4" title="text">4 stars</label>
								<input type="radio" id="star3" name="rate" value="3" />
								<label for="star3" title="text">3 stars</label>
								<input type="radio" id="star2" name="rate" value="2" />
								<label for="star2" title="text">2 stars</label>
								<input type="radio" id="star1" name="rate" value="1" required/>
								<label for="star1" title="text">1 star</label>
		</div>
		<div class="title" id="tit">
				<h5><b>Τίτλος κριτικής</b></h5>
				<input type="text" id="tit_rev" name="tit_rev" placeholder="Συνοψίστε την επίσκεψή σας ή επισημάνετε μια ενδιαφέρουσα λεπτομέρεια" required />			
		</div>
			
		<div class="review" id="rev">
				<h5><b>Η κριτική σας</b></h5>
				<textarea id="rev_rev" name="rev_rev" placeholder="Πείτε μας την εμπειρία σας" required></textarea>			
		</div>
		
		<div class="certify" id="cert">
			<h5><b>Υποβολή κριτικής</b></h5>
			<input type="checkbox" name="cert_rev" value="accept" required  /> 
			<span>Βεβαιώνω ότι η κριτική αυτή βασίζεται στη δική μου εμπειρία και είναι η πραγματική μου γνώμη για αυτό το ξενοδοχείο και ότι δεν έχω καμία προσωπική ή επιχειρηματική σχέση με αυτήν την επιχείρηση, και δεν μου δόθηκε κανένα κίνητρο ή πληρωμή από την επιχείρηση για να γράψω αυτήν την κριτική.</span>					
		</div>
				
		<div class="button" id="but" >			
			<button type="submit" name="submit" class="fabutton" >
                    <i class="fas fa-external-link-alt"></i> Υποβολή κριτικής
			</button>
		</div>
		
	</div>
	
</div>
</form>
      
</body>
</html>













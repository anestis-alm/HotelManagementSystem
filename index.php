<?php include('register_login/server.php');
	  include 'db_connection.php'; 

		$inactive = 1800;
		if(isset($_SESSION['timeout']) ) {
		

		$session_life = time() - $_SESSION['timeout'];

		if($session_life > $inactive)
		{   header("Location:index.php?logout='1'");     }
		}
		$_SESSION['timeout']=time();
	

?>
	 
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Almaliotis Hotel</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">
	
	
	
  </head>

  <body>
  

    <!-- Navigation -->
	
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle">
	<img src="img/logo.png" height="150"  >
      <i class="fa fa-bars"></i>
    </a>
	

	
	
	
	
    <nav id="sidebar-wrapper">
		<?php if(isset($_SESSION['username'])): ?>
		
		<?php
				$usr=$_SESSION['username'];
				$sqlget="SELECT * FROM user WHERE username='$usr'";
			
				$sqldata= mysqli_query($db,$sqlget) or die("error");
				$row = mysqli_fetch_array($sqldata,MYSQLI_ASSOC);

				
			 endif ?>
			 
		<?php if (empty($_SESSION['username']) || $row['rights'] == ''){ ?>
		<ul class="sidebar-nav">
        <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle">
          <i class="fa fa-times"></i>
        </a>
		<li class="sidebar-brand">
          <a class="js-scroll-trigger" href="#top">Αρχική</a>
        </li>
        <li>
          <a class="js-scroll-trigger" href="#about">Πληροφορίες</a>
        </li>
        <li>
          <a class="js-scroll-trigger" href="#services">Υπηρεσίες</a>
        </li>
        <li>
          <a class="js-scroll-trigger" href="#portfolio">Φωτογραφίες</a>
        </li>
        <li>
          <a class="js-scroll-trigger" href="#contact" onclick=$( "#menu-close").click();>Επικοινωνία</a>
        </li>
		<li>
          <a class="js-scroll-trigger" href="#reviews">Κριτικές</a>
        </li>
		<li>
          <a class="js-scroll-trigger" href="register_login/signup.php">Εγγραφή</a>
        </li>
		<li>
          <a class="js-scroll-trigger" href="register_login/login.php">Είσοδος</a>
        </li>
		<?php }else if ($row['rights'] == 'user') { ?>
		<ul class="sidebar-nav">
        <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle">
          <i class="fa fa-times"></i>
        </a>
		<li class="sidebar-brand">
          <a class="js-scroll-trigger" href="#top">Αρχική</a>
        </li>
		<li>
        <a class="js-scroll-trigger" href="#top"><?php echo "Καλωσήρθες ", $_SESSION['username'],"!"; ?></a>
        </li>
		<li>
          <a class="js-scroll-trigger" href="#about">Πληροφορίες</a>
        </li>
        <li>
          <a class="js-scroll-trigger" href="#services">Υπηρεσίες</a>
        </li>
        <li>
          <a class="js-scroll-trigger" href="#portfolio">Φωτογραφίες</a>
        </li>
		<li>
          <a class="js-scroll-trigger" href="#contact" onclick=$( "#menu-close").click();>Επικοινωνία</a>
        </li>
		<li>
          <a class="js-scroll-trigger" href="#book">Κράτηση</a>
        </li>
		<li>
          <a class="js-scroll-trigger" href="#reviews">Κριτικές</a>
        </li>
		<li>
		<a class="js-scroll-trigger" href="index.php?logout='1'">Αποσύνδεση</a>
		</li>
		
		<?php }else if ($row['rights'] == 'reception') { ?>
			 <ul class="sidebar-nav">
				<a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle">
				  <i class="fa fa-times"></i>
				</a>
				<li class="sidebar-brand">
				  <a class="js-scroll-trigger" href="#top">Αρχική</a>
				</li>
				<li>
				<a class="js-scroll-trigger" href="#top"><?php echo "Καλωσήρθες ", $_SESSION['username'],"!"; ?></a>
				</li>

				<li>
				  <a class="js-scroll-trigger" href="#book">Δωμάτια</a>
				</li>
				<li>
				<li>
				<a class="js-scroll-trigger" href="index.php?logout='1'">Αποσύνδεση</a>
				</li>
			 </ul>
		<?php ?>
		
		<?php }else if ($row['rights'] == 'manager') { ?>
			<ul class="sidebar-nav">
				<a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle">
				  <i class="fa fa-times"></i>
				</a>
				<li class="sidebar-brand">
				  <a class="js-scroll-trigger" href="#top">Αρχική</a>
				</li>
				<li>
				<a class="js-scroll-trigger" href="#top"><?php echo "Καλωσήρθες ", $_SESSION['username'],"!"; ?></a>
				</li>
				<li>
				  <a class="js-scroll-trigger" href="#financial">Οικονομικά</a>
				</li>
				<li>
				  <a class="js-scroll-trigger" href="#payments">Πληρωμή</a>
				</li>
				<li>
				<a class="js-scroll-trigger" href="index.php?logout='1'">Αποσύνδεση</a>
				</li>
			 </ul>
		<?php }else if ($row['rights'] == 'admin') { ?>
			<ul class="sidebar-nav">
			<a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle">
			  <i class="fa fa-times"></i>
			</a>
			<li class="sidebar-brand">
			  <a class="js-scroll-trigger" href="#top">Αρχική</a>
			</li>
			<li>
			<a class="js-scroll-trigger" href="#top"><?php echo "Καλωσήρθες ", $_SESSION['username'],"!"; ?></a>
			</li>
			<li>
			  <a class="js-scroll-trigger" href="#photo_manage">Διαχείριση Φωτογραφιών</a>
			</li>
			<li>
			<a class="js-scroll-trigger" href="index.php?logout='1'">Αποσύνδεση</a>
			</li>
		  </ul>
		<?php } ?>
    </nav>
   <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
   <!----------------------------------------------------------------------V I S I T O R S------------------------------------------------------------------------------------------------------>
   <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
	<?php if (empty($_SESSION['username']) || $row['rights'] == ''){ ?>					                               
			
		
    <!-- Header -->
				<?php
				$sql = "SELECT * FROM header_images";
							$sqlim = mysqli_query($db,$sql) or die("error");
							
						if(mysqli_num_rows($sqlim) >0){	
							while($row_num = mysqli_fetch_array($sqlim,MYSQLI_ASSOC)){ 
									
									$ImageArray[] = $row_num['path'];
							}
						}	
				?>


					<header class="header" id="top">
					<?php 
				   if(!empty($_GET['status'])){ ?>
					 <div class="alert">
						<span class="closebtn" onclick="this.parentElement.style.display='none';javascript:location.href='index.php'">&times;</span> 
						Έχετε αποσυνδεθεί επιτυχώς!
					 </div>
				  <?php  } 
						if(!empty($_GET['sent'])){ ?>
						<div class="alert">
							<span class="closebtn" onclick="this.parentElement.style.display='none';javascript:location.href='index.php'">&times;</span> 
							Σας έχει σταλεί mail για την ενεργοποίηση του λογαριασμό σας.
						</div>			
						<?php }  
					if(!empty($_GET['verif'])){ ?>
						<div class="alert">
							<span class="closebtn" onclick="this.parentElement.style.display='none';javascript:location.href='index.php'">&times;</span> 
							Ο λογαριασμός σας ενεργοποιήθηκε! Μπορείτε να συνδεθείτε στο λογαριασμό σας.
						</div>
					<?php } ?>
				  
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<?php                               
											for($j=0;$j<count($ImageArray);$j++){
												if($j==0){
													echo ' <li data-target="#carouselExampleIndicators" data-slide-to="'.$j.'" class="active"></li>';
												}else{
													echo ' <li data-target="#carouselExampleIndicators" data-slide-to="'.$j.'"></li>';
												}
											}
									?>
								</ol>

								<div class="carousel-inner" role="listbox">
								
								<?php for($j=0;$j<count($ImageArray);$j++){
														   

									if($j==0){		
									echo '<div class="carousel-item active" style="background-image: url('.$ImageArray[$j].')"></div>';
									}
									else {	
									echo '<div class="carousel-item" style="background-image: url('.$ImageArray[$j].')"></div>';
									}
								  
								}	
								?> 
								
								</div>

								<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
								  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
								  <span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
								  <span class="carousel-control-next-icon" aria-hidden="true"></span>
								  <span class="sr-only">Next</span>
								</a>
						</div>
					  
					  <div class="text-vertical-center" id="text">
						<h2>Καλώς ήρθατε στο Almaliotis Hotel</h2>
						<hr/>
						<br>
						<a href="#about" class="btn btn-dark btn-lg js-scroll-trigger">ΠΕΡΙΣΣΟΤΕΡΑ 
						<i class="fa fa-arrow-right" aria-hidden="true" style="font-size:17px"></i></a>
					  </div>
					</header>

					<!-- About -->
					
					<section id="about" class="about">
					  <div class="container text-center">
						<h1><b>Το ξενοδοχείο μας</b></h1>
								<p class="big-paragraph">
												<p style="text-align: justify;">
												<span style="color:#000000;">Το Almaliotis Hotel αποτελεί μία ξεχωριστή πρόταση φιλοξενίας στη Κοζάνη. Στεγασμένο στο ιστορικό κτίριο του 1913 και διατηρώντας τη βιομηχανική του αρχιτεκτονική, το ξενοδοχείο ξεχωρίζει από οποιοδήποτε άλλο στη Κοζάνη.</span></p>
								</p>
											<div class="space" style="clear:both; height:20px;">
												
											</div>
											
											<div class="one_third">
											<h3><b>Οι υπηρεσίες μας</b></h3>
												<div class="meter">
														<div style="width:100%" >
														
														<p class="white">Διαμονή</p>
																
															
														</div>
														<p class="big-paragraph">
															<p style="text-align: justify;">
															<span style="color:#000000;">Επιλέξτε για τη διαμονή σας ανάμεσα στα 176 δωμάτιά του, Superior, Deluxe, Business και τις πολυτελείς σουίτες του, Junior και Executive! Όλα τα δωμάτια προσφέρουν πλούσιες παροχές, γραφείο εργασίας και δωρεάν WiFi.</span></p>
														</p>
												</div>
												<div class="meter">
													<div style="width:100%">
														
															<p class="white">Συνέδρια</p>
														
													</div>
													<p class="big-paragraph">
															<p style="text-align: justify;">
															<span style="color:#000000;">Στο Almaliotis Hotel διοργανώνονται τα μεγαλύτερα επαγγελματικά events, τοπικά και διεθνή συνέδρια καθώς και κοινωνικές εκδηλώσεις (γάμοι, βαφτίσεις, επέτειοι κ.α.). Διαθέτει 5 πλήρως εξοπλισμένες αίθουσες συναντήσεων, 5 μεγάλες συνεδριακές και ένα Roof Garden. Το Almaliotis Hotel είναι το μοναδικό ξενοδοχείο στη Κοζάνη που διαθέτει αίθουσα χωρητικότητας έως και 2.500 ατόμων!</span></p>
													</p>
												</div>
												<div class="meter">
													<div style="width:100%">
														
															<p class="white">Παροχές</p>
														
													</div>
													<p class="big-paragraph">
														<p style="text-align: justify;">
														<span style="color:#000000;">Το Almaliotis Hotel είναι λάτρης της υψηλής γαστρονομίας. Σερβίρει το καλύτερο ελληνικό πρωινό της Κοζάνης και τα menu του αποτελούν εμπειρία που πρέπει να γευτείτε! Γνωρίστε τα στο P-Bar και το Zaytinya Restaurant.</span></p>
													</p>	
												</div>
											</div>
									
											
										
									
										
											
											
											
					  </div>
					  <!-- /.container -->
					</section>


    <!-- Services -->
	<?php
	$sqlstay = "SELECT * FROM services_images";
			$qstay = mysqli_query($db,$sqlstay) or die("error");
			
		if(mysqli_num_rows($qstay) >0){	
			while($roww = mysqli_fetch_array($qstay,MYSQLI_ASSOC)){ 
					
					$stay_arr[] = $roww['path'];
					$title_arr[] = $roww['title'];
					$descr_arr[] = $roww['descr'];
			}
		}	
	?>

    <section id="services">
     <div id="carousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php                               
							for($i=0;$i<count($stay_arr);$i++){
								if($i==0){
									echo ' <li data-target="#carousel" data-slide-to="'.$i.'" class="active"></li>';
								}else{
									echo ' <li data-target="#carousel" data-slide-to="'.$i.'"></li>';
								}
							}
					?>
                </ol>

				<div class="carousel-inner" role="listbox">
				
				<?php for($i=0;$i<count($stay_arr);$i++){
                                           

					if($i==0){		
					echo '<div class="carousel-item active"  style=" height: 80vh;background-image: url('.$stay_arr[$i].')">
								<div class="carousel-caption">
									<h1>'.$title_arr[$i].'</h1>
									<p>'.$descr_arr[$i].'</p>
								</div>
						   </div>';
					}
					else {	
					echo '<div class="carousel-item" style="height: 80vh;background-image: url('.$stay_arr[$i].')">
								<div class="carousel-caption">
									<h1>'.$title_arr[$i].'</h1>
									<p>'.$descr_arr[$i].'</p>
								</div>
						   </div>';
					}
				  
				}	
				?> 
				
				</div>

				<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
				  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				  <span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
				  <span class="carousel-control-next-icon" aria-hidden="true"></span>
				  <span class="sr-only">Next</span>
				</a>
		</div>
    </section>

    <!-- Callout -->
	
	<section id="book">
    <aside class="callout">
      <div class="text-vertical-center">
        <h2><b>Για να κάνεις κράτηση πρέπει πρώτα να κάνεις εγγραφή στην σελίδα μας</b></h2>
		<a href="register_login/signup.php" class="btn btn-dark btn-lg js-scroll-trigger"> ΕΔΩ </a>
      </div>
    </aside>
 

	<aside class="photo">  
        <h1><b>Φωτογραφίες</b></h1>	
    </aside>
	</section>
	
    <!-- Portfolio -->
	<?php
	$sqlget = "SELECT * FROM hotel_images";
			$sqldata = mysqli_query($db,$sqlget) or die("error");
			
		if(mysqli_num_rows($sqldata) >0){	
			while($r = mysqli_fetch_array($sqldata,MYSQLI_ASSOC)){ 
					
					$array[] = $r['path'];
			}
		}	
?>

    <section id="portfolio" class="portfolio">
     
		<div id="carouselExample" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php                               
							for($i=0;$i<count($array);$i++){
								if($i==0){
									echo ' <li data-target="#carouselExample" data-slide-to="'.$i.'" class="active"></li>';
								}else{
									echo ' <li data-target="#carouselExample" data-slide-to="'.$i.'"></li>';
								}
							}
					?>
                </ol>

				<div class="carousel-inner" role="listbox">
				
				<?php for($i=0;$i<count($array);$i++){
                                           

					if($i==0){		
					echo '<div class="carousel-item active" style=" height: 60vh; background-image: url('.$array[$i].')"></div>';
					}
					else {	
					echo '<div class="carousel-item" style="height: 60vh; background-image: url('.$array[$i].')"></div>';
					}
				  
				}	
				?> 
				
				</div>

				<a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
				  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				  <span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
				  <span class="carousel-control-next-icon" aria-hidden="true"></span>
				  <span class="sr-only">Next</span>
				</a>
		</div>
                
     
    </section>

    <!-- Call to Action -->
	<aside class="call-to-action2 bg-white text-black">
      <div class="container">
        <h4>Γίνετε μέλος της ταξιδιωτικής μας κοινότητας</h4>
		<h2><b>Συνδεθείτε μαζί μας μέσω των κοινωνικών μας δικτύων.</b></h2>
		<h4>Μοιραζόμαστε ειδήσεις, ιδέες και προσφορές. Επίσης, μας αρέσει να ακούμε από εσάς.</h4>
      </div>
    </aside>
	
    <aside class="call-to-action">
      
	  <div class="container">
        <div class="row">
			<div class="col-lg-10 mx-auto text-center">
				<ul class="list-inline">
				  <li class="list-inline-item">				
					  <i class="fa fa-facebook fa-fw fa-4x text-white"></i>					
				  </li>
				  <li class="list-inline-item">					
					  <i class="fa fa-instagram fa-fw fa-4x text-white"></i>				
				  </li>
				  <li class="list-inline-item">				
					  <i class="fa fa-twitter fa-fw fa-4x text-white"></i>				
				  </li>				
				</ul>
			</div>
        </div>
      </div>

      
    </aside>
	
	<?php
	$sqlrev = "SELECT * FROM reviews";
			$qrev = mysqli_query($db,$sqlrev) or die("error");
			
		if(mysqli_num_rows($qrev) >0){	
			while($rows = mysqli_fetch_array($qrev,MYSQLI_ASSOC)){ 
					$rev_rating[] = $rows['rating'];
					$review[] = $rows['review'];
					$rev_date[] = $rows['date'];
					$rev_usr[] = $rows['username'];
				}
		}	
	?>
	
	<!-- Reviews -->
	<section id="reviews" class="rev">
		
		<h2>ΤΙ ΛΕΝΕ ΟΙ ΠΕΛΑΤΕΣ ΜΑΣ</h2>
		<div class="content">
		<ul>
		<?php for($i=0;$i<count($review);$i++){				
			echo '<div class="mySlides">';
					for($k=0;$k<$rev_rating[$i];$k++){
								echo '<span class="fa fa-star checked" style="color:orange;"></span>';
					}			
			echo '	<h1 id="rev">'.$review[$i].'</h1>
					<h1 id="rev_usr">'.$rev_usr[$i].'</h1>					
					<h1 id="rev_date">'.$rev_date[$i].'</h1>;				
					</div>';	
			}
			?>
		</ul>
		</div>

<script>
var slideIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
    }
    slideIndex++;
    if (slideIndex > x.length) {slideIndex = 1} 
    x[slideIndex-1].style.display = "block"; 
    setTimeout(carousel, 4000); 
}
</script>
		
	</section>
	
    <!-- Map -->
    <section id="contact" class="map">
      <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3042.8690439039265!2d21.79211511566831!3d40.30086657060128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1359d26f27bd3d99%3A0x2593bd023801a63c!2zzqDOtc-BzrPOrM68zr_PhSwgzprOv862zqzOvc63IDUwMSAwMA!5e0!3m2!1sel!2sgr!4v1513089637819" width="600" height="450" frameborder="0" style="border:0"></iframe>
      <br/>
      <small>
        <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3042.8690439039265!2d21.79211511566831!3d40.30086657060128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1359d26f27bd3d99%3A0x2593bd023801a63c!2zzqDOtc-BzrPOrM68zr_PhSwgzprOv862zqzOvc63IDUwMSAwMA!5e0!3m2!1sel!2sgr!4v1513089637819" width="600" height="450" frameborder="0" style="border:0"></a>
      </small>
    </section>
	
	

	
   <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
   <!----------------------------------------------------------------------S I M P L E----------------------------------------------------------------------------------------------------------->
   <!----------------------------------------------------------------------U S E R S------------------------------------------------------------------------------------------------------------->
	<?php }else if ($row['rights'] == 'user') { ?>				                               

	
	
		<?php
				$sql = "SELECT * FROM header_images";
							$sqlim = mysqli_query($db,$sql) or die("error");
							
						if(mysqli_num_rows($sqlim) >0){	
							while($row_num = mysqli_fetch_array($sqlim,MYSQLI_ASSOC)){ 
									
									$ImageArray[] = $row_num['path'];
							}
						}	
				?>


					<header class="header" id="top">
					<?php 
				   if(!empty($_GET['status'])){ ?>
					 <div class="alert">
						<span class="closebtn" onclick="this.parentElement.style.display='none';javascript:location.href='index.php'">&times;</span> 
						Έχετε αποσυνδεθεί επιτυχώς!
					 </div>
				  <?php  } ?>
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<?php                               
											for($j=0;$j<count($ImageArray);$j++){
												if($j==0){
													echo ' <li data-target="#carouselExampleIndicators" data-slide-to="'.$j.'" class="active"></li>';
												}else{
													echo ' <li data-target="#carouselExampleIndicators" data-slide-to="'.$j.'"></li>';
												}
											}
									?>
								</ol>

								<div class="carousel-inner" role="listbox">
								
								<?php for($j=0;$j<count($ImageArray);$j++){
														   

									if($j==0){		
									echo '<div class="carousel-item active" style="background-image: url('.$ImageArray[$j].')"></div>';
									}
									else {	
									echo '<div class="carousel-item" style="background-image: url('.$ImageArray[$j].')"></div>';
									}
								  
								}	
								?> 
								
								</div>

								<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
								  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
								  <span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
								  <span class="carousel-control-next-icon" aria-hidden="true"></span>
								  <span class="sr-only">Next</span>
								</a>
						</div>
					  
					  <div class="text-vertical-center" id="text">
						<h2>Καλώς ήρθατε στο Almaliotis Hotel</h2>
						<hr/>
						<br>
						<a href="#about" class="btn btn-dark btn-lg js-scroll-trigger">ΠΕΡΙΣΣΟΤΕΡΑ 
						<i class="fa fa-arrow-right" aria-hidden="true" style="font-size:17px"></i></a>
					  </div>
					</header>

					<!-- About -->
					
					<section id="about" class="about">
					  <div class="container text-center">
						<h1><b>Το ξενοδοχείο μας</b></h1>
								<p class="big-paragraph">
												<p style="text-align: justify;">
												<span style="color:#000000;">Το Almaliotis Hotel αποτελεί μία ξεχωριστή πρόταση φιλοξενίας στη Κοζάνη. Στεγασμένο στο ιστορικό κτίριο του 1913 και διατηρώντας τη βιομηχανική του αρχιτεκτονική, το ξενοδοχείο ξεχωρίζει από οποιοδήποτε άλλο στη Κοζάνη.</span></p>
								</p>
											<div class="space" style="clear:both; height:20px;">
												
											</div>
											
											<div class="one_third">
											<h3><b>Οι υπηρεσίες μας</b></h3>
												<div class="meter">
														<div style="width:100%" >
														
														<p class="white">Διαμονή</p>
																
															
														</div>
														<p class="big-paragraph">
															<p style="text-align: justify;">
															<span style="color:#000000;">Επιλέξτε για τη διαμονή σας ανάμεσα στα 176 δωμάτιά του, Superior, Deluxe, Business και τις πολυτελείς σουίτες του, Junior και Executive! Όλα τα δωμάτια προσφέρουν πλούσιες παροχές, γραφείο εργασίας και δωρεάν WiFi.</span></p>
														</p>
												</div>
												<div class="meter">
													<div style="width:100%">
														
															<p class="white">Συνέδρια</p>
														
													</div>
													<p class="big-paragraph">
															<p style="text-align: justify;">
															<span style="color:#000000;">Στο Almaliotis Hotel διοργανώνονται τα μεγαλύτερα επαγγελματικά events, τοπικά και διεθνή συνέδρια καθώς και κοινωνικές εκδηλώσεις (γάμοι, βαφτίσεις, επέτειοι κ.α.). Διαθέτει 5 πλήρως εξοπλισμένες αίθουσες συναντήσεων, 5 μεγάλες συνεδριακές και ένα Roof Garden. Το Almaliotis Hotel είναι το μοναδικό ξενοδοχείο στη Κοζάνη που διαθέτει αίθουσα χωρητικότητας έως και 2.500 ατόμων!</span></p>
													</p>
												</div>
												<div class="meter">
													<div style="width:100%">
														
															<p class="white">Παροχές</p>
														
													</div>
													<p class="big-paragraph">
														<p style="text-align: justify;">
														<span style="color:#000000;">Το Almaliotis Hotel είναι λάτρης της υψηλής γαστρονομίας. Σερβίρει το καλύτερο ελληνικό πρωινό της Κοζάνης και τα menu του αποτελούν εμπειρία που πρέπει να γευτείτε! Γνωρίστε τα στο P-Bar και το Zaytinya Restaurant.</span></p>
													</p>	
												</div>
											</div>
									
											
										
									
										
											
											
											
					  </div>
					  <!-- /.container -->
					</section>
					
					
    <!-- Services -->
	<?php
	$sqlstay = "SELECT * FROM services_images";
			$qstay = mysqli_query($db,$sqlstay) or die("error");
			
		if(mysqli_num_rows($qstay) >0){	
			while($roww = mysqli_fetch_array($qstay,MYSQLI_ASSOC)){ 
					
					$stay_arr[] = $roww['path'];
					$title_arr[] = $roww['title'];
					$descr_arr[] = $roww['descr'];
			}
		}	
	?>

    <section id="services">
     <div id="carousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php                               
							for($i=0;$i<count($stay_arr);$i++){
								if($i==0){
									echo ' <li data-target="#carousel" data-slide-to="'.$i.'" class="active"></li>';
								}else{
									echo ' <li data-target="#carousel" data-slide-to="'.$i.'"></li>';
								}
							}
					?>
                </ol>

				<div class="carousel-inner" role="listbox">
				
				<?php for($i=0;$i<count($stay_arr);$i++){
                                           

					if($i==0){		
					echo '<div class="carousel-item active"  style=" height: 80vh;background-image: url('.$stay_arr[$i].')">
								<div class="carousel-caption">
									<h1>'.$title_arr[$i].'</h1>
									<p>'.$descr_arr[$i].'</p>
								</div>
						   </div>';
					}
					else {	
					echo '<div class="carousel-item" style="height: 80vh;background-image: url('.$stay_arr[$i].')">
								<div class="carousel-caption">
									<h1>'.$title_arr[$i].'</h1>
									<p>'.$descr_arr[$i].'</p>
								</div>
						   </div>';
					}
				  
				}	
				?> 
				
				</div>

				<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
				  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				  <span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
				  <span class="carousel-control-next-icon" aria-hidden="true"></span>
				  <span class="sr-only">Next</span>
				</a>
		</div>
    </section>

    <!-- Callout -->
	
	<section id="book">
    <aside class="callout">
      <div class="text-vertical-center">
        <h2><b>Κάνε τώρα κράτηση</b></h2>
		<a href="book/index.php" class="btn btn-dark btn-lg js-scroll-trigger"> ΕΔΩ </a>
		<h5>Μεγάλη ποικιλία δωματίων.</h5>
      </div>
    </aside>
 

	<aside class="photo">  
        <h1><b>Φωτογραφίες</b></h1>	
    </aside>
	</section>

    <!-- Portfolio -->
	<?php
	$sqlget = "SELECT * FROM hotel_images";
			$sqldata = mysqli_query($db,$sqlget) or die("error");
			
		if(mysqli_num_rows($sqldata) >0){	
			while($r = mysqli_fetch_array($sqldata,MYSQLI_ASSOC)){ 
					
					$array[] = $r['path'];
			}
		}	
?>

    <section id="portfolio" class="portfolio">
     
		<div id="carouselExample" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php                               
							for($i=0;$i<count($array);$i++){
								if($i==0){
									echo ' <li data-target="#carouselExample" data-slide-to="'.$i.'" class="active"></li>';
								}else{
									echo ' <li data-target="#carouselExample" data-slide-to="'.$i.'"></li>';
								}
							}
					?>
                </ol>

				<div class="carousel-inner" role="listbox">
				
				<?php for($i=0;$i<count($array);$i++){
                                           

					if($i==0){		
					echo '<div class="carousel-item active" style="height:60vh; background-image: url('.$array[$i].')"></div>';
					}
					else {	
					echo '<div class="carousel-item" style="height:60vh; background-image: url('.$array[$i].')"></div>';
					}
				  
				}	
				?> 
				
				</div>

				<a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
				  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				  <span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
				  <span class="carousel-control-next-icon" aria-hidden="true"></span>
				  <span class="sr-only">Next</span>
				</a>
		</div>
                
     
    </section>

    <!-- Call to Action -->
	<aside class="call-to-action2 bg-white text-black">
      <div class="container">
        <h4>Γίνετε μέλος της ταξιδιωτικής μας κοινότητας</h4>
		<h2><b>Συνδεθείτε μαζί μας μέσω των κοινωνικών μας δικτύων.</b></h2>
		<h4>Μοιραζόμαστε ειδήσεις, ιδέες και προσφορές. Επίσης, μας αρέσει να ακούμε από εσάς.</h4>
      </div>
    </aside>
	
    <aside class="call-to-action">
      
	  <div class="container">
        <div class="row">
			<div class="col-lg-10 mx-auto text-center">
				<ul class="list-inline">
				  <li class="list-inline-item">				
					  <i class="fa fa-facebook fa-fw fa-4x text-white"></i>					
				  </li>
				  <li class="list-inline-item">					
					  <i class="fa fa-instagram fa-fw fa-4x text-white"></i>				
				  </li>
				  <li class="list-inline-item">				
					  <i class="fa fa-twitter fa-fw fa-4x text-white"></i>				
				  </li>				
				</ul>
			</div>
        </div>
      </div>

      
    </aside>
	
	<?php
	$sqlrev = "SELECT * FROM reviews";
			$qrev = mysqli_query($db,$sqlrev) or die("error");
			
		if(mysqli_num_rows($qrev) >0){	
			while($rows = mysqli_fetch_array($qrev,MYSQLI_ASSOC)){ 
					$rev_rating[] = $rows['rating'];
					$review[] = $rows['review'];
					$rev_date[] = $rows['date'];
					$rev_usr[] = $rows['username'];
				}
		}	
	?>
	
	<!-- Reviews -->
	<section id="reviews" class="rev">
		
		<h2>ΤΙ ΛΕΝΕ ΟΙ ΠΕΛΑΤΕΣ ΜΑΣ</h2>
		
		<div class="content">
		<ul>
		<?php for($i=0;$i<count($review);$i++){				
			echo '<div class="mySlides">';
					for($k=0;$k<$rev_rating[$i];$k++){
								echo '<span class="fa fa-star checked" style="color:orange;"></span>';
					}			
			echo '	<h1 id="rev">'.$review[$i].'</h1>
					<h1 id="rev_usr">'.$rev_usr[$i].'</h1>					
					<h1 id="rev_date">'.$rev_date[$i].'</h1>;				
					</div>';	
			}
			?>
		</ul>
		</div>
		<div class="myrev">
			<a href="reviews/reviews.php" class="btn btn-dark btn-lg js-scroll-trigger"><h5><b>Γράψτε μας την κριτική σας</b></h5></a>
			<i class="fa fa-plus"></i>
		</div>

<script>
var slideIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
    }
    slideIndex++;
    if (slideIndex > x.length) {slideIndex = 1} 
    x[slideIndex-1].style.display = "block"; 
    setTimeout(carousel, 4000); 
}
</script>
		
	</section>
	
    <!-- Map -->
    <section id="contact" class="map">
      <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3042.8690439039265!2d21.79211511566831!3d40.30086657060128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1359d26f27bd3d99%3A0x2593bd023801a63c!2zzqDOtc-BzrPOrM68zr_PhSwgzprOv862zqzOvc63IDUwMSAwMA!5e0!3m2!1sel!2sgr!4v1513089637819" width="600" height="450" frameborder="0" style="border:0"></iframe>
      <br/>
      <small>
        <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3042.8690439039265!2d21.79211511566831!3d40.30086657060128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1359d26f27bd3d99%3A0x2593bd023801a63c!2zzqDOtc-BzrPOrM68zr_PhSwgzprOv862zqzOvc63IDUwMSAwMA!5e0!3m2!1sel!2sgr!4v1513089637819" width="600" height="450" frameborder="0" style="border:0"></a>
      </small>
    </section>
	

	
   <!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
   <!----------------------------------------------------------------------R E C E P T I O N------------------------------------------------------------------------------------------------------->
   <!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
   
   
	<?php }else if ($row['rights'] == 'reception') { ?>	
	    <section id="top">
		<?php 
	   if(!empty($_GET['status'])){ ?>
		 <div class="alert">
			<span class="closebtn" onclick="this.parentElement.style.display='none';javascript:location.href='index.php'">&times;</span> 
			Έχετε αποσυνδεθεί επιτυχώς!
		 </div>
	  <?php  } ?>		
	</section>
	
    
	<section id="book">
    <aside class="callout">
      <div class="text-vertical-center">
        <h2><b>Reception</b></h2>
		<a href="fullcalendar/index.php" class="btn btn-dark btn-lg js-scroll-trigger"> ΠΛΑΝΟ ΔΩΜΑΤΙΩΝ </a>
		<a href="invoice/index.php" class="btn btn-dark btn-lg js-scroll-trigger"> ΔΙΑΧΕΙΡΙΣΗ ΚΡΑΤΗΣΕΩΝ </a>

      </div>
    </aside>
	
	</section>


   <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
   <!----------------------------------------------------------------------M A N A G E R---------------------------------------------------------------------------------------------------------->
   <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
	<?php }else if ($row['rights'] == 'manager') { ?>		
		<!-- Header -->

    <section  id="top">
		  <?php 
		   if(!empty($_GET['status'])){ ?>
			 <div class="alert">
				<span class="closebtn" onclick="this.parentElement.style.display='none';javascript:location.href='index.php'">&times;</span> 
				Έχετε αποσυνδεθεί επιτυχώς!
			 </div>
		  <?php  } ?>
	</section>

   

	<section id="financial">
    <aside class="callout">
      <div class="text-vertical-center">
        <h2><b>Έσοδα-Έξοδα Ξενοδοχείου</b></h2>
		<a href="man_fin/financial.php" class="btn btn-dark btn-lg js-scroll-trigger"> Προβολή Έσοδων-Έξοδων Ξενοδοχείου </a>
		<a  href="man_fin/insert_fin.php" class="btn btn-dark btn-lg js-scroll-trigger">Εκχώρηση Νέου Εσόδου-Εξόδου Ξενοδοχείου</a>
		<a  href="man_inv/index.php" class="btn btn-dark btn-lg js-scroll-trigger">Τιμολόγια Ξενοδοχείου</a>
      </div>
	 
    </aside>
	</section>
	
	<section id="payments">
    <aside class="callout">
      <div class="text-vertical-center">
        <h2><b>Πληρωμές Ξενοδοχείου</b></h2>
		<a href="man_payments/payments.php" class="btn btn-dark btn-lg js-scroll-trigger"> Προβολή Πληρωμών </a>
		<a href="man_payments/insert_payment.php" class="btn btn-dark btn-lg js-scroll-trigger"> Εκχώρηση Νέας Πληρωμής </a>
		<a href="man_payments/insert_paid.php" class="btn btn-dark btn-lg js-scroll-trigger"> Εκχώρηση Νέου Προμηθευτή/Νέου Μέλους του Προσωπικού </a>
		<a href="man_payments/persons.php" class="btn btn-dark btn-lg js-scroll-trigger"> Προβολή Προμηθευτών/Προσωπικού </a>
      </div>
    </aside>
	</section>

  
   <!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
   <!----------------------------------------------------------------------A D M I N--------------------------------------------------------------------------------------------------------------->
   <!----------------------------------------------------------------------U S E R----------------------------------------------------------------------------------------------------------------->
   
	<?php }else if ($row['rights'] == 'admin') { ?>		
			<section  id="top">
						<?php 
					   if(!empty($_GET['status'])){ ?>
						 <div class="alert">
							<span class="closebtn" onclick="this.parentElement.style.display='none';javascript:location.href='index.php'">&times;</span> 
							Έχετε αποσυνδεθεί επιτυχώς!
						 </div>
					  <?php  } ?>
				</section>

				<!-- About -->
				
			   

				<section id="photo_manage">
					<aside class="callout">
					  <div class="text-vertical-center">
						<h2><b>Διαχείριση Φωτογραφιών</b></h2>
						<a href="header_car/index.php" class="btn btn-dark btn-lg js-scroll-trigger"> Διαχείριση Φωτογραφιών Επικεφαλίδας </a>
						<a  href="hotel_car/index.php" class="btn btn-dark btn-lg js-scroll-trigger"> Διαχείριση Φωτογραφιών Ξενοδοχείου </a>
						<a  href="rooms_car/index.php" class="btn btn-dark btn-lg js-scroll-trigger"> Διαχείριση Φωτογραφιών Δωματίων </a>
					  </div>
					 
					</aside>
				</section>

				<section id="users_manage">
					<aside class="callout">
					  <div class="text-vertical-center">
						<a href="user_edit/index.php" class="btn btn-dark btn-lg js-scroll-trigger"> Διαχείριση Ατόμων</a>	
						<a href="rooms_edit/index.php" class="btn btn-dark btn-lg js-scroll-trigger"> Διαχείριση Δωματίων</a>	
					  </div>		 
					</aside>
				</section>

			
	<?php } ?>

		<!-- Footer -->
			   <footer>
				  <div class="container">
					<div class="row">
					  <div class="col-lg-10 mx-auto text-center text-white ">
						<h4>
						  <strong>Almaliotis Hotel</strong>
						</h4>
						<p>Κοζάνη
						  <br>Περγάμου, 50100</p>
						<ul class="list-unstyled">
						  <li>
							<i class="fa fa-phone fa-fw"></i>
							(123) 456-7890</li>
						  <li>
							<i class="fa fa-envelope-o fa-fw"></i>
							<a href="mailto:name@example.com"><font color="white">almaliotis.hotel@gmail.com</font></a>
						  </li>
						</ul>
						<br>
						<ul class="list-inline">
						  <li class="list-inline-item ">
							<a href="#">
							  <i class="fa fa-facebook fa-fw fa-3x"></i>
							</a>
						  </li>
						  <li class="list-inline-item">
							<a href="#">
							  <i class="fa fa-twitter fa-fw fa-3x"></i>
							</a>
						  </li>
						  <li class="list-inline-item">
							<a href="#">
							  <i class="fa fa-dribbble fa-fw fa-3x"></i>
							</a>
						  </li>
						</ul>
						
						<p class="text-muted ">Copyright &copy; almaliotis-hotel.com 2019</p>
					  </div>
					</div>
				  </div>
				  <a id="to-top" href="#top" class="btn btn-dark btn-lg js-scroll-trigger">
					<i class="fa fa-chevron-up fa-fw fa-1x"></i>
				  </a>
				</footer>
				
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/stylish-portfolio.js"></script>

  </body>

</html>

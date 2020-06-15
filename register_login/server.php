<?php
	session_start();
	session_regenerate_id();
			
	$username="";
	$db = mysqli_connect('localhost','root','','hotel');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	
	
		if (isset($_POST['register'])){	
		
		$username = mysqli_real_escape_string($db,$_POST['user']);
		$name = mysqli_real_escape_string($db,$_POST['name']);
		$password = mysqli_real_escape_string($db,$_POST['pass']);
		$n_password = md5($password);
		$email = mysqli_real_escape_string($db,$_POST['email']);	
	
		$sql_u = "SELECT * FROM user WHERE username='$username'";
		$sql_e = "SELECT * FROM user WHERE email='$email'";
		$res_u = mysqli_query($db, $sql_u);
		$res_e = mysqli_query($db, $sql_e);
		
		
		if (mysqli_num_rows($res_u) == 0  && mysqli_num_rows($res_e) == 0) {
				
			$sql = "INSERT INTO user (username ,name, email ,password, rights ) 
					VALUES ('$username','$name','$email', '$n_password','')";
			mysqli_query($db, $sql);
		
		
		//$_SESSION['username'] = $username;
		//$_SESSION['loggedIn'] = true;
		//header('location: verification.php?username='.$username.'' );
		
		require '../vendor/autoload.php';

							$mail = new PHPMailer(true);
					try{
							
							$mail->isSMTP();  
							$mail->CharSet = 'UTF-8';
							// Set mailer to use SMTP
							$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
							$mail->SMTPAuth = true;                               // Enable SMTP authentication
							$mail->Username = 'almaliotis.hotel@gmail.com';                 // SMTP username
							$mail->Password = 'gilera123';                           // SMTP password
							$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
							$mail->Port = 587;                                    // TCP port to connect to

							$mail->setFrom('almaliotis.hotel@gmail.com','Almaliotis Hotel');													
							$mail->addAddress($email,$email);            
							
						
							$mail->isHTML(true);                                  // Set email format to HTML

							$mail->Subject = 'Ενεργοποίηση λογαριασμού';
							$mail->Body    = 'Παρακαλώ πατήστε <a href="https://bibi-hotel.online/register_login/verification.php?username='.$username.'">εδώ</a> για την ενεργοποίηση του λογαριασμού σας';
											  
							$mail->AltBody = 'Παρακαλώ πατήστε <a href="https://bibi-hotel.online/register_login/verification.php?username='.$username.'">εδώ</a> για την ενεργοποίηση του λογαριασμού σας';
							$mail->send();
							
							header('location: ../index.php?sent=true' );
							
							
					} catch (Exception $e){
							echo 'Email could not be sent.';
							echo 'Mailer Error:' .$mail->ErrorInfo;
							}		
			
		}else{
			header('location: signup.php' );
		}
	}	
	
	
	
	
	
	if (isset($_POST['login'])){
		$username = mysqli_real_escape_string($db,$_POST['user']);
		$password = mysqli_real_escape_string($db,$_POST['pass']);
		$n_password = md5($password);

			
			$query = "SELECT * FROM user WHERE username = '$username' and password = '$n_password'";
			$result=mysqli_query($db, $query);
			if (mysqli_num_rows($result) == 1){
				while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){ 					
					$rights=$row['rights'];			
				}
				$_SESSION['username'] = $username;
				$_SESSION['rights'] = $rights;
				$_SESSION['loggedIn'] = true;
				
					header('location: ../index.php');
				
			}else{			
				header('location: login.php?error=1');
			}
	}
	
	if (isset($_POST['new_pas'])){
	$password1 = mysqli_real_escape_string($db,$_POST['pass1']);
	$password2 = mysqli_real_escape_string($db,$_POST['pass2']);
	$new_pass = md5($password1);
	$id_user = mysqli_real_escape_string($db,$_POST['user_id']); 
	
		if ($password1==$password2){
			$result  = mysqli_query($db , "UPDATE user SET password='$new_pass'WHERE user_id='$id_user'");
			header('location: login.php?succ=1');
			
		} else {
			header('location: forgot-link.php?id='.$id_user.' & error=1');
			
		}
	
	}
	
	
	if (isset($_POST['forgot'])){
		$username = mysqli_real_escape_string($db,$_POST['user']);
		$email = mysqli_real_escape_string($db,$_POST['email']);
		
		
		$query = "SELECT * FROM user WHERE username = '$username' and email = '$email'";
		$result=mysqli_query($db, $query);
		$row=mysqli_fetch_array($result);
		echo $row['user_id'];
		if (mysqli_num_rows($result) > 0){						
							require '../vendor/autoload.php';

							$mail = new PHPMailer(true);
					try{
							
							$mail->isSMTP();  
							$mail->CharSet = 'UTF-8';
							// Set mailer to use SMTP
							$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
							$mail->SMTPAuth = true;                               // Enable SMTP authentication
							$mail->Username = 'almaliotis.hotel@gmail.com';            // SMTP username
							$mail->Password = 'gilera123';                           // SMTP password
							$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
							$mail->Port = 587;                                    // TCP port to connect to

							$mail->setFrom('almaliotis.hotel@gmail.com','Almaliotis Hotel');													
							$mail->addAddress($email,$email);            
							
						
							$mail->isHTML(true);                                  // Set email format to HTML

							$mail->Subject = 'Ανάκτηση κωδικού πρόσβασης';
							$mail->Body    = 'Παρακαλώ πατήστε <a href="https://bibi-hotel.online/register_login/forgot-link.php?id='.$row['user_id'].'">εδώ</a> για τη δημιουργία νέου κωδικού πρόσβασης';
											  
							$mail->AltBody = 'Παρακαλώ πατήστε <a href="https://bibi-hotel.online/register_login/forgot-link.php?id='.$row['user_id'].'">εδώ</a> για τη δημιουργία νέου κωδικού πρόσβασης';
							$mail->send();
							
							header('location: login.php?success=1');
							
							
					} catch (Exception $e){
							echo 'Email could not be sent.';
							echo 'Mailer Error:' .$mail->ErrorInfo;
							}		
							

		}else{
			header('location: forgot.php?error=1');
		}
	}
	
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header('location: index.php?status=loggedout');
	}
	
	

?>
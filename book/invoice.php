<?php	session_start();
		session_regenerate_id();
		include '../db_connection.php'; 
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
 
$id=$_GET['id'];

if(isset($_GET["id"]))
{
	require_once 'pdf.php';
	$sql = "SELECT * FROM receipt,reservation WHERE receipt.id_reserv = \"".$id."\" AND reservation.id_reserv = \"".$id."\" AND receipt.id_reserv=reservation.id_reserv";
	$result = mysqli_query($db,$sql);
	mysqli_fetch_all($result,MYSQLI_ASSOC);
	
foreach($result as $row)
 {	
$price=$row['final_price'] - $row['price'];
$vat=$row['final_price'] * 0.24;
$total=$row['final_price']+$vat;
$email=$row['r_email'];
		

$html = '
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		 <style>
          *{ font-family: DejaVu Sans !important;}
        </style>
		<table width="100%" border="0"  cellspacing="0" >
		 <tr>
			<td align="right"><img src="logo.png"   height="150" ></td>
		 </tr>
		</table>
		
      
				<table width="100%" border="0"  style="border-collapse: collapse;">
					<tr>
						<td width="40%"  style="font-size:18px;">
								<font color="red"><b>ΑΠΟΔΕΙΞΗ ΚΡΑΤΗΣΗΣ ΣΕ:</b></font><br />							
							    '.$row['r_fname'].' '.$row['r_lname'].'<br />
								'.$row['r_address'].'<br />
								'.$row['telephone'].'				
						</td>
							<td style="border-right:2px solid #808080;text-align:center;">			
									<b>ΑΡΙΘΜΟΣ ΑΠΟΔΕΙΞΗΣ</b><br />
										'.$row['id_reserv'].'
							</td>
							<td style="border-right:2px solid #808080;text-align:center;">
									<b>ΗΜΕΡΟΜΗΝΙΑ ΑΠΟΔΕΙΞΗΣ</b><br />
										'.$row['res_date'].'
							</td>
							<td style="text-align:center;">
									<b>ΑΡΙΘΜΟΣ ΔΩΜΑΤΙΟΥ</b><br />
										'.$row['room_number'].'
							</td>
																	
					
					</tr>		
				</table><br /><br /><br />
		
				<table width="100%" border="0"  cellpadding="14" style="border-bottom:2px solid #808080;border-top:2px solid #808080;color:red;">
					<tr>			
						<th width="25%">ΥΠΗΡΕΣΙΑ</th>
						<th width="30%">ΠΕΡΙΓΡΑΦΗ</th>
						<th width="15%">ΧΡΕΩΣΕΙΣ</th>
						<th width="15%">ΣΥΝΟΛΟ</th>
					</tr>
				</table>
				<table width="100%" border="0" cellpadding="14">
					<tr>
						<td width="25%"> Τιμή Δωματίου</td>
						<td width="30%"> Συνολικό Ποσό Δωματίου</td>
						<td width="15%">'.$row['price'].'&euro; </td>
						<td width="15%"> '.$row['price'].'&euro;</td>
					</tr>
					<tr>
						<td width="25%"> Υπηρεσίες Δωματίου</td>
						<td width="30%"> Πρωινό & Ακύρωση</td>
						<td width="15%">'.$price.'&euro;</td>
						<td width="15%"> '.$price.'&euro;</td>
					</tr>
				</table><br /><br /><br /><br />
				
				<table width="30%" border="0"  cellpadding="10" style="border-bottom:2px solid #808080;border-top:2px solid #808080;">
					<tr>			
						<td>Υποσύνολο:</td>
						<td align="right">'.$row['final_price'].'&euro;</td></td>
					</tr>
					<tr>
						<td>Φόρος[24%]:</td>
						<td align="right">'.$vat.'&euro;</td></td>
					</tr>				
				</table>
				
				
				<table width="30%" border="0"  cellpadding="10" style="border-bottom:2px solid #808080;">
					<tr>
						<th><font color="red">ΣΥΝΟΛΟ ΠΛΗΡΩΜΗΣ:</font></th>
						<td align="right">'.$total.'&euro;</td>
					</tr>
				</table>
				
				<br /><br /><br />
				<table width="100%">
					<tr>
						<td colspan="3" align="right" style="font-size:30px;">Ευχαριστούμε!<td/>	
					</tr>
					<tr>
							<td width="35%" style="border-right:10px solid #FF0000;">			
									almaliotis.hotel@gmail.com<br />
									https://almaliotis--hotel.online/
							</td>

							<td width="65%" align="right">								
									Επισκεφτείτε μας στη Περγάμου, Κοζάνη 50100 <br />
									Πόλη, Κοζάνη | Τηλέφωνο (123) 456-7890
							</td>
					</tr>
				</table>
		';
	  
 }	
     
  
 
 
 $pdf = new Pdf();

 $pdf->loadHtml($html,'UTF-8');
 $pdf->render();
 file_put_contents('../receipt_files/Invoice-'.$row["id_reserv"].'.pdf', $pdf->output());
 
 
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

							$mail->setFrom('almaliotis.hotel@gmail.com','Almaliotis Hotel');														$mail->addAddress($email,$email);     // Add a recipient
							$mail->addAddress($email,$email);            
							
						
							$mail->isHTML(true);                                  // Set email format to HTML

							$mail->Subject = 'Απόδειξη κράτησης';
							$mail->Body    = 'Ευχαριστούμε για την προτίμηση σας!';
											  
							$mail->AltBody = 'Ευχαριστούμε για την προτίμηση σας';										  
							$mail->addAttachment('../receipt_files/Invoice-'.$row["id_reserv"].'.pdf');
							$mail->send();
							
						
							
							
					} catch (Exception $e){
							echo 'Email could not be sent.';
							echo 'Mailer Error:' .$mail->ErrorInfo;
							}	
							
							
							
							
							
	if($_SESSION['rights'] == 'user' ) { 
		header('location: ../index.php' );
	}else if ($_SESSION['rights'] == 'reception'){
			header( 'location:../invoice/index.php' );
	}
 
}
?>
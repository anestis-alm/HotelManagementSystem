<?php
include '../db_connection.php'; 




if(isset($_POST['address'])){
	
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$room_no = $_POST['room_no'];
	$f_name = $_POST['f_name'];
	$l_name = $_POST['l_name'];
	$address = $_POST['address'];
	$telephone = $_POST['telephone'];
	$total = $_POST['total'];
	$extra = $_POST['extra'];
	$id = $_POST['id'];

	if ($extra=='None'){
	$result  = mysqli_query($db , "UPDATE reservation SET start_date='$start_date',end_date='$end_date',room_number='$room_no',r_fname='$f_name',r_lname='$l_name',r_address='$address',telephone='$telephone', final_price='$total',breakfast='no',cancel='no'
							 WHERE id_reserv='$id'");
	}else if ($extra=='Breakfast'){
		$result  = mysqli_query($db , "UPDATE reservation SET start_date='$start_date',end_date='$end_date',room_number='$room_no',r_fname='$f_name',r_lname='$l_name',r_address='$address',telephone='$telephone', final_price='$total',breakfast='yes',cancel='no'
							 WHERE id_reserv='$id'");
	}else if ($extra=='Cancel'){	
		$result  = mysqli_query($db , "UPDATE reservation SET start_date='$start_date',end_date='$end_date',room_number='$room_no',r_fname='$f_name',r_lname='$l_name',r_address='$address',telephone='$telephone', final_price='$total',breakfast='no',cancel='yes'
							 WHERE id_reserv='$id'");
	}else if ($extra=='Breakfast/Cancel'){	
		$result  = mysqli_query($db , "UPDATE reservation SET start_date='$start_date',end_date='$end_date',room_number='$room_no',r_fname='$f_name',r_lname='$l_name',r_address='$address',telephone='$telephone', final_price='$total',breakfast='yes',cancel='yes'
							 WHERE id_reserv='$id'");
	}else {
		$result  = mysqli_query($db , "UPDATE reservation SET start_date='$start_date',end_date='$end_date',room_number='$room_no',r_fname='$f_name',r_lname='$l_name',r_address='$address',telephone='$telephone', final_price='$total'
							 WHERE id_reserv='$id'");
	}
	
	if($result){
		echo 'data updated';
	}else{
		echo 'data updated';
	}	
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
	<title>Sign-UP</title>
    <link rel="stylesheet" href="../css/register_style.css">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
	<script type="text/javascript" src="jquery-1.2.6.min.js"></script>



<SCRIPT type="text/javascript">
<!--


pic1 = new Image(16, 16); 
pic1.src = "loader.gif";

$(document).ready(function(){

$("#user").change(function() { 

var usr = $("#user").val();

if(usr.length >= 4)
{
$("#status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "check.php",  
    data: "username="+ usr,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#user").removeClass('object_error'); // if necessary
		$("#user").addClass("object_ok");
		$(this).html('&nbsp;<img src="tick.gif" align="absmiddle">');
	}  
	else  
	{  
		$("#user").removeClass('object_ok'); // if necessary
		$("#user").addClass("object_error");
		$(this).html(msg);
	}  
   
   });

 } 
   
  }); 

}
else
	{
	$("#status").html('<font color="red">Το όνομα χρήστη πρέπει να αποτελείται από τουλάχιστον <strong>4</strong> χαρακτήρες.</font>');
	$("#username").removeClass('object_ok'); // if necessary
	$("#username").addClass("object_error");
	}

});

});

//-->
</SCRIPT>

<SCRIPT type="text/javascript">


pic1 = new Image(16, 16); 
pic1.src = "loader.gif";

$(document).ready(function(){

$("#email").change(function() { 

var usr = $("#email").val();

if(usr.length >= 4)
{
$("#status2").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "check.php",  
    data: "email="+ usr,  
    success: function(msg){  
   
   $("#status2").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#email").removeClass('object_error'); // if necessary
		$("#email").addClass("object_ok");
		$(this).html('&nbsp;<img src="tick.gif" align="absmiddle">');
	}  
	else  
	{  
		$("#email").removeClass('object_ok'); // if necessary
		$("#email").addClass("object_error");
		$(this).html(msg);
	}  
   
   });

 } 
   
  }); 

}


});

});

//-->
</SCRIPT>

  </head>
  <body>
    <div class="signup-form">
      <form id="contact" action="server.php" method="POST" enctype="multipart/form-data"> 
        <h1>Εγγραφή</h1>
		<input type="text" id="user" name="user" placeholder="Όνομα Χρήστη*" class="txtb" required><div id="status"></div>
        <input type="text" id="name" name="name" placeholder="Ονοματεπώνυμο*" class="txtb" required> 
        <input type="email" id="email" name="email" placeholder="Διεύθυνση Email*" class="txtb" required><div id="status2"></div>
        <input type="password" id="pass" name="pass" placeholder="Κωδικός πρόσβασης*" class="txtb" required autocomplete="off">
		<input type="submit" name="register"  value="Εγγραφή" class="signup-btn">
        <a class="link" href="login.php">Είστε ήδη μέλος? Εισέλθετε εδώ!</a>
      </form>
    </div>
  </body>
</html>

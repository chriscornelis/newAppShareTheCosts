<?php
session_start();

	include_once('classes/User.class.php');
	$feedback = " ";
	if(isset($_POST['register']))
	{
		if(!empty($_POST['name_register']) && !empty($_POST['mail_register']) && !empty($_POST['password_register']))
		{
			
			try
			{
				$user = new User();
				$user->Name = $_POST['name_register'];
				$user->Email = $_POST['mail_register'];
				$user->Pass = $_POST['password_register'];
				
				
				//$feedback = "Top, je hebt een account nu!";
				if($user->UsernameAvailable())
				{
					$user->Save();
					$_SESSION["UserID"] = $id;
					$_SESSION["UserName"] = $_POST['name_register'];
					$feedback = "Top, je hebt een account nu!";
					header('Location: http://localhost:8888/newAppShareTheCosts/overzichtlijsten.php');
					exit();
				}
				else
				{
					$feedback = "Sorry, deze gebruikersnaam bestaat al";
				}
			}
			catch(Exception $e)
			{
				$feedback = $e->getMessage();
			}
		}
		else
		{
			$feedback = "Vergeet niet alle velden in te vullen";
		}
	}
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title>ShareTheCosts</title>
		<meta name="description" content="" />
		<meta name="author" content="Chris Cornelis" />

		<meta name="viewport" content="width=device-width; initial-scale=1.0" />

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
		
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
		
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#name_register").keyup(function(){
		var Name = $("#name_register").val();
		//console.log(username);
		
		$.ajax({
			type: "POST",
			url: "ajax/check_username.php",
			data: { Name: Name }
		}).done(function( msg ) {
			if(msg.status == 'succes')
			{
				if(msg.available == 'yes')
				{
					$(".username_feedback span").text(msg.message);
					
				}
				else
				{
					$(".username_feedback span").text(msg.message);
				}
			}
		});
		return(false);
	});
});
</script>
	</head>

	<body>
		<div data-role="page">


	<div data-role="content">
		<h2>Registreer</h2>
		<form action="" method="post">
			<input type="text" name="name_register" id="name_register" placeholder="gebruikersnaam" />
			<input type="email" name="mail_register" id="mail_register" placeholder="e-mail" />
			<input type="password" name="password_register" id="password_register" placeholder="paswoord" autocomplete="off" />
			
			<input type="submit" name="register" id="register" value="Registreren" />
		</form>
	<?php if(isset($feedback)):?>
	<div class="feedback">
	
	<?php echo $feedback; ?>
	</div>
	<?php endif; ?>
	
<div class="username_feedback"><span></span></div>


	</div><!--content-->
	
		</div>
	</body>
</html>
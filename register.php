<?php
error_reporting(E_ALL);
session_start();

	include_once('classes/User.class.php');
	$feedback = " ";
	//when the register button is clicked ...
	if(isset($_POST['register']))
	{
		//... check if all the input fields are filled in
		if(!empty($_POST['name_register']) && !empty($_POST['mail_register']) && !empty($_POST['password_register']))
		{
			//check if the username is available, if so, save the new user
			try
			{	
				$user = new User();
				$user->Name = $_POST['name_register'];
				$user->Email = $_POST['mail_register'];
				$user->Pass = $_POST['password_register'];
				//$feedback = "Top, je hebt een account nu!";
				if($user->UsernameAvailable())
				{
					header('Location: http://localhost:8888/newAppShareTheCosts/overzichtlijsten.php');
					$user->Save();
					/*$_SESSION["UserID"] = $id;
					$_SESSION["UserName"] = $_POST['name_register'];
					echo $id;*/
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
?>
<?php include 'header_no_title.php'; ?>
		<h2>Registreer</h2>
		<form action="" method="post">
			<input type="text" name="name_register" id="name_register" placeholder="gebruikersnaam" />
			<input type="email" name="mail_register" id="mail_register" placeholder="e-mail" />
			<input type="password" name="password_register" id="password_register" placeholder="paswoord" autocomplete="off" />
			
			<input type="submit" name="register" id="register" value="Registreren" />
		</form>
		<p>Heb je toch een account? Ga terug naar het <a href="index.php">inlogscherm</a></p>
		
		<?php include 'feedback.php'; ?>
		
		<div class="username_feedback"><span></span></div>

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
<?php include 'footer_no_buttons.php'; ?>
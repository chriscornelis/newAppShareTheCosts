<?php
error_reporting(E_ALL);
session_start();

	include_once('classes/User.class.php');
	$feedback = " ";
	if(isset($_POST['login']))
	{
		if(!empty($_POST['mail_login']) && !empty($_POST['password_login']))
		{
			try
			{	
				$cUser = new User();
				$cUser->Email = $_POST['mail_login'];
				$cUser->Pass = md5($_POST['password_login']);
				$cUser->CheckUser();
			}
			catch(Exception $e)
			{
				$feedback = $e->getMessage();				
			}
		}
		else
		{
			$feedback = "Vulde je alle velden in?";
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
		
	</head>

	<body>
		<div data-role="page">

			<div data-role="content">
				<h2>Login</h2>
				<form action="" method="post">
					<input type="email" name="mail_login" id="mail_login" placeholder="e-mail" value="">
					<input type="password" name="password_login" id="password_login" placeholder="paswoord" value="" autocomplete="off">
					
					<input type="submit" name="login" id="login" value="Aanmelden" />
				</form>

				<?php if(isset($feedback)):?>
				<div class="feedback">
				
				<?php echo $feedback; ?>
				</div>
				<?php endif; ?>
			
				<p>Nog geen account? <a href="register.php">Registreer hier</a></p>
			</div><!--content-->
	
		</div>
	</body>
</html>

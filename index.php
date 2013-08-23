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

?>
<?php include 'header_no_title.php'; ?>
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
<?php include 'footer_no_buttons.php'; ?>

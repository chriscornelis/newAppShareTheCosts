<?php session_start(); 
error_reporting(E_ALL);
	include_once('classes/Costlist.class.php');
	$feedback = '';
	$listID;
	if(isset($_GET['id'])){
		$listID=$_GET['id'];
	}
	if(isset($_POST['list_login']))
	{
		if(!empty($_POST['password_list']))
		{
			try
			{
				$accessCostList = new Costlist();
				$accessCostList->ListPass = $_POST['password_list'];
				$accessCostList->ListID = $listID;
				$accesList = $accessCostList->checkListPass();
				else
				{
					$feedback = 'Oei, het wachtwoord is niet juist';
				}

			}
			catch(Exception $e)
			{
				$feedback = $e->getMessage();				
			}
		}
		else
		{
			$feedback = 'Oeps, vergeten om het wachtwoordveld in te vullen?';
		}
	}
	
	
?>
<?php include 'header.php'; ?>


	<div data-role="content">
		<h2>Weekend aan zee</h2>
		
		<input type="password" name="password_list" id="password_list" placeholder="wachtwoord" value="" autocomplete="off">
		<?php echo "<h2>".$_GET['lijstnaam']."</h2>"; ?>
		
		<input type="checkbox" name="favorit_list" id="favorit_list" checked="">
		<label for="favorit_list">zet bij mijn uitgavenlijsten</label>
		<form method="post" action="">
			<input type="password" name="password_list" id="password_list" placeholder="wachtwoord" value="" autocomplete="off">
			<input type="checkbox" name="favorit_list" id="favorit_list" checked="">
			<label for="favorit_list">zet bij 'Mijn uitgavenlijsten'</label>
			<input type="submit" data-theme='b' name="list_login" id="list_login" value="OK" />
		</form>
		
		<a href="#" data-role="button" id="list_login">OK</a>
		<?php if(isset($feedback)):?>
				<div class="feedback">
			
		<?php echo $feedback; ?>
				</div>
		<?php endif; ?>

	</div><!--content-->
	
	<?php include 'footer.php'; ?>
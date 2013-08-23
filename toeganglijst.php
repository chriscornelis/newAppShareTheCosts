<?php session_start(); 
error_reporting(E_ALL);
	include_once('classes/Costlist.class.php');
	$feedback = '';
	$listID;
	//get the id of the list that was clicked on, in the search results on 'zoek.php'
	if(isset($_GET['id'])){
		$listID=$_GET['id'];
	}
	//when the OK-button is clicked and the password field is filled in ...
	if(isset($_POST['list_login']))
	{
		if(!empty($_POST['password_list']))
		{
			//... check if the password for the chosen list is correct, if so, give access to the user
			try
			{
				$accessCostList = new Costlist();
				$accessCostList->ListPass = $_POST['password_list'];
				$accessCostList->ListID = $listID;
				$accesList = $accessCostList->checkListPass();
				
				if(mysqli_num_rows($accesList)==1)
				{	
					//set list in table Favoriet if checkbox favorit_list is checked
					if(isset($_POST['favorit_list']) && isset($_GET['beheerder']))
					{
						try
						{
							$favoritList = new Costlist();
							$favoritList->UserID = $_SESSION["UserID"];
							$favoritList->ListID = $listID;
							$beheerder = $_GET['beheerder'];
							$favoritList->addFavoritList($beheerder);
						}
						catch(Exception $e)
						{
							$feedback = $e->getMessage();				
						}	
						//redirect user to the list he gave a password for
						header('Location: http://localhost:8888/newAppShareTheCosts/lijstdetail.php?id='.$listID.'');
					}
				}
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
		<?php echo "<h2>".$_GET['lijstnaam']."</h2>"; ?>
		
		<form method="post" action="">
			<input type="password" name="password_list" id="password_list" placeholder="wachtwoord" value="" autocomplete="off">
			<input type="checkbox" name="favorit_list" id="favorit_list" checked="">
			<label for="favorit_list">zet bij 'Mijn uitgavenlijsten'</label>
			<input type="submit" data-theme='b' name="list_login" id="list_login" value="OK" />
		</form>

		<?php include 'feedback.php'; ?>
	</div><!--content-->
	
	<?php include 'footer.php'; ?>
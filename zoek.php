<?php
error_reporting(E_ALL);
session_start();
include('classes/Costlist.class.php');

$feedback='';

	if(isset($_POST['search_list']))
	{
		if(!empty($_POST['search_name_owner']) || !empty($_POST['search_name_list']))
		{
			try
			{	
				$searchCost = new Costlist();
				$LijstNaam = str_replace(" ", "_", $_POST['search_name_list']);
				$BeheerderNaam = str_replace(" ", "_", $_POST['search_name_owner']);
				$searchResult = $searchCost->searchList($LijstNaam, $BeheerderNaam);
				
			}
			catch(Exception $e)
			{
				$feedback = $e->getMessage();				
			}
		}
		else
		{
		$feedback = 'Vul zeker &eacute;&eacute;n van de twee zoekvelden in';
		}
	}

?>
<?php include 'header.php'; ?>

	<div data-role="content">
			<h2>Zoek een uitgavenlijst</h2>
			<form action="" method="post">
				<input type="text" name="search_name_owner" id="search_name_owner" placeholder="Naam beheerder" value="">
				<input type="text" name="search_name_list" id="search_name_list" placeholder="Naam lijst" value="">
				<input type="submit" data-theme='b' name="search_list" id="search_list" value="ZOEK" />
			</form>
			<br />
			
			<?php if(isset($feedback)):?>
				<div class="feedback">
			
			<?php echo $feedback; ?>
				</div>
			<?php endif; ?>
			<br />
			<ul data-role="listview">
			    <li><a href="toeganglijst.php">
			        
			        <h3>Weekendje Ardennen</h3>
			        <p>Lien De Rijcke</p></a>
			    </li>
			    <li><a href="#">
			       <h3>Weekend aan zee</h3>
			        <p>Chris Cornelis</p></a>
			    </li>
			</ul>
		</div><!--content-->
		
	
	<?php include 'footer.php'; ?>
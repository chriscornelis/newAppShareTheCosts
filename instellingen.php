<?php
session_start(); 
error_reporting(E_ALL);
	include_once('classes/Costlist.class.php');
	
	//get the ID of the list that was clicked on in overzichtlijsten.php
	if(isset($_GET['id'])){
		$listID=$_GET['id'];
	}
	
	//get all the list settings of the list that was opened
	$settingsList = new Costlist();
	$settingsList->ListID = $listID;
	$listSettings = $settingsList->getListSettings();
	
	//save new settings of the list
	if(isset($_POST['save_settings']))
	{
		try
		{
		$updateList = new Costlist();
		$updateList->ListID = $listID;
		$updateList->ListPass = $_POST['password'];
		$updateList->Members = $_POST['spinnerMembers'];
		$updateList->CostFuel = $_POST['cost_brandstof'];
		$updateList->FuelConsump = $_POST['fuel_consumption'];
		$updateList->updateListSettings();
		}
		catch(Exception $e)
		{
			$feedback = $e->getMessage();
		}
	}
?>
<?php include 'header.php'; ?>

	<div data-role="content">
		<h2>Instellingen</h2>
		<form action="" method="post">
			<label for="spinner">Aantal personen</label>
			<?php 
			if(isset($listSettings))
			{
				while($singleSetting = $listSettings->fetch_assoc())
				{
					echo "<input type='number' name='spinnerMembers' id='spinnerMembers' min='1' max='10' value='".$singleSetting['AantalDeelnemers']."'>";
					echo "<h4>Vervoerskosten</h4>";
					echo "<label for='cost_brandstof'>Brandstofprijs/L</label>";
					echo "<input type='text' data-clear-btn='false' name='cost_km' id='cost_km' value='".$singleSetting['KostBrandstof']."'>";
					echo "<label for='fuel_consumption'>Verbruik auto</label>";
					echo "<input type='text' data-clear-btn='false' name='fuel_consumption' id='fuel_consumption' value='".$singleSetting['VerbruikAuto']."'>";
					echo "<label for='password'>Wachtwoord</label>";
					echo "<input type='text' name='password' id='password_list' placeholder='' value='".$singleSetting['Wachtwoord']."' autocomplete='off'>";
		
				}
			}
			?>
			<input type="submit" name="save_settings" id="save_settings" value="Opslaan" />
			<?php echo "<a href='lijstdetail.php?id=".$listID."' data-role='button' id='cancel_settings'>Annuleer</a>"; ?>
		</form>
		
<?php include 'feedback.php'; ?>

	</div><!--content-->
<?php include 'footer.php'; ?>
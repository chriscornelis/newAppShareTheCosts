<?php
session_start(); 
error_reporting(E_ALL);
	include_once('classes/Costlist.class.php');
	if(isset($_GET['id'])){
		$listID=$_GET['id'];
	}
	
	$settingsList = new Costlist();
	$settingsList->ListID = $listID;
	$listSettings = $settingsList->getListSettings();
?>
<?php include 'header.php'; ?>


	<div data-role="content">
		<h2>Instellingen</h2>
		
		<label for="spinner">Aantal personen</label>
		<?php 
		if(isset($listSettings))
		{
			while($singleSetting = $listSettings->fetch_assoc())
			{
				echo "<input type='number' name='spinner' id='spinner' min='1' max='10' value='".$singleSetting['AantalDeelnemers']."'>";
				echo "<h4>Vervoerskosten</h4>";
				echo "<label for='cost_km'>Kost/km</label>";
				echo "<input type='text' data-clear-btn='false' name='cost_km' id='cost_km' value='".$singleSetting['KostKm']."'>";
				echo "<label for='fuel_consumption'>Verbruik auto</label>";
				echo "<input type='text' data-clear-btn='false' name='fuel_consumption' id='fuel_consumption' value='".$singleSetting['VerbruikAuto']."'>";
				echo "<label for='password'>Wachtwoord</label>";
				echo "<input type='text' name='password' id='password_list' placeholder='' value='".$singleSetting['Wachtwoord']."' autocomplete='off'>";
	
			}
		}
		?>
		
		<a href="#" data-role="button" id="save_settings">Opslaan</a>
		<?php echo "<a href='lijstdetail.php?id=".$listID."' data-role='button' id='cancel_settings'>Annuleer</a>"; ?>
		<?php if(isset($feedback)):?>
			<div class="feedback">
			
		<?php echo $feedback; ?>
			</div>
		<?php endif; ?>

	</div><!--content-->
<?php include 'footer.php'; ?>
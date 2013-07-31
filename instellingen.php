<?php include 'header.php'; ?>


	<div data-role="content">
		<h2>Instellingen - Weekend aan zee</h2>
		
		<label for="spinner">Aantal personen</label>
		<input type="number" name="spinner" id="spinner" min="1" max="10">
		
		<h4>Vervoerskosten</h4>
		<label for="cost_km">Kost/km</label>
		<input type="text" data-clear-btn="false" name="cost_km" id="cost_km" value="">
		
		<label for="">Verbruik auto</label>
		<input type="text" data-clear-btn="false" name="fuel_consumption" id="fuel_consumption" value="">
		
		<label for="password">Wachtwoord</label>
		<input type="text" name="password" id="password_list" placeholder="" value="xxxxx" autocomplete="off">
		
		<a href="#" data-role="button" id="save_settings">Opslaan</a>
		<a href="#" data-role="button" id="cancel_settings">Annuleer</a>
			
			
	</div><!--content-->
	
	<?php include 'footer.php'; ?>
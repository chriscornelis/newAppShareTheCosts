<?php include 'header.php'; ?>

	<div data-role="content">
			<h2>Nieuwe uitgave</h2>
			
			<select name="cost_type" id="cost_type">
			    <option value="Type">Type</option>
			    <option value="Bar">Bar</option>
			    <option value="Restaurant">Restaurant</option>
			    <option value="Hotel">Hotel</option>
			    <option value="Camping">Camping</option>
			    <option value="Huur">Huur</option>
			    <option value="OpenbaarVervoer">Openbaar Vervoer</option>
			    <option value="Vliegtuig">Vliegtuig</option>
				<option value="Taxi">Taxi</option>
				<option value="Pretpark">Pretpark</option> 
				
				<optgroup label="Auto">
				    <option value="Tankbeurt">Tankbeurt in euro</option>
					<option value="KmVergoeding">Km-vergoeding</option>
				</optgroup>
			</select>
			
			<div id="km_input">
				<label>Prijs/km</label>
				<p><span>&euro;</span>1,45</p>
				
				<label for="start_km">Start km</label>
				<input type="number" name="start_km" id="start_km" value="">
							
				
				<label for="end_km">Eind km</label>
				<input type="number" name="end_km" id="end_km" value="">
			</div>
			
			<label for="price">Prijs</label> <span>&euro;</span>
			<input type="number" name="price" id="price" value="">
			
			<label for="date">Datum</label>
			<input type="date" name="date" id="date" value="">
			
			<label for="info">Toelichting</label>
			<textarea cols="40" rows="8" name="info" id="info"></textarea>
			
			<a href="#" data-role="button" id="save_cost" data-theme="b">OPSLAAN</a>
			<a href="#" data-role="button" id="delete_cost" data-theme="b">VERWIJDER</a>
		</div><!--content-->
<script>
$("#km_input").hide();
$("#cost_type").change(function(){
	if($("#cost_type").val()=='KmVergoeding')
	{
		$("#km_input").show();
	}else
	{
		$("#km_input").hide();
	}
});
</script>		
	<?php include 'footer.php'; ?>
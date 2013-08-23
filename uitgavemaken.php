<?php
	session_start(); 
	error_reporting(E_ALL);
	
	include_once('classes/Cost.class.php');
	$listID;
	if(isset($_GET['id'])){
		$listID=$_GET['id'];
	}
	$costTypes = new Cost();
	$allCostTypes = $costTypes->getAllCostTypes();
	
	if(isset($_POST['save_cost']))
	{
		/*if($_POST['cost_type']==20)
		{
			try
			{	
				$kmcost = new Cost();
				$kmcost->ListID = $listID;
				$kmcost->TypeID = $_POST['cost_type'];
				$kmcost->Date = $_POST['date'];
				$kmcost->Info = $_POST['info'];
				$kmcost->StartKm = $_POST['start_km'];
				$kmcost->EndKm = $_POST['end_km'];
				$totalKm = $_POST['end_km'] - $_POST['start_km'];
				$kmcost->saveKmCost($totalKm);
			}
			catch(Exception $e)
			{
				$feedback = $e->getMessage();
			}
		}
		else
		{*/
			try
			{	
				$cost = new Cost();
				$cost->ListID = $listID;
				$cost->TypeID = $_POST['cost_type'];
				$cost->Price = $_POST['price'];
				$cost->Date = $_POST['date'];
				$cost->Info = $_POST['info'];
				$cost->StartKm = $_POST['start_km'];
				$cost->EndKm = $_POST['end_km'];
				$cost->saveCost();
			}
			catch(Exception $e)
			{
				$feedback = $e->getMessage();
			}
		//}
	}
?>
<?php include 'header.php'; ?>

	<div data-role="content">
			<h2>Nieuwe uitgave</h2>
			<form action="" method="post">
				<select name="cost_type" id="cost_type">
					<option value="Type">Type</option>
				    <?php
				    if(isset($allCostTypes))
				    {
					    if(mysqli_num_rows($allCostTypes)>0)
				    	{
					    	while($singleType = $allCostTypes->fetch_assoc())
					    	{
						    	echo "<option value=".$singleType['TypeID'].">".$singleType['TypeNaam']."</option>";
							}
				    	}
				    	else
				    	{
					    	echo "<option value='0'>Geen types gevonden</option>";
				    	}
				    }
				    
				    ?>
				</select>
				
				<div id="km_input">
					<label for="start_km">Start km</label>
					<input type="number" name="start_km" id="start_km" value="0">
								
					
					<label for="end_km">Eind km</label>
					<input type="number" name="end_km" id="end_km" value="0">
				</div>
				
				<div id="prijs_input">
					<label for="price">Prijs</label> <span>&euro;</span>
					<input type="number" name="price" id="price" value="0.00">
				</div>
				<label for="date">Datum</label>
				<input type="date" name="date" id="date" value="">
				
				<label for="info">Toelichting</label>
				<textarea cols="40" rows="8" name="info" id="info"></textarea>
				
				
				<input type="submit" name="save_cost" id="save_cost" data-theme="b" value="OPSLAAN" />
				<input type="submit" name="delete_cost" id="delete_cost" data-theme="b" value="VERWIJDER" />

			</form>
			<?php if(isset($feedback)):?>
				<div class="feedback">
				
			<?php echo $feedback; ?>
				</div>
			<?php endif; ?>

		</div><!--content-->
<script>
/*$("#km_input").hide();
$("#prijs_input").show();

$("#cost_type").change(function(){
	if($("#cost_type").val()=='20')
	{
		$("#km_input").show();
		$("#prijs_input").hide();
	}
	else
	{
		$("#km_input").hide();
		$("#prijs_input").show();
	}
});*/
</script>		
	<?php include 'footer.php'; ?>
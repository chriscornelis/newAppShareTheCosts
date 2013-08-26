<?php
	session_start(); 
	error_reporting(E_ALL);
	
	include_once('classes/Cost.class.php');
	$costID;
	$typeCost;
	
	//get the ID of the cost that was clicked on in 'lijstdetail.php'
	if(isset($_GET['idcost']))
	{
		$costID=$_GET['idcost'];
		$costDetail = new Cost();
		$costDetail->CostID = $costID;
		$allCostDetails = $costDetail->getDetailsCost();
	}
	//get the ID of the type of cost
	if(isset($_GET['typecost']))
	{
		$typeCost = $_GET['typecost'];
		$costType = new Cost();
		$costType->TypeID = $typeCost;
		$oneType = $costType->getOneCostType();
	}
	
	$costTypes = new Cost();
	//get all the types of costs
	$allCostTypes = $costTypes->getAllCostTypes();
	
	if(isset($_POST['save_cost']))
	{
		//update the cost
		try
		{	
			$cost = new Cost();
			$cost->CostID = $costID;
			$cost->TypeID = $_POST['cost_type'];
			$cost->Price = $_POST['price'];
			$cost->Date = $_POST['date'];
			$cost->Info = $_POST['info'];
			$cost->StartKm = $_POST['start_km'];
			$cost->EndKm = $_POST['end_km'];
			$cost->updateCost();
		}
		catch(Exception $e)
		{
			$feedback = $e->getMessage();
		}
	}
	if(isset($_POST['delete_cost']))
	{
		/*header('Location: http://localhost:8888/newAppShareTheCosts/lijstdetail.php?id='.$listID.'');
		exit();*/
	}
?>
<?php include 'header.php'; ?>

	<div data-role="content">
			<h2>Bewerk uitgave</h2>
			<form action="" method="post">
				<select name="cost_type" id="cost_type">
				 <?php
				 	if(isset($oneType))
				 	{
					 	if(mysqli_num_rows($oneType)>0)
					 	{
						 	while($type = $oneType->fetch_assoc())
						 	{
							 	echo "<option value='".$typeCost."'>".$type['TypeNaam']."</option>";
						 	}
					 	}
					 	else
					 	{
						 	echo "<option value='0'>Type</option>";
					 	}
				 	}
				    //show all the cost types in a drop down
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
				
				
				<?php
				    //show the cost details
				    if(isset($allCostDetails))
				    {
					    if(mysqli_num_rows($allCostDetails)>0)
				    	{
					    	while($singleCost = $allCostDetails->fetch_assoc())
					    	{	echo "<div id='km_input'>";
						    		echo "<label for='start_km'>Start km</label>";
							    	echo "<input type='number' name='start_km' id='start_km' value='".$singleCost['StartKm']."'>";
							    	echo "<label for='end_km'>Eind km</label>";
									echo "<input type='number' name='end_km' id='end_km' value='".$singleCost['EindKm']."'>";
								echo "</div>";
								
								echo "<div id='prijs_input'>";
									echo "<label for='price'>Prijs</label> <span>&euro;</span>";
									echo "<input type='number' name='price' id='price' value='".$singleCost['Prijs']."'>";
								echo "</div>";
								
								echo "<label for='date'>Datum</label>";
								echo "<input type='date' name='date' id='date' value='".$singleCost['Datum']."'>";
	
								echo "<label for='info'>Toelichting</label>";
								echo "<textarea cols='40' rows='8' name='info' id='info'>".$singleCost['Toelichting']."</textarea>";

							}
				    	}
				    	else
				    	{
				    		echo "<div id='km_input'>";
					    		echo "<label for='start_km'>Start km</label>";
						    	echo "<input type='number' name='start_km' id='start_km' value='0'>";
						    	echo "<label for='end_km'>Eind km</label>";
						    	echo "<input type='number' name='end_km' id='end_km' value='0'>";
						    echo "</div>";
						    echo "<div id='prijs_input'>";
							    echo "<label for='price'>Prijs</label> <span>&euro;</span>";
					    		echo "<input type='number' name='price' id='price' value='0.00'>";
					    	echo "</div>";
					    	
					    	echo "<label for='date'>Datum</label>";
							echo "<input type='date' name='date' id='date' value=''>";

							echo "<label for='info'>Toelichting</label>";
							echo "<textarea cols='40' rows='8' name='info' id='info'></textarea>";
				    	}
				    }
				?>
	
				<input type="submit" name="save_cost" id="save_cost" data-theme="b" value="BEWERKING OPSLAAN" />
				<input type="submit" name="delete_cost" id="delete_cost" data-theme="b" value="VERWIJDER" />

			</form> <!-- END form -->
			
			<?php include 'feedback.php'; ?>
		</div><!--content-->
<script>
$("#km_input").hide();
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
});
</script>		
	<?php include 'footer.php'; ?>
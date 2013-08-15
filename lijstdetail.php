<?php 
	session_start(); 
	error_reporting(E_ALL);
	include_once('classes/Cost.class.php');
	
	if(isset($_GET['id'])){
		$listID=$_GET['id'];
	}
	$costs = new Cost();
	$costs->ListID = $listID;
	$allCosts = $costs->getAllCostsOfList();
	$totalCost = $costs->getTotalCost();
	$memberCost = $costs->getCostPerMember();
?>
<?php include 'header.php'; ?>


	<div data-role="content">
		<h2>Weekend aan zee</h2>
		<?php
		echo "<a href='instellingen.php?id=".$listID."' data-role='button' data-icon='gear' data-iconpos='notext'>Instellingen</a>";
		echo "<a href='uitgavemaken.php?id=".$listID."' data-role='button' data-icon='plus' data-theme='b'>Voeg uitgave toe</a>";
		?>
		
		<br />
	
		<ul data-role="listview">
		    
		    <?php 
		    
		    if(mysqli_num_rows($allCosts)>0)
		    	{
			    	while($singleCost = $allCosts->fetch_assoc())
			    	{
				    	echo "<li><a href='#'>";
						echo "<h3>".$singleCost['TypeNaam']."</h3>";
						echo "<p class='cost_price'><span>&euro;</span>".$singleCost['Prijs']."</p></a>";
						echo "</li>";
					}
		    	}
		    	else
		    	{
			    	echo "<p>Er zijn nog geen uitgaven voor deze lijst.</p>";
		    	}
		    ?>
		    
		    <li>
		       <h3>Totaal</h3>
		    <?php
			    
			    if(isset($totalCost))
			    {
			    	if(mysqli_num_rows($totalCost)>0)
					{
			    		while($total = $totalCost->fetch_assoc())
						{
							echo "<p class='total_price'><span>€</span>".$total['Totaalprijs']."</p>";
						}
					}
			    }
		    ?>
		    </li>
		    <li>
		        <h3>Kost per persoon</h3>
		     <?php
			    
			    if(isset($memberCost))
			    {
			    	if(mysqli_num_rows($memberCost)>0)
					{
			    		while($costPerMember = $memberCost->fetch_assoc())
						{
							echo "<p class='cost_per_person'><span>€</span>".$costPerMember['PrijsPerPersoon']."</p>";
						}
					}
			    }
		    ?>
		    </li>
		</ul>
		<br />
		<?php if(isset($feedback)):?>
			<div class="feedback">
				<?php echo $feedback; ?>
			</div>
		<?php endif; ?>
	</div><!--content-->
	
	<?php include 'footer.php'; ?>
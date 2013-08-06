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
	
?>
<?php include 'header.php'; ?>


	<div data-role="content">
		<h2>Weekend aan zee</h2>
		<a href="instellingen.php" data-role="button" data-icon="gear" data-iconpos="notext">Instellingen</a>
		<a href="uitgavemaken.php" data-role="button" data-icon="plus" data-theme="b">Voeg uitgave toe</a>
	
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
		    
		    <li><a href="#">
		       <h3>Totaal</h3>
		        <p class="total_price"><span>€</span>80</p></a>
		    </li>
		    <li><a href="#">
		        <h3>Kost per persoon</h3>
		        <p class="cost_per_person"><span>€</span>40</p></a>
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
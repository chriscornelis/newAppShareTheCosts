<?php session_start(); 
error_reporting(E_ALL);
	include_once('classes/Costlist.class.php');
	
	$costList = new Costlist();
	$costList->UserID = $_SESSION['UserID']; 
	//get all the lists from the table Favoriet, this are all the lists to show in 'Mijn uitgavenlijsten'
	$personalLists = $costList->getPersonalLists();
?>
<?php include 'header.php'; ?>
	<div data-role="content">
		<h2>Mijn uitgavenlijsten</h2>
		
		<ul data-role="listview" data-split-icon="delete" data-split-theme="d"> 
		    <?php
		    	//show all the personal/favorit lists of the user 
		    	if(mysqli_num_rows($personalLists)>0)
		    	{
			    	while($singleList = $personalLists->fetch_assoc())
			    	{
				    	echo "<li><a href='lijstdetail.php?id=".$singleList['LijstID']."'>";
						echo "<h3>".$singleList['LijstNaam']."</h3>";
						echo "<p>Beheerder: ".$singleList['Naam']."</p></a>";
						echo "<a href='#delete_list' data-rel='popup' data-position-to='window' data-transition='pop' 
						class=".$singleList['LijstID']." id=".$singleList['FavorietID'].">Verwijder uitgavelijst</a>";
						echo "</li>";
					}
		    	}
		    	else
		    	{
			    	echo "<p>Je hebt nog geen persoonlijke uitgavenlijsten.</p>";
		    	}
		    ?>
		</ul>
		<div data-role="popup" id="delete_list" data-theme="d" data-verlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
			<p>Deze lijst verwijderen uit jouw uitgavenlijsten?</p>
			<a href="overzichtlijsten.php" data-role="button" data-rel="back" data-theme="b" data-inline="true" data-mini="true">Ja, verwijder</a>
    		<a href="overzichtlijsten.php" data-role="button" data-rel="back" data-inline="true" data-mini="true">Nee</a>
		</div>
		<br />
		
		<?php include 'feedback.php'; ?>	
	</div><!--content-->
	
	<?php include 'footer.php'; ?>
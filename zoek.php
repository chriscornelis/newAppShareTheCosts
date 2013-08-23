<?php
error_reporting(E_ALL);
session_start();
include('classes/Costlist.class.php');

$feedback='';
	//if the search button is clicked and one of the search fields is filled in
	if(isset($_POST['search_list']))
	{
		if(!empty($_POST['search_name_owner']) || !empty($_POST['search_name_list']))
		{
			//search lists that contain the given list name or the name of an owner
			try
			{	
				$searchCost = new Costlist();
				$LijstNaam = str_replace(" ", "%", $_POST['search_name_list']);
				$BeheerderNaam = str_replace(" ", "%", $_POST['search_name_owner']);
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
		
		<?php include 'feedback.php'; ?>
		
			<br />
			<ul data-role="listview">
			    <?php
			    //show the search results
			    if(isset($searchResult))
			    {
			    	if(mysqli_num_rows($searchResult)>0)
			    	{
				    	while($singleSearchItem = $searchResult->fetch_assoc())
				    	{
					    	echo "<li><a href='toeganglijst.php?id=".$singleSearchItem['LijstID']."&lijstnaam=".$singleSearchItem['LijstNaam']."&beheerder=".$singleSearchItem['BeheerderID']."'>";
					    	echo "<h3>".$singleSearchItem['LijstNaam']."</h3>";
					    	echo "<p>".$singleSearchItem['Naam']."</p></a>";
					    	echo "</li>";
				    	}
			    	}
			    	else
			    	{
				    	echo "<p>Sorry, er zijn geen lijsten gevonden op basis van deze zoektermen</p>";
			    	}
			    }
				 ?>
			</ul>
		</div><!--content-->

	<?php include 'footer.php'; ?>
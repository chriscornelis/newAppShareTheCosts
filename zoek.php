<?php include 'header.php'; ?>

	<div data-role="content">
			<h2>Zoek een uitgavenlijst</h2>
			
			<input type="text" name="owner" id="search_name_owner" placeholder="Naam beheerder" value="">
			<input type="text" name="list" id="search_name_list" placeholder="Naam lijst" value="">
			
			<a href="#" data-role="button" id="search_list">ZOEK</a>
			
			<br />
			
			<ul data-role="listview">
			    <li><a href="toeganglijst.php">
			        
			        <h3>Weekendje Ardennen</h3>
			        <p>Lien De Rijcke</p></a>
			    </li>
			    <li><a href="#">
			       <h3>Weekend aan zee</h3>
			        <p>Chris Cornelis</p></a>
			    </li>
			</ul>
		</div><!--content-->
		
	
	<?php include 'footer.php'; ?>
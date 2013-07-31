<?php include 'header.php'; ?>


	<div data-role="content">
		<h2>Weekend aan zee</h2>
		<a href="instellingen.php" data-role="button" data-icon="gear" data-iconpos="notext">Instellingen</a>
		<a href="uitgavemaken.php" data-role="button" data-icon="plus" data-theme="b">Voeg uitgave toe</a>
	
		<br />
	
		<ul data-role="listview">
		    <li><a href="#">
		        
		        <h3>Restaurant</h3>
		        <p class="cost_price"><span>€</span>60</p></a>
		    </li>
		    <li><a href="#">
		       <h3>Bar</h3>
		        <p class="cost_price"><span>€</span>20</p></a>
		    </li>
		    <li><a href="#">
		       <h3>Totaal</h3>
		        <p class="total_price"><span>€</span>80</p></a>
		    </li>
		    <li><a href="#">
		        <h3>Kost per persoon</h3>
		        <p class="cost_per_person"><span>€</span>40</p></a>
		    </li>
		</ul>
		
		
	</div><!--content-->
	
	<?php include 'footer.php'; ?>
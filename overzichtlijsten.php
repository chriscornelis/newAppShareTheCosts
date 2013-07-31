<?php session_start(); ?>
<?php include 'header.php'; ?>


	<div data-role="content">
		<h2>Mijn uitgavenlijsten</h2>
		
		<ul data-role="listview" data-split-icon="delete" data-split-theme="d">
		    <li><a href="lijstdetail.php">
		        
		        <h3>Weekend aan zee</h3>
		        <p>Chris Cornelis</p></a>
		        <a href="#delete_list" data-rel="popup" data-position-to="window" data-transition="pop">Verwijder uitgavelijst</a>
		    </li>
		    <li><a href="#">
		        
		       <h3>Trip to Paris</h3>
		        <p>Chris Cornelis</p></a>
		        <a href="#delete_list" data-rel="popup" data-position-to="window" data-transition="pop">Verwijder uitgavelijst</a>
		    </li>
		    <li><a href="#">
		        
		        <h3>Spain2013</h3>
		        <p>Chris Cornelis</p></a>
		        <a href="#delete_list" data-rel="popup" data-position-to="window" data-transition="pop">Verwijder uitgavelijst</a>
		    </li>
		     <li><a href="#">
		        
		        <h3>Weekendje Ardennen</h3>
		        <p>Lien De Rijcke</p></a>
		        <a href="#delete_list" data-rel="popup" data-position-to="window" data-transition="pop">Verwijder uitgavelijst</a>
		    </li>
		</ul>
		<div data-role="popup" id="delete_list" data-theme="d" data-verlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
			<p>Deze lijst verwijderen uit jouw uitgavenlijsten?</p>
			<a href="overzichtlijsten.php" data-role="button" data-rel="back" data-theme="b" data-inline="true" data-mini="true">Ja, verwijder</a>
    		<a href="index.html" data-role="button" data-rel="back" data-inline="true" data-mini="true">Nee</a>
		</div>
		
		
	</div><!--content-->
	
	<?php include 'footer.php'; ?>
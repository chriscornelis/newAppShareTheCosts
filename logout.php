<?php
    session_start();
    $_SESSION = array();
    unset($_SESSION);
    session_destroy();
    //send the user back to the startpage with the login form
    header('Location: http://localhost:8888/newAppShareTheCosts/');
    exit();
?>
<?php include 'header.php'; ?>
	<div data-role="content">
		<h2>Uitloggen</h2>
	</div><!--content-->

<?php include 'footer.php'; ?>
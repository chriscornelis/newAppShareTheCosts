<?php
	include_once('../classes/User.class.php');
	
		try
		{
			$oUser = new User();
			$oUser->Name = $_POST['Name'];
			if($oUser->UsernameAvailable())
			{	
				$feedback['status']='succes';
				$feedback['available']='yes';
				$feedback['message']='Gebruikersnaam is beschikbaar!';
			}
			else
			{
				$feedback['status']='succes';
				$feedback['available']='no';
				$feedback['message']='Sorry, gebruikersnaam bestaat al';
				
			}
		
		}
		catch(Exception $e)
		{
			$feedback['status']='error';
			$feedback['message']=$e->getMessage();
		}
		header('Content-type: application/json');
		echo json_encode($feedback);
	
?>
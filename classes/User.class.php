<?php

class User
{
	private $m_sUserID;
	private $m_sName;
	private $m_sEmail;
	private $m_sPass;

	public function _set($p_sProperty, $p_vValue)
	{
		switch($p_sProperty)
		{
			case "UserID":
				$this->m_sUserID = $p_vValue;
				break;
			case "Name":
				$this->m_sName = $p_vValue;
				break;
			case "Email":
				$this->m_sEmail = $p_vValue;
				break;
			case "Pass":
				$this->m_sPass = $p_vValue;
				break;
			
		}
	}
	
	public function _get($p_sProperty)
	{
		$vResult = null;
		switch($p_sProperty)
		{
			case "UserID":
				$v_Result = $this->m_sUserID;
			case "Name":
				$v_Result = $this->m_sName;
				break;
			case "Email":
				$v_Result = $this->m_sEmail;
				break;
			case "Pass":
				$v_Result = $this->m_sPass;
				break;
		}
		return $vResult;
	}
	// function to save a new user
	public function Save()
	{
		include("Connection.php");
		if(!$link->connect_error)
		{
				$saveUserSql = "INSERT INTO Gebruiker (Naam, Paswoord, Email) 
				VALUES ('".$link->real_escape_string($this->Name)."',
				'".$link->real_escape_string(md5($this->Pass))."',
				'".$link->real_escape_string($this->Email)."'
				);";
				
				if($link->query($saveUserSql))
				{
					//get the user ID from the user that was just saved
					$id = $link->insert_id;
					throw new Exception("Alright! Je hebt een account!");
					return $id;
				}
				else
				{
					throw new Exception('Whoops, probleem bij het opslaan');
				}
		}
		else
		{
			//no connection with db
			throw new Exception('Whoops, er is iets fout gelopen met de databank');
		}
		//return the user ID to use in a session
		return $rResult;
		mysqli_close($link);
	}
	
	//function to check if the user exists, to allow him access
	public function CheckUser()
	{
		include("Connection.php");
		if(!$link->connect_error)
		{
			$checkUserSql = "SELECT * FROM Gebruiker WHERE Email = '".$this->Email."' AND Paswoord = '".$this->Pass."';";
			$checkUserResult = $link->query($checkUserSql);							
			$count = $checkUserResult->num_rows;
			if($count==1)
			{
				$userdata = mysqli_fetch_assoc($checkUserResult);
				$_SESSION["UserID"] = $userdata['GebruikerID'];
				$_SESSION["UserName"] = $userdata['Naam'];
				header('Location: http://localhost:8888/newAppShareTheCosts/overzichtlijsten.php');
				exit();
			}
			else
			{
				throw new Exception("Sorry, we vonden geen account met deze gegevens, probeer opnieuw of maak een account aan");	
			}
		mysqli_close($link);
		}
	}
	
	//function to check if a username already exists
	public function UsernameAvailable()
	{
		include("Connection.php");
		$usernameAvailSql = "SELECT Naam FROM Gebruiker WHERE Naam = '".$this->Name."'";
		$v_Result = $link->query($usernameAvailSql);
		if($v_Result->num_rows>0)
		{
			//gebruikersnaam bestaat al
			return(false);
		}
		else
		{
			return(true);
		}
		mysqli_close($link);

	}
}
?>
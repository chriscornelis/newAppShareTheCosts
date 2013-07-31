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
	
	public function Save()
	{
		include("Connection.php");
		if(!$link->connect_error)
		{
			
				$sSql = "INSERT INTO Gebruiker (Naam, Paswoord, Email) 
				VALUES ('".$link->real_escape_string($this->Name)."',
				'".$link->real_escape_string($this->Pass)."',
				'".$link->real_escape_string($this->Email)."'
				);";
				
				if($link->query($sSql))
				{
					$id = $link->insert_id;
					throw new Exception("Alright! Je hebt een account!");
				}
				else
				{
					//echo $sSql;
					throw new Exception('whoops, probleem bij het opslaan');
				}
		}
		else
		{
			//geen conn met db
			throw new Exception('no connection with db');
		}
		return $rResult;
		mysqli_close($link);
	}
	
	public function UsernameAvailable()
	{
		include("Connection.php");
		
		$sSql = "SELECT Naam FROM Gebruiker WHERE Naam = '".$this->Name."'";
		$v_Result = $link->query($sSql);
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
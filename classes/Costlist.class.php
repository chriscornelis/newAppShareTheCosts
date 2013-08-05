<?php
class Costlist
{
	private $m_sListID;
	private $m_sListName;
	private $m_sUserID;
	private $m_sListPass;
	private $m_sMembers;
	private $m_sCostKm;
	private $m_sFuelConsump;
	
	public function _set($p_sProperty, $p_vValue)
	{
		switch($p_sProperty)
		{
			case "ListID":
				$this->m_sListID = $p_vValue;
				break;
			case "ListName":
				$this->m_sListName = $p_vValue;
				break;
			case "UserID":
				$this->m_sUserID = $p_vValue;
				break;
			case "ListPass":
				$this->m_sListPass = $p_vValue;
				break;
			case "Members":
				$this->m_sMembers = $p_vValue;
				break;
			case "CostKm":
				$this->m_sCostKm = $p_vValue;
				break;
			case "FuelConsump":
				$this->m_sFuelConsump = $p_vValue;
				break;

		}
	}
	public function _get($p_sProperty)
	{
		$lResult = null;
		switch($p_sProperty)
		{
			case "ListID":
				$lResult = $this->m_sListID;
				break;
			case "ListName":
				$lResult = $this->m_sListName;
				break;
			case "UserID":
				$lResult = $this->m_sUserID;
				break;
			case "ListPass":
				$lResult = $this->m_sListPass;
				break;
			case "Members":
				$lResult = $this->m_sMembers;
				break;
			case "CostKm":
				$lResult = $this->m_sCostKm;
				break;
			case "FuelConsump":
				$lResult = $this->m_sFuelConsump;
				break;
		}
		return $lResult;
	}
	public function saveList()
	{
		
		include("Connection.php");
		$sSql = "INSERT INTO Uitgavenlijst (LijstNaam, GebruikerID, Wachtwoord) 
		VALUES ('".$link->real_escape_string($this->ListName)."',
		'".$link->real_escape_string($this->UserID)."',
		'".$link->real_escape_string(md5($this->ListPass))."'
		);";
		
		
		if($link->query($sSql))
		{
			//id van nieuwe lijst ophalen, lijst opgeslagen
			$idList = $link->insert_id;
			$fSql = "INSERT INTO Favoriet (GebruikerID, LijstID) VALUES('".$_SESSION['UserID']."','".$idList."');";
			if(!$link->query($fSql))
			{
				throw new Exception("Lijst kan niet opgeslagen worden in jouw persoonlijke lijsten");
			}
			throw new Exception("Alright! Jouw nieuwe lijst is opgeslagen!");
		}
		else
		{
			//lijst kan niet opgeslagen worden
			throw new Exception("Lijst kan niet opgeslagen worden");
		}
		mysqli_close($link);
	}
	public function getPersonalLists()
	{
		include("Connection.php");
		$pSql = "SELECT LijstNaam, Favoriet.LijstID, Favoriet.GebruikerID, Gebruiker.Naam, FavorietID
				FROM Uitgavenlijst, Favoriet, Gebruiker
				WHERE Uitgavenlijst.LijstID = Favoriet.LijstID
				AND Favoriet.GebruikerID = Gebruiker.GebruikerID
				AND Favoriet.GebruikerID = '".$link->real_escape_string($this->UserID)."';";
		if($result = $link->query($pSql))
		{
			return($result);
		}
		else
		{
			throw new Exception('Whoops, jouw uitgavenlijsten konden niet opgehaald worden');
		}
	}
}
?>
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
	public function Savelist()
	{
		
		include("Connection.php");
		$sSql = "INSERT INTO Uitgavenlijst (LijstNaam, GebruikerID, Wachtwoord, AantalDeelnemers, KostKm, VerbruikAuto) 
		VALUES ('".$link->real_escape_string($this->ListName)."',
		'".$link->real_escape_string($this->UserID)."',
		'".$link->real_escape_string($this->ListPass)."',
		'".$link->real_escape_string($this->Members)."',
		'".$link->real_escape_string($this->CostKm)."',
		'".$link->real_escape_string($this->FuelConsump)."'
		);";
		
		
		if($link->query($sSql))
		{
			//lijst opgeslagen, id van nieuwe lijst ophalen
			$id = $link->insert_id;
			throw new Exception("Alright! Jouw nieuwe lijst is opgeslagen!");
		}
		else
		{
			//lijst kan niet opgeslagen worden
			throw new Exception("Lijst kan niet opgeslagen worden");
		}
		mysqli_close($link);
	}

}
?>
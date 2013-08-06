<?php
class Cost
{
	private $m_sCostID;
	private $m_sListID;
	private $m_sTypeID;
	private $m_sPrice;
	private $m_sDate;
	private $m_sInfo;
	private $m_sStartKm;
	private $m_sEndKm;
	
	public function _set($p_sProperty, $p_vValue)
	{
		switch($p_sProperty)
		{
			case "CostID":
				$this->m_sCostID = $p_vValue;
				break;
			case "ListID":
				$this->m_sListID = $p_vValue;
				break;
			case "TypeID":
				$this->m_sTypeID = $p_vValue;
				break;
			case "Price":
				$this->m_sPrice = $p_vValue;
				break;
			case "Date":
				$this->m_sDate = $p_vValue;
				break;
			case "Info":
				$this->m_sInfo = $p_vValue;
				break;
			case "StartKm":
				$this->m_sStartKm = $p_vValue;
				break;
			case "EndKm":
				$this->m_sEndKm = $p_vValue;
				break;
		}
	}
	public function _get($p_sProperty)
	{
		$lResult = null;
		switch($p_sProperty)
		{
			case "CostID":
				$lResult = $this->m_sCostID;
				break;
			case "ListID":
				$lResult = $this->m_sListID;
				break;
			case "TypeID":
				$lResult = $this->m_sTypeID;
				break;
			case "Price":
				$lResult = $this->m_sPrice;
				break;
			case "Date":
				$lResult = $this->m_sDate;
				break;
			case "Info":
				$lResult = $this->m_sInfo;
				break;
			case "StartKm":
				$lResult = $this->m_sStartKm;
				break;
			case "EndKm":
				$lResult = $this->m_sEndKm;
				break;
		}
		return $lResult;
	}
	public function saveCost()
	{
		include("Connection.php");
		$saveCostSql = "INSERT INTO Uitgave (LijstID, TypeID, Prijs, Datum, Toelichting, StartKm, EindKm) 
		VALUES (".$link->real_escape_string($this->ListID).", 
		".$link->real_escape_string($this->TypeID).",
		".$link->real_escape_string($this->Price).", 
		'".$link->real_escape_string($this->Date)."',
		'".$link->real_escape_string($this->Info)."',
		".$link->real_escape_string($this->StartKm).",
		".$link->real_escape_string($this->EndKm).");";
		
		
		if($link->query($saveCostSql))
		{
			//uitgave is opgeslagen
			throw new Exception("Ok! Jouw nieuwe uitgave is opgeslagen!");
		}
		else
		{
			//uitgave kon niet opgeslagen worden
			throw new Exception("Uitgave kon niet opgeslagen worden");
		}
		mysqli_close($link);
	}
	public function getAllCostsOfList()
	{
		include("Connection.php");
		$allCostsSql = "SELECT * FROM Uitgave WHERE LijstID = ".$link->real_escape_string($this->ListID).";";
		
		if($result = $link->query($allCostsSql))
		{
			return($result);
		}
		else
		{
			throw new Exception('Whoops, de uitgaven van deze lijst konden niet opgehaald worden');
		}
	}
}
?>
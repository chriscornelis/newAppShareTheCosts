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
	// function to update an existing cost
	public function updateCost()
	{
		include("Connection.php");
		$updateCostSql = "UPDATE Uitgave SET 
		TypeID = ".$link->real_escape_string($this->TypeID).", 
		Prijs = ".$link->real_escape_string($this->Price).", 
		Datum = '".$link->real_escape_string($this->Date)."', 
		Toelichting = '".$link->real_escape_string($this->Info)."',
		StartKm = ".$link->real_escape_string($this->StartKm).",
		EindKm = ".$link->real_escape_string($this->EndKm)."
		WHERE UitgaveID = ".$link->real_escape_string($this->CostID).";";
		
		
		if($link->query($updateCostSql))
		{
			//cost saved
			throw new Exception("Ok! de bewerking is opgeslagen!");
			//header('Location: http://localhost:8888/newAppShareTheCosts/overzichtlijsten.php');
			//exit();
		}
		else
		{
			//cost can't be saved
			throw new Exception("De bewerking kon niet opgeslagen worden");
		}
		mysqli_close($link);
	}
	
	//function to save a new cost of a list
	public function saveCost()
	{
		include("Connection.php");
		$saveCostSql = "INSERT INTO Uitgave (LijstID, TypeID, Prijs, Datum, Toelichting) 
		VALUES (".$link->real_escape_string($this->ListID).", 
		".$link->real_escape_string($this->TypeID).",
		".$link->real_escape_string($this->Price).", 
		'".$link->real_escape_string($this->Date)."',
		'".$link->real_escape_string($this->Info)."';";
		
		
		if($link->query($saveCostSql))
		{
			//cost saved
			throw new Exception("Ok! Jouw nieuwe uitgave is opgeslagen!");
			//header('Location: http://localhost:8888/newAppShareTheCosts/overzichtlijsten.php');
			//exit();
		}
		else
		{
			//cost can't be saved
			throw new Exception("Uitgave kon niet opgeslagen worden");
		}
		mysqli_close($link);
	}
		
	//function to save a cost for transportation based on the given kilometers at the start and the end of the trip
	public function saveKmCost($totalKm)
	{
		include("Connection.php");
		$priceCostSql = "SELECT (".$totalKm." * (VerbruikAuto / 100)) * KostBrandstof AS Prijs
						FROM Uitgavenlijst
						WHERE LijstID = ".$link->real_escape_string($this->ListID).";";
		
		if($price = $link->query($priceCostSql))
		{
			while($priceKm = $price->fetch_assoc())
			{
				$saveKmCostSql = "INSERT INTO Uitgave (LijstID, TypeID, Prijs, Datum, Toelichting, StartKm, EindKm) 
				VALUES (".$link->real_escape_string($this->ListID).", 
				".$link->real_escape_string($this->TypeID).",
				".$priceKm['Prijs'].",
				'".$link->real_escape_string($this->Date)."',
				'".$link->real_escape_string($this->Info)."',		
				".$link->real_escape_string($this->StartKm).",
				".$link->real_escape_string($this->EndKm).");";
	
				if($link->query($saveKmCostSql))
				{
					//cost saved
					throw new Exception("Ok! Jouw nieuwe uitgave is opgeslagen!");
					//header('Location: http://localhost:8888/newAppShareTheCosts/overzichtlijsten.php');
					//exit();
				}
				else
				{
					//cost can't be saved
					throw new Exception("Uitgave kon niet opgeslagen worden");
				}
			}

					}
		else
		{
			throw new Exception('Whoops, de prijs kon niet berekend worden');
		}
		mysqli_close($link);
	}

	//function to get all the costs of a certain list based on the list ID
	public function getAllCostsOfList()
	{
		include("Connection.php");
		$allCostsSql = "SELECT UitgaveID, LijstID, Uitgave.TypeID, Prijs, Datum, Toelichting, StartKm, EindKm, TypeNaam
						FROM Uitgave, UitgaveType
						WHERE Uitgave.LijstID = ".$link->real_escape_string($this->ListID)."
						AND Uitgave.TypeID = UitgaveType.TypeID;";
		if($result = $link->query($allCostsSql))
		{
			return($result);
		}
		else
		{
			throw new Exception('Whoops, de uitgaven van deze lijst konden niet opgehaald worden');
		}
		mysqli_close($link);
	}
	
	//function to get the details of one specific cost in a list
	public function getDetailsCost()
	{
		include("Connection.php");
		$costDetailsSql = "SELECT * FROM Uitgave WHERE UitgaveID = ".$link->real_escape_string($this->CostID).";";
		if($result = $link->query($costDetailsSql))
		{
			return($result);
		}
		else
		{
			throw new Exception('Whoops, de details van de uitgave kunnen niet getoond worden');
		}
		mysqli_close($link);
	}
	//function to get all the cost types, to fill up the dropdown
	public function getAllCostTypes()
	{
		include("Connection.php");
		$allTypesSql = "SELECT * FROM UitgaveType;";
		if($result = $link->query($allTypesSql))
		{
			return($result);
		}
		else
		{
			throw new Exception('Whoops, de types van uitgaven kunnen niet getoond worden');
		}
		mysqli_close($link);
	}
	
	//function to search the name of one specific type of cost
	public function getOneCostType()
	{
		include("Connection.php");
		$OneTypeSql = "SELECT * FROM UitgaveType WHERE TypeID = ".$link->real_escape_string($this->TypeID).";";
		if($result = $link->query($OneTypeSql))
		{
			return($result);
		}
		else
		{
			throw new Exception('Whoops, het type van de uitgave kan niet getoond worden');
		}
		mysqli_close($link);
	}
	
	//function to calculate the total cost of a certain list, based on the list ID
	public function getTotalCost()
	{
		include("Connection.php");
		$totalCostSql = "SELECT SUM(Prijs) AS Totaalprijs FROM Uitgave WHERE LijstID =".$link->real_escape_string($this->ListID).";";
		if($result = $link->query($totalCostSql))
		{
			return($result);
		}
		else
		{
			throw new Exception('Whoops, het totaal van alle uitgaven kan niet getoond worden');
		}
		mysqli_close($link);
	}
	
	//function to calculate the equal cost for each member of the list
	public function getCostPerMember()
	{
		include("Connection.php");
		$memberCostSql = "SELECT (SUM(Uitgave.Prijs)/Uitgavenlijst.AantalDeelnemers) AS PrijsPerPersoon
						FROM Uitgave, Uitgavenlijst
						WHERE Uitgave.LijstID = ".$link->real_escape_string($this->ListID)."
						AND Uitgave.LijstID = Uitgavenlijst.LijstID;";
		if($result = $link->query($memberCostSql))
		{
			return($result);
		}
		else
		{
			throw new Exception('Whoops, de prijs per persoon kan niet getoond worden');
		}
		mysqli_close($link);
	}
}
?>
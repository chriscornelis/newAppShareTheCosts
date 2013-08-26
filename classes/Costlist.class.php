<?php
class Costlist
{
	private $m_sListID;
	private $m_sListName;
	private $m_sUserID;
	private $m_sListPass;
	private $m_sMembers;
	private $m_sCostFuel;
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
			case "CostFuel":
				$this->m_sCostFuel = $p_vValue;
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
			case "CostFuel":
				$lResult = $this->m_sCostFuel;
				break;
			case "FuelConsump":
				$lResult = $this->m_sFuelConsump;
				break;
		}
		return $lResult;
	}
	
	//function to save a new list
	public function saveList()
	{
		include("Connection.php");
		$saveListSql = "INSERT INTO Uitgavenlijst (LijstNaam, BeheerderID, Wachtwoord) 
		VALUES ('".$link->real_escape_string($this->ListName)."',
		'".$link->real_escape_string($this->UserID)."',
		'".$link->real_escape_string($this->ListPass)."'
		);";
		
		if($link->query($saveListSql))
		{
			//get id of newly saved list and save in table Favoriet to show the list in 'Mijn uitgavenlijsten'
			$idList = $link->insert_id;
			$favoritSql = "INSERT INTO Favoriet (GebruikerID, LijstID, BeheerderID) VALUES('".$_SESSION['UserID']."','".$idList."','".$_SESSION['UserID']."');";
			if(!$link->query($favoritSql))
			{
				throw new Exception("Lijst kan niet opgeslagen worden in jouw persoonlijke lijsten");
			}
			throw new Exception("Alright! Jouw nieuwe lijst is opgeslagen!");
		}
		else
		{
			//list can't be saved
			throw new Exception("Lijst kan niet opgeslagen worden");
		}
		mysqli_close($link);
	}
	
	//function to get all the lists that where placed in table Favoriet, so they can be shown in 'Mijn uitgavenlijsten'
	public function getPersonalLists()
	{
		include("Connection.php");
		$personalListSql = "SELECT LijstNaam, Favoriet.LijstID, Favoriet.GebruikerID, Gebruiker.Naam, FavorietID
				FROM Uitgavenlijst, Favoriet, Gebruiker
				WHERE Uitgavenlijst.LijstID = Favoriet.LijstID
				AND Favoriet.BeheerderID = Gebruiker.GebruikerID
				AND Favoriet.GebruikerID = '".$link->real_escape_string($this->UserID)."';";
		if($result = $link->query($personalListSql))
		{
			return($result);
		}
		else
		{
			throw new Exception('Whoops, jouw uitgavenlijsten konden niet opgehaald worden');
		}
		mysqli_close($link);
	}
	
	//function to show the settings of a list, like name, password, amount of members, fuel cost and the fuel consumption of a car
	//in the DB there are already standard values for fuel cost and fuel consumption
	public function getListSettings()
	{
		include("Connection.php");
		$listDetailsSql = "SELECT LijstNaam, Wachtwoord, AantalDeelnemers, KostBrandstof, VerbruikAuto
				FROM Uitgavenlijst WHERE LijstID = '".$link->real_escape_string($this->ListID)."';";
		if($result = $link->query($listDetailsSql))
		{
			return($result);
		}
		else
		{
			throw new Exception('Whoops, jouw uitgavenlijsten konden niet opgehaald worden');
		}
		mysqli_close($link);
	}
	
	//function to change the settings of a list
	public function updateListSettings()
	{
		include("Connection.php");
		$updateSettingsSql = "UPDATE Uitgavenlijst SET Wachtwoord='".$link->real_escape_string($this->ListPass)."', 
							AantalDeelnemers=".$link->real_escape_string($this->Members).",
							KostBrandstof=".$link->real_escape_string($this->CostFuel).",
							VerbruikAuto=".$link->real_escape_string($this->FuelConsump)."
							WHERE LijstID = ".$link->real_escape_string($this->ListID).";";
		
		if(!$link->query($updateSettingsSql))
		{
			throw new Exception("Sorry, de nieuwe instellingen kunnen niet opgeslagen worden");
		}
		else
		{
			throw new Exception("Alright! De nieuwe instellingen zijn opgeslagen!");
		}
		mysqli_close($link);
	}
	
	//function to search a list based on a given name for the list and the owner
	public function searchList($LijstNaam, $BeheerderNaam)
	{
		include("Connection.php");
		$searchListSql = "SELECT Uitgavenlijst.LijstID, Uitgavenlijst.LijstNaam, Uitgavenlijst.BeheerderID, Gebruiker.Naam
						FROM Uitgavenlijst, Gebruiker
						WHERE Uitgavenlijst.BeheerderID = Gebruiker.GebruikerID
						AND (Uitgavenlijst.LijstNaam LIKE '%".$LijstNaam."%' AND Gebruiker.Naam LIKE '%".$BeheerderNaam."%')
						GROUP BY Uitgavenlijst.LijstID;";
		
		if($result = $link->query($searchListSql))
		{
			return($result);
		}
		else
		{
			throw new Exception('Whoops, er kon geen uitgavenlijst gevonden worden met deze zoektermen');
		}
		mysqli_close($link);
	}
	
	//function to check if a user gave the right password to acces a list
	public function checkListPass()
	{
		include("Connection.php");
		$checkPassSql = "SELECT LijstID, Wachtwoord
						FROM Uitgavenlijst 
						WHERE LijstID ='".$link->real_escape_string($this->ListID)."' AND Wachtwoord='".$link->real_escape_string($this->ListPass)."';";

		if($result = $link->query($checkPassSql))
		{
			return($result);
		}
		else
		{
			throw new Exception("Whoops, het wachtwoord kon niet gecontroleerd worden");
		}
		mysqli_close($link);
	}
	
	//function to add a list to a user's favorite's, so he can see it in 'Mijn uitgavenlijsten'
	public function addFavoritList($beheerderID)
	{
		include("Connection.php");
		$addFavoritSql = "INSERT INTO Favoriet (GebruikerID, LijstID, BeheerderID) 
						VALUES ('".$link->real_escape_string($this->UserID)."',
						'".$link->real_escape_string($this->ListID)."',
						'".$link->real_escape_string($beheerderID)."');";
		
		if(!$link->query($addFavoritSql))
		{
			throw new Exception("De lijst kan niet toegevoegd worden aan jouw persoonlijke lijsten");
		}
		else
		{
			throw new Exception("Yes, de lijst is toegevoegd aan jouw persoonlijke lijsten!");
		}
		mysqli_close($link);
	}
	
}
?>
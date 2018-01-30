<?php

class ProfesseurController
{
	/**
	 * Display all professeurs in the database in a table
	 */
	public static function afficherProfesseurs() : void {
		require_once("Models/Professeur.php");
		require_once("Views/ProfesseurView.php");
		
		$professeurs = ProfesseurController::listeProfesseurs();
		
		$table = ProfesseurView::strProfesseurs($professeurs);
		echo $table;
	}
	
	/**
	 * Fetch all professeur from the database
	 * @return array
	 */
	public static function listeProfesseurs() : array {
		require_once("setup.inc.php");
		require_once("Models/Professeur.php");
		require_once("Views/ProfesseurView.php");
		
		$connexion = setup::initialize();
		
		$result = mysqli_query($connexion, "SELECT * FROM professeurs;");
		$professeurs = array();
		for ($i = 0; $line = mysqli_fetch_row($result); $i++)
			$professeurs[$i] = new Professeur($line[0], $line[1], $line[2]);
		setup::tearDown($connexion);
		
		return $professeurs;
	}
	
	/**
	 * Fetch the id of the Professeur associated to the properties $prenom and $nom.
	 * @param string $prenom
	 * @param string $nom
	 * @return int
	 */
	public static function getId($prenom="", $nom="") : int {
		require_once("setup.inc.php");
		require_once("Models/Professeur.php");
		
		$connexion = setup::initialize();
		
		$stmt = $connexion->prepare("SELECT * FROM professeurs WHERE prenom = ? AND nom = ?;");
		$stmt->bind_param("ss", $prenom, $nom);
		$stmt->execute();
		
		$result = $stmt->get_result();
		if($result->num_rows === 0)
			return -1;
		
		// Nous voulons uniquement le premier car la table Professeurs à une contraintes d'unicité de (prénom, nom)
		$row = $result->fetch_assoc();
		if ($row == null)
			return -1;
		
		$id = $row["id"];
		
		$result->close();
		$stmt->close();
		setup::tearDown($connexion);
		
		return $id;
	}
	
	/**
	 * Fetch a professeur from the database
	 * @param int $id The id of the desired professeur
	 * @return Professeur The professeur. If no professeur with a such id has been found, the result will be null.
	 */
	public static function getProfesseurFromId($id = -1) : Professeur {
		if ($id < 0)
			return null;
		
		require_once("Models/Professeur.php");
		require_once("setup.inc.php");
		
		$connexion = setup::initialize();
		
		$stmt = $connexion->prepare("SELECT * FROM professeurs WHERE id = ?;");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		
		// On récupère la première ligne uniquement :
		$row = $result->fetch_assoc();
		
		if ($row == null)
			return null;
		
		$professeur = new Professeur($row["id"], $row["prenom"], $row["nom"]);
		
		$stmt->close();
		setup::tearDown($connexion);
		
		return $professeur;
	}
}

?>
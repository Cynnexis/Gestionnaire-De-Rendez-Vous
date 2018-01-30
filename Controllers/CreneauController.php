<?php

class CreneauController
{
	/**
	 * Display all creneaux in the database in a table
	 */
	public static function afficherCreneaux() : void {
		require_once("setup.inc.php");
		require_once("Models/Creneau.php");
		require_once("Views/CreneauView.php");
		
		$connexion = setup::initialize();
		
		$result = mysqli_query($connexion, "SELECT id, UNIX_TIMESTAMP(dateDebut), duree, estExclusif, UNIX_TIMESTAMP(datePublication), idProfesseur, estLibre, note, commentaire1, commentaire2 FROM creneaux;");
		$creneaux = array();
		for ($i = 0; $line = mysqli_fetch_row($result); $i++)
			$creneaux[$i] = new Creneau($line[0], $line[1], $line[2], (bool) $line[3], $line[4], $line[5], (bool) $line[6], $line[7], $line[8], $line[9]);
		setup::tearDown($connexion);
		
		$table = CreneauView::strCreneaux($creneaux);
		echo $table;
	}
	
	/**
	 * Add a creneau to the database
	 * @param $creneau
	 * @return bool
	 */
	public static function ajouterCreneau($creneau) : bool {
		require_once("Models/Creneau.php");
		if (!($creneau instanceof Creneau) || $creneau == null)
			return false;
		
		require_once("setup.inc.php");
		
		$connexion = setup::initialize();
		
		echo "CreneauController::ajouterCreneau> avant traitement1 : " . $creneau->getDateDebut() . "<br/>";
		echo "CreneauController::ajouterCreneau> avant traitement2 : " . $creneau->getDatePublication() . "<br/>";
		
		$stmt = mysqli_prepare($connexion, "INSERT INTO creneaux(dateDebut, duree, estExclusif, datePublication, idProfesseur, estLibre, note, commentaire1, commentaire2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$epoch = $creneau->getDateDebut();
		$dateDebut = new DateTime("@$epoch", new DateTimeZone("Europe/Paris"));
		echo $dateDebut->getTimestamp() . " =&gt; " . $dateDebut->format("Y-m-d %H:i:s") . "<br/>";
		$duree = $creneau->getDuree();
		$estExclusif = $creneau->getEstExclusif();
		$epoch = $creneau->getDatePublication();
		$datePublication = new DateTime("@$epoch", new DateTimeZone("Europe/Paris"));
		$idProfesseur = $creneau->getIdProfesseur();
		$estLibre = $creneau->getEstLibre();
		$note = $creneau->getNote();
		$commentaire1 = $creneau->getCommentaire1();
		$commentaire2 = $creneau->getCommentaire2();
		
		$dateDebutFormatted = $dateDebut->format("Y-m-d H:i:s");
		$datePublicationFormatted = $datePublication->format("Y-m-d H:i:s");
		
		echo "CreneauController::ajouterCreneau> après traitement1 : $dateDebutFormatted<br/>";
		echo "CreneauController::ajouterCreneau> après traitement2 : $datePublicationFormatted<br/>";
		
		$stmt->bind_param("siisiiiss", $dateDebutFormatted, $duree, $estExclusif, $datePublicationFormatted, $idProfesseur, $estLibre, $note, $commentaire1, $commentaire2);
		$stmt->execute();
		
		$stmt->close();
		setup::tearDown($connexion);
		
		return true;
	}
	
	/**
	 * Change a creneau in the database. The modified creneau is the one containing the same primary key "$id" in $creneau
	 * @param $creneau
	 * @return bool
	 */
	public static function modifierCreneau($creneau) : bool {
		require_once("Models/Creneau.php");
		if (!($creneau instanceof Creneau) || $creneau == null)
			return false;
		
		require_once("setup.inc.php");
		
		$connexion = setup::initialize();
		$stmt = $connexion->prepare("UPDATE creneaux SET dateDebut = ?, duree = ?, estExclusif = ?, datePublication = ?, idProfesseur = ?, estLibre = ?, note = ?, commentaire1 = ?, commentaire2 = ? WHERE id = ?;");
		
		$id = $creneau->getId();
		$epoch = $creneau->getDateDebut();
		$dateDebut = new DateTime("@$epoch", new DateTimeZone("Europe/Paris"));
		$duree = $creneau->getDuree();
		$estExclusif = $creneau->getEstExclusif();
		$epoch = $creneau->getDatePublication();
		$datePublication = new DateTime("@$epoch", new DateTimeZone("Europe/Paris"));
		$idProfesseur = $creneau->getIdProfesseur();
		$estLibre = $creneau->getEstLibre();
		$note = $creneau->getNote();
		$commentaire1 = $creneau->getCommentaire1();
		$commentaire2 = $creneau->getCommentaire2();
		
		$d1 = $dateDebut->format("Y-m-d H:i:s");
		$d2 = $datePublication->format("Y-m-d H:i:s");
		$stmt->bind_param("siisiiissi", $d1, $duree, $estExclusif, $d2, $idProfesseur, $estLibre, $note, $commentaire1, $commentaire2, $id);
		$stmt->execute();
		
		$stmt->close();
		setup::tearDown($connexion);
		
		return true;
	}
	
	/**
	 * Delete a creneau from the database
	 * @param int $id
	 * @return bool
	 */
	public static function supprimerCreneau($id = -1) : bool {
		if ($id < 0)
			return false;
		
		require_once("Models/Creneau.php");
		require_once("setup.inc.php");
		
		$connexion = setup::initialize();
		
		$stmt = $connexion->prepare("DELETE FROM creneaux WHERE id = ? LIMIT 1;");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		
		$stmt->close();
		setup::tearDown($connexion);
		
		return true;
	}
	
	/**
	 * Fetch a creneau from the database
	 * @param int $id The id of the desired creneau
	 * @return Creneau The creneau. If no creneau with a such id has been found, the result will be null.
	 */
	public static function getCreneauFromId($id = -1) : Creneau {
		if ($id < 0)
			return null;
		
		require_once("Models/Creneau.php");
		require_once("setup.inc.php");
		
		$connexion = setup::initialize();
		
		$stmt = $connexion->prepare("SELECT id, UNIX_TIMESTAMP(dateDebut), duree, estExclusif, UNIX_TIMESTAMP(datePublication), idProfesseur, estLibre, note, commentaire1, commentaire2 FROM creneaux WHERE id = ?;");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		
		// On récupère la première ligne uniquement :
		$row = $result->fetch_assoc();
		
		if ($row == null)
			return null;
		
		$creneau = new Creneau($row["id"], $row["UNIX_TIMESTAMP(dateDebut)"], $row["duree"], (bool) $row["estExclusif"], $row["UNIX_TIMESTAMP(datePublication)"], $row["idProfesseur"], (bool) $row["estLibre"], $row["note"], $row["commentaire1"], $row["commentaire2"]);
		
		$stmt->close();
		setup::tearDown($connexion);
		
		return $creneau;
	}
}

?>


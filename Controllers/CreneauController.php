<?php

class CreneauController
{
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
	
	public static function ajouterCreneau($creneau) : bool {
		require_once("Models/Creneau.php");
		if (!($creneau instanceof Creneau) || $creneau == null)
			return false;
		
		require_once("setup.inc.php");
		
		$connexion = setup::initialize();
		
		$stmt = mysqli_prepare($connexion, "INSERT INTO creneaux(dateDebut, duree, estExclusif, datePublication, idProfesseur, estLibre, note, commentaire1, commentaire2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$epoch = $creneau->getDateDebut();
		$dateDebut = new DateTime("@$epoch");
		$duree = $creneau->getDuree();
		$estExclusif = $creneau->getEstExclusif();
		$epoch = $creneau->getDatePublication();
		$datePublication = new DateTime("@$epoch");
		$idProfesseur = $creneau->getIdProfesseur();
		$estLibre = $creneau->getEstLibre();
		$note = $creneau->getNote();
		$commentaire1 = $creneau->getCommentaire1();
		$commentaire2 = $creneau->getCommentaire2();
		$stmt->bind_param("siisiiiss", $dateDebut->format("Y-m-d H:i:s"), $duree, $estExclusif, $datePublication->format("Y-m-d H:i:s"), $idProfesseur, $estLibre, $note, $commentaire1, $commentaire2);
		echo $stmt->execute();
		
		$stmt->close();
		setup::tearDown($connexion);
		
		return true;
	}
	
	// TODO: Tester cette fonction
	public static function modifierCreneau($creneau) : bool {
		require_once("Models/Creneau.php");
		if (!($creneau instanceof Creneau) || $creneau == null)
			return false;
		
		require_once("setup.inc.php");
		
		$connexion = setup::initialize();
		$stmt = $connexion->prepare("UPDATE creneaux SET dateDebut = ?,duree = ?,estExclusif = ?,datePublication = ?,idProfesseur = ?,estLibre = ?,note = ?,commentaire1 = ?, commentaire2 = ? WHERE id = ?;");
		
		$id = $creneau->getId();
		$dateDebut = $creneau->getDateDebut();
		$duree = $creneau->getDuree();
		$estExclusif = $creneau->getEstExclusif();
		$datePublication = $creneau->getDatePublication();
		$idProfesseur = $creneau->getIdProfesseur();
		$estLibre = $creneau->getEstLibre();
		$note = $creneau->getNote();
		$commentaire1 = $creneau->getCommentaire1();
		$commentaire2 = $creneau->getCommentaire2();
		
		$stmt->bind_param("siisiiissi", $dateDebut->format("Y-m-d H:i:s"), $duree, $estExclusif, $datePublication->format("Y-m-d H:i:s"), $idProfesseur, $estLibre, $note, $commentaire1, $commentaire2, $id);
		
		$stmt->close();
		setup::tearDown($connexion);
		
		return true;
	}
	
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
	
	public static function getCreneauFromId($id = -1) : Creneau {
		if ($id < 0)
			return null;
		
		require_once("Models/Creneau.php");
		require_once("setup.inc.php");
		
		$connexion = setup::initialize();
		
		$stmt = $connexion->prepare("SELECT * FROM creneaux WHERE id = ?;");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		
		// On récupère la première ligne uniquement :
		$row = $result->fetch_assoc();
		
		if ($row == null)
			return null;
		
		$creneau = new Creneau($row["id"], $row["dateDebut"], $row["duree"], $row["estExclusif"], $row["datePublication"], $row["idProfesseur"], $row["estLibre"], $row["note"], $row["commentaire1"], $row["commentaire2"]);
		
		$stmt->close();
		setup::tearDown($connexion);
		
		return $creneau;
	}
}

?>


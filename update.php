<?php

require_once('Controllers/ProfesseurController.php');
require_once('Controllers/CreneauController.php');
require_once('Models/Creneau.php');

date_default_timezone_set("Europe/Paris");

// Test si la page à recu des informations POST

// Informations pour ajouter/modifier un créneau:
if (isset($_POST["dateDebut"]) && isset($_POST["duree"]) && isset($_POST["professeur"]))
{
	$dateDebut = DateTime::createFromFormat("Y-m-d\TH:i", $_POST["dateDebut"], new DateTimeZone("Europe/Paris"))->getTimestamp();
	echo "update.php> \$_POST[\"dateDebut\"] = " . $_POST["dateDebut"] . "<br/>";
	echo "update.php> \$dateDebut = " . $dateDebut . "<br/>";
	$duree = Creneau::convertDurationToSeconds($_POST["duree"]);
	echo "update.php> \$duree = " . $duree . "<br/>";
	if (isset($_POST["estExclusif"]))
		$estExclusif = true;
	$prenomNomProfesseur = $_POST["professeur"];
	$estLibre = false;
	if (isset($_POST["estLibre"]))
		$estLibre = true;
	$note = 10;
	if (isset($_POST["note"]))
		$note = $_POST["note"];
	$comment1 = "";
	if (isset($_POST["comment1"]))
		$comment1 = $_POST["comment1"];
	$comment2 = "";
	if (isset($_POST["comment2"]))
		$comment2 = $_POST["comment2"];
	
	// Recherche du professeur id:
	$professeurArray = preg_split("[\s]", $prenomNomProfesseur);
	if (sizeof($professeurArray) >= 2) {
		$id = ProfesseurController::getId($professeurArray[0], $professeurArray[1]);
		
		// Information pour modifier un créneau:
		date_default_timezone_set("Europe/Paris");
		$now = new DateTime("now", new DateTimeZone("Europe/Paris"));
		if (isset($_POST["mode"]) && (int) $_POST["mode"] >= 0)
			CreneauController::modifierCreneau(new Creneau((int) $_POST["mode"], (int) $dateDebut, (int) $duree, (bool) $estExclusif, $now->getTimestamp(), (int) $id, (bool) $estLibre, (int) $note, $comment1, $comment2));
		else
			CreneauController::ajouterCreneau(new Creneau(-1, (int) $dateDebut, (int) $duree, (bool) $estExclusif, $now->getTimestamp(), (int) $id, (bool) $estLibre, (int) $note, $comment1, $comment2));
	}
	else
		echo "update.php> Erreur: Aucun professeur trouvé pour $prenomNomProfesseur<br/>";
}

// Informations pour supprimer un creneau:
if (isset($_POST["supprimer"]) && $_POST["supprimer"] > 0)
	CreneauController::supprimerCreneau($_POST["supprimer"]);

header("location: index.php");

echo "<a href='index.php'><input type='button' value=\"Revenir à la page d'accueil\"></a>";

?>
<?php

require_once('Controllers/ProfesseurController.php');
require_once('Controllers/CreneauController.php');
require_once('Models/Creneau.php');


// Test si la page à recu des informations POST
// Informations pour ajouter un créneau:
if (isset($_POST["dateDebut"]) && isset($_POST["duree"]) && isset($_POST["professeur"]))
{
	$dateDebut = DateTime::createFromFormat("Y-m-d\TH:i", $_POST["dateDebut"])->getTimestamp();
	$duree = $_POST["duree"];
	$estExclusif = false;
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
	
	// Recherche du professeur id:
	// TODO: Faire un getId(), voir si != -1 et ajouter ca à CreneauController::ajouterAvec()
	$professeurArray = preg_split("[\s]", $prenomNomProfesseur);
	if (sizeof($professeurArray) >= 2) {
		$id = ProfesseurController::getId($professeurArray[0], $professeurArray[1]);
		
		CreneauController::ajouterCreneau(new Creneau(-1, (int) $dateDebut, (int) $duree, (bool) $estExclusif, time(), (int) $id, (bool) $estLibre, (int) $note, $comment1, ""));
	}
	else
		echo "Aucun professeur trouvé pour $prenomNomProfesseur<br/>";
}

// Informations pour supprimer un creneau:
if (isset($_POST["supprimer"]) && $_POST["supprimer"] > 0)
	CreneauController::supprimerCreneau($_POST["supprimer"]);

header("location: index.php");
?>
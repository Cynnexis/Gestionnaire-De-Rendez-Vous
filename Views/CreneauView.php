<?php

class CreneauView
{
	public static function strCreneaux($creneaux = array()) : string {
		/*
		echo "<table class='table table-hover'>";
		echo "<thead><tr>";
		echo "<th>Date de Début</th>";
		echo "<th>Durée</th>";
		echo "<th>Est Exclusif</th>";
		echo "<th>Date de Publication</th>";
		echo "<th>Identifiant du Professeur</th>";
		echo "<th>Est Libre</th>";
		echo "<th>Note</th>";
		echo "<th>Commentaire avant Créneau</th>";
		echo "<th>Commentaire après Créneau</th>";
		echo "</tr></thead>";
		echo "<tbody>";
		for ($i =0, $maxi = sizeof($creneaux); $i < $maxi; $i++) {
			echo "<tr>";
			echo "<td>" . $creneaux[$i]->getId() . "</td>";
			echo "<td>" . $creneaux[$i]->getDateDebut() . "</td>";
			echo "<td>" . $creneaux[$i]->getDuree() . "</td>";
			echo "<td>" . $creneaux[$i]->getEstExclusif() . "</td>";
			echo "<td>" . $creneaux[$i]->getDatePublication() . "</td>";
			echo "<td>" . $creneaux[$i]->getIdProfesseur() . "</td>";
			echo "<td>" . $creneaux[$i]->getEstLibre() . "</td>";
			echo "<td>" . $creneaux[$i]->getNote() . "</td>";
			echo "<td>" . $creneaux[$i]->getCommentaire1() . "</td>";
			echo "<td>" . $creneaux[$i]->getCommentaire2() . "</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";*/
		
		require_once('TableView.php');
		$array = array();
		for ($i = 0, $maxi = sizeof($creneaux); $i < $maxi; $i++)
			$array[$i] = array($creneaux[$i]->getId(), $creneaux[$i]->getDateDebut(), $creneaux[$i]->getDuree(), $creneaux[$i]->getEstExclusif(), $creneaux[$i]->getDatePublication(), $creneaux[$i]->getIdProfesseur(), $creneaux[$i]->getEstLibre(), $creneaux[$i]->getNote(), $creneaux[$i]->getCommentaire1(), $creneaux[$i]->getCommentaire2());
		
		return TableView::arrayToString($array, array("Identifiant", "Date de Début", "Durée", "Est Exclusif", "Date de Publication", "Identifiant du Professeur", "Est Libre", "Note", "Commentaire avant Créneau", "Commentaire après Créaneau"));
	}
}

?>
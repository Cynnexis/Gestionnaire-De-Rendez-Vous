<?php

class ProfesseurView
{
	public static function strProfesseurs($professeurs = []) : string {
		require_once('TableView.php');
		$array = array();
		for ($i = 0, $maxi = sizeof($professeurs); $i < $maxi; $i++)
			$array[$i] = array($professeurs[$i]->getPrenom(), $professeurs[$i]->getNom());
		
		return TableView::arrayToString($array, array("Prenom", "Nom"));
	}
}

?>
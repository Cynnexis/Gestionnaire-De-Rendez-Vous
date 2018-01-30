<?php

class ProfesseurView
{
	/**
	 * Convert an array of Professeurs into a string containing HTML code to display a table of the given array
	 * @param array $professeurs The array of Professeurs to convert
	 * @return string The string containing the table
	 */
	public static function strProfesseurs($professeurs = []) : string {
		require_once('TableView.php');
		$array = array();
		for ($i = 0, $maxi = sizeof($professeurs); $i < $maxi; $i++)
			$array[$i] = array($professeurs[$i]->getPrenom(), $professeurs[$i]->getNom());
		
		return TableView::arrayToString($array, array("Prenom", "Nom"));
	}
}

?>
<?php

class ProfesseurController
{
	public static function afficherProfesseurs($professeurs = array()) : void {
		require_once("Views/ProfesseurView.php");
		$table = ProfesseurView::strProfesseurs($professeurs);
		echo $table;
	}
}

?>
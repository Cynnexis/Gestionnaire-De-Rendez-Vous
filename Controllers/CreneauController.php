<?php

class CreneauController
{
	public static function afficherCreneaux($creneaux = array()) : void {
		require_once("Views/CreneauView.php");
		$table = CreneauView::strCreneaux($creneaux);
		echo $table;
	}
}

?>


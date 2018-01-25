<?php

class CreneauView
{
	public static function strCreneaux($creneaux = array()) : string {
		$format = "d/m/Y H:i:s";
		$result = "";
		$result .= "<table class='table table-hover'>";
		$result .= "<thead><tr>";
		$result .= "<th>Identifiant</th>";
		$result .= "<th>Date de Début</th>";
		$result .= "<th>Durée</th>";
		$result .= "<th>Est Exclusif</th>";
		$result .= "<th>Date de Publication</th>";
		$result .= "<th>Identifiant du Professeur</th>";
		$result .= "<th>Est Libre</th>";
		$result .= "<th>Note</th>";
		$result .= "<th>Commentaire avant Créneau</th>";
		$result .= "<th>Commentaire après Créneau</th>";
		$result .= "<th></th>";
		$result .= "</tr></thead>";
		$result .= "<tbody>";
		$dt = null;
		for ($i =0, $maxi = sizeof($creneaux); $i < $maxi; $i++) {
			$epoch = $creneaux[$i]->getDateDebut();
			$dt1 = new DateTime("@$epoch");
			$epoch = @$creneaux[$i]->getDatePublication();
			$dt2 = new DateTime("@$epoch");
			$result .= "<tr>";
			$result .= "<td>" . $creneaux[$i]->getId() . "</td>";
			$result .= "<td>" . $dt1->format($format) . "</td>";
			$result .= "<td>" . $creneaux[$i]->getDuree() . "</td>";
			$result .= "<td>" . $creneaux[$i]->getEstExclusif() . "</td>";
			$result .= "<td>" . $dt2->format($format) . "</td>";
			$result .= "<td>" . $creneaux[$i]->getIdProfesseur() . "</td>";
			$result .= "<td>" . $creneaux[$i]->getEstLibre() . "</td>";
			$result .= "<td>" . $creneaux[$i]->getNote() . "</td>";
			$result .= "<td>" . $creneaux[$i]->getCommentaire1() . "</td>";
			$result .= "<td>" . $creneaux[$i]->getCommentaire2() . "</td>";
			$result .= "<td>
							<form action='update.php' method='post'>
								<input type='hidden' id='modifier' name='modifier' value='" . $creneaux[$i]->getId() . "'/>
								<input type='submit' class='btn btn-primary' value='Modifier'/>
							</form>
							<form action='update.php' method='post'>
								<input type='hidden' id='supprimer' name='supprimer' value='" . $creneaux[$i]->getId() . "'/>
								<input type='submit' class='btn btn-primary' value='Supprimer'/>
							</form>
						</td>";
			$result .= "</tr>";
		}
		$result .= "</tbody>";
		$result .= "</table>";
		
		return $result;
	}
}

?>
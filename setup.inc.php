<?php

class setup
{
	public static function initialize() : mysqli {
		require("config.inc.php");
		$connection = mysqli_connect($CFG->host, $CFG->user, $CFG->password, $CFG->databasename, 3306, "");
		if (!$connection)
			die("Erreur de connection à la base de donnée: " . mysqli_connect_errno() . " :" . mysqli_connect_error());
		mysqli_select_db($connection, $CFG->databasename);
		return $connection;
	}
	
	public static function tearDown($connexion) : void {
		mysqli_close($connexion);
	}
}

?>
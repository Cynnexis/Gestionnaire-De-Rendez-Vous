<?php

function connectionTo($host = "locahost", $user = "root", $password = "", $databasename = "", $port = 3306, $socket = "") {
	$connection = mysqli_connect($host, $user, $password, $databasename, $port, $socket);
	
	if ($connection) {
		/*echo "Connection Information: " . mysqli_get_host_info($connection) . "<br />";
		echo "Server Information: " . mysqli_get_server_info($connection) . "<br />";
		echo "Server Version: " . mysqli_get_server_version($connection) . "<br />";*/
	}
	else
	{
		echo "Error " . mysqli_connect_errno() . ": " . mysqli_connect_error();
	}
	
	echo "<br />";
	
	return $connection;
}

function selectDatabase($connection, $database) {
	$result = mysqli_select_db($connection, $database);
	
	if ($result) {
		//echo "Database \"" . $database . "\" selected." . "<br />";
	}
	else
		echo "Error: Cannot connect to the database " . $database . "." . "<br />";
	echo "<br />";
}

function displayQuery($connection, $query, $headers = null) {
	echo "Query: \"" . $query . "\"<br />";
	$result = mysqli_query($connection, $query);
	echo "<br />";
	displayResult($result, $headers);
	
	return $result;
}

function displayResult($result, $headers = null) {
	$line = mysqli_fetch_row($result);
	echo "<table class='table table-hover'>";
	
	if ($headers) {
		echo "<thead><tr>";
		foreach ($headers as $h)
			echo "<th>$h</th>";
		echo "</tr></thead>";
	}
	echo "<tbody>";
	while ($line) {
		echo "<tr>";
		foreach ($line as $item)
			echo "<td>$item</td>";
		
		echo "</tr>";
		$line = mysqli_fetch_row($result);
	}
	echo "</tbody>";
	echo "</table>";
	echo "<br />";
}

function disconnectFrom($connection) {
	if ($connection) {
		$result = mysqli_close($connection);
		
		if ($result) {
			//echo "Disconnected from the database." . "<br />";
		}
		else
			echo "Error when disconnecting from the database." . "<br />";
	}
	else
		echo "Error: Not a valid connection." . "<br />";
	echo "<br />";
}

?>
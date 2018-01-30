<?php

class TableView
{
	/**
	 * Convert an array of string to an HTML table, using bootstrap
	 * @param array $data
	 * @param array $headers
	 * @return string
	 */
	public static function arrayToString($data = [], $headers = []) : string {
		$result = "";
		
		if (sizeof($data) <= 0)
			return $result;
		
		$result .= "<table class='table table-hover'>";
		
		// Headers:
		$result .= "<thead><tr>";
		foreach ($headers as $h)
			$result .= "<th>$h</th>";
		$result .= "</tr></thead>";
		
		
		// Data:
		$result .= "<tbody>";
		for ($i =0, $maxi = sizeof($data); $i < $maxi; $i++) {
			$result .= "<tr>";
			foreach ($data[$i] as $item)
				$result .= "<td>$item</td>";
			$result .= "</tr>";
		}
		$result .= "</tbody>";
		$result .= "</table>";
		
		return $result;
	}
}

?>
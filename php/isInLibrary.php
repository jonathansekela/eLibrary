<?php
function isInLibrary() {
	require("utility.php");
	 if($_SERVER["REQUEST_METHOD"]=="POST") {
	 	$dbname="../docs/server-info-sr.txt";
		logIntoDataBase($dbconn, $dbname);
		$qrcode = (int)cleanInput($_POST["book"]); // from string to int
		$query = "SELECT
					b.is_available
				  FROM
				  	books b
				  WHERE
				  	b.qrcode = $qrcode;";
		$myArray = array();
		$result = $dbconn->query($query);
		if($result) {
			while($row = $result->fetch_assoc()) {
            	$myArray[] = $row;
    		}
			echo json_encode($myArray[0]);
		} else {
			echo "ERROR: unsuccessful query";
		}
		disconnectDB($dbconn, $dbname);
	}
}

isInLibrary();
?>
<?php
require("utility.php");
if($_SERVER["REQUEST_METHOD"]=="POST") {
	$book = (int)cleanInput($_POST["book"]); // from string to int
	$dbname="../docs/server-info-sr.txt";
	logIntoDataBase($dbconn, $dbname);
	$query = "	SELECT
					b.title, b.qrcode
				FROM
				 	books b
				WHERE
					b.qrcode = '$book';";
	$myArray = array();
	$result = $dbconn->query($query);
	if ($result) {
		while($row = $result->fetch_assoc()) {
            $myArray[] = $row;
    	}
		echo json_encode($myArray[0]);
	}
	else
		echo "ERROR: unsuccessful query";
	//disconnect when finished
	disconnectDB($dbconn,$dbname);

}
?>
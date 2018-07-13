<?php
require('utility.php');

if ($_SERVER["REQUEST_METHOD"]=="POST") {
	$email = cleanInput(strtolower($_POST["email"])); // lower case
	logMsg("validating user email $email...");
	$dbname="../docs/server-info-sr.txt";
	logIntoDataBase($dbconn, $dbname);
	$query="SELECT 	email
			FROM 	users u
			WHERE 	u.email = '$email';";
	$result = $dbconn->query($query);

	$myArray = array();
	if ($result) {
		logMsg("query successful. encoding result...");
		while($row = $result->fetch_assoc()) {
            $myArray[] = $row;
    	}
		echo json_encode($myArray[0]);
	} else {
		logMsg("query failed.");
		echo "ERROR: unsuccessful query";
	}
	// disconnect db when finished
	disconnectDB($dbconn,$dbname);
} else echo "a non-POST request - see system admin.";
?>
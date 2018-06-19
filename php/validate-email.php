<?php
require('utility.php');

if ($_SERVER["REQUEST_METHOD"]=="POST") {
	$email = cleanInput($_POST["email"]);
	logMsg("validating user email $email...");
	$dbname="../docs/server-info-sr.txt";
	logIntoDataBase($dbconn, $dbname);
	$query="SELECT 	email
			FROM 	users u
			WHERE 	u.email = '$email';";
	$result = $dbconn->query($query);
	if ($result) {
		echo json_encode($result);
	} else {
		echo "0";
	}
	// disconnect db when finished
	disconnectDB($dbconn,$dbname);
} else echo "a non-POST request - see system admin.";
?>
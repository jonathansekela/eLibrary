<?php

require("utility.php");
if ($_SERVER["REQUEST_METHOD"]=="GET") {
	$email = cleanInput($_POST["email"]);

	logMsg("activating user $email...");
	$dbname="../docs/server-info-sr.txt";
	logIntoDataBase($dbconn, $dbname);
	$query = "UPDATE users
				SET isActive = TRUE
				WHERE email = '$email';"
	logMsg($query);
	$result = $dbconn->query($query);
    disconnectDB($dbconn,$dbname);
    if(!$result) logMsgAndDie('alter command failed');
    else echo "Success! Your account is now active.";
} else echo "A non-GET request - see system admin.";

?>
<?php
function returnBook() {
	require("utility.php");
	// connect to server
	if($_SERVER["REQUEST_METHOD"]=="POST") {
		$qrcode = (int)$_POST["qrcode"];
		$user = (int)$_POST["user"];
	 	$dbname="../docs/server-info-sr.txt";
		logIntoDataBase($dbconn, $dbname);
		// set is_available to true, update return and due
		//	date, update current owner of book, set due_date to
		//	null again
		$query = "UPDATE books
						SET is_available = true,
							return_date = CURDATE(),
							due_date = null
						WHERE qrcode = $qrcode;

						DELETE FROM currently_checked_out_books 
						WHERE
						    book_qrcode = $qrcode AND user_id = $user;";
		$result = $dbconn->multi_query($query);
		if ($result) {
			echo "Successful query. Please check database for result";
		} else {
			echo "ERROR: unsuccessful query";
		}
		//disconnect when finished
		disconnectDB($dbconn,$dbname);
	}
}

returnBook();
?>
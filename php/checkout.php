<?php
function checkout() {
	require("utility.php");
	 if($_SERVER["REQUEST_METHOD"]=="POST") {
	 	$qrcode = (int)cleanInput($_POST["qrcode"]); // from string to int
		$user = (int)cleanInput($_POST["user"]);
		$dbname="../docs/server-info-sr.txt";
		logIntoDataBase($dbconn, $dbname);
		// set is_available to false, update checkout and due
		// date, update current owner of book, set due_date to
		// current date + 14 days
		$query = "UPDATE books
						SET is_available = false,
							checkout_date = CURDATE(),
							due_date = DATE_ADD(CURDATE(),
							INTERVAL 14 DAY)
						WHERE qrcode = '$qrcode';

						INSERT INTO currently_checked_out_books
						(user_id, book_qrcode, due_date)
						VALUES (
							'$user',
							'$qrcode',
							DATE_ADD(CURDATE(), INTERVAL 14 DAY)
						);";
		// multi_query for queries that contain multiple actions
		$result = $dbconn->multi_query($query);
		if ($result) {
			echo "Successful query. Please check database for appropriate result<br>";
		} else {
			echo "ERROR: unsuccessful query: ".$query;
		}
		//disconnect when finished
		disconnectDB($dbconn,$dbname);
	}
}

checkout();
?>
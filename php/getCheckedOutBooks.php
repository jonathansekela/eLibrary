<?php
function getCheckedOutBooks() {
	require("utility.php");
	 if($_SERVER["REQUEST_METHOD"]=="POST") {
		$user = (int)cleanInput($_POST["user"]); // from string to int
		$dbname="../docs/server-info-sr.txt";
		logIntoDataBase($dbconn, $dbname);
		// return title, due date of checked out books with user_id = $user
		$query = "	SELECT 
					    c.user_id, b.title, c.due_date
					FROM
					    books b,
					    currently_checked_out_books c
					WHERE
						b.is_available = FALSE
					AND
						b.qrcode = c.book_qrcode;";
		$myArray = array();
		$result = $dbconn->query($query);
		if ($result) {
			while($row = $result->fetch_assoc()) {
            	$myArray[] = $row;
    		}
			echo json_encode($myArray);
		} else {
			echo "ERROR: unsuccessful query";
		}
		//disconnect when finished
		disconnectDB($dbconn,$dbname);
	}
}

getCheckedOutBooks();
?>
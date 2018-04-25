<?php
function getMyBooks() {
	require("utility.php");
	 if($_SERVER["REQUEST_METHOD"]=="POST") {
		$user = (int)cleanInput($_POST["user"]); // from string to int
		$dbname="../docs/server-info-sr.txt";
		logIntoDataBase($dbconn, $dbname);
		// return title, due date of checked out books with user_id = $user
		$query = "	SELECT 
					    b.title, c.due_date
					FROM
					    books b,
					    currently_checked_out_books c
					WHERE
					    c.user_id = $user AND b.qrcode = c.book_qrcode;";
		$myArray = array();
		$result = $dbconn->query($query);
		if ($result) {
			logMsg("getMyBooks query result successful. creating result array...");
			while($row = $result->fetch_assoc()) {
            	$myArray[] = $row;
    		}
    		logMsg("outputting json-encoded array...");
			echo json_encode($myArray);
		} else {
			logMsg("Error: getMyBooks query result unsuccessful.");
			echo "ERROR: getMyBooks query result unsuccessful.";
		}
		// disconnect when finished
		disconnectDB($dbconn,$dbname);
	}
}

getMyBooks();
?>
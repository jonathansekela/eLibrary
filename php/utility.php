<?php
// Author: Prof. Roger Shore, High Point University
// Year created: 2016
// Class: 2016
// Editor: Jonathan Sekela
//
// Utility functions for php form processing, database interaction

  function cleanInput($data) { 
        $data = trim($data); 
        $data = stripslashes($data); 
        $data = htmlspecialchars($data);
	      $data = htmlentities($data);
        return $data;
   }
//=================

  function connectToDB($serverName,$dbName,$dbUser,$dbPass) {  
      //The object oriented way
      $dbconn = new mysqli($serverName,$dbUser,$dbPass, $dbName);
      logMsg("Connecting to $serverName with user $dbUser"); 
      if(!$dbconn) {
           logMsg('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
           logMsgAndDie("Error Connecting to $serverName with user $dbUser"); 
      }
      if(!$dbconn->select_db($dbName))
        logMsgAndDie("Could not select $dbName database");
      return $dbconn;
  }
//=================

  function disconnectDB($dbconn,$dbName) {
     $dbconn->close();
     logMsg("Disconnect from current database $dbName");
  }
//=================

  // The log file is in /private/var/log/apache2/error_log .  This is designated in the .htaccess file in the root
  // directory of a project.  I generally use the UNIX tail command to view the log file.
  function logMsg($message) { 
        error_log($message);
  }
//=================
  
  function logMsgAndDie($message) {
        error_log($message); 
        // die("See error log for details ".mysql_error());
        die("See error log for details.");
  }
//=================

  function getDBInfo(&$infile, &$serverName, &$dbName, &$dbUser, &$dbPass) {
    // trim() strips whitespace from start and end of strings
    $serverName = trim(fgets($infile));
    $dbName = trim(fgets($infile));
    $dbUser = trim(fgets($infile));
    $dbPass = trim(fgets($infile));
    // add port number to serverName
    $serverName = $serverName . ':' . trim(fgets($infile));
  }
//==================

  // Function to login to a given database based on information
  //  stored in a specified text file:
  //  > server name
  //  > db name
  //  > db user
  //  > db password
  function logIntoDataBase(&$dbconn, $dbInfo) {
    $infile = fopen($dbInfo, "r");
    // create db variables
    $serverName = ""; $dbName = ""; $dbUser = ""; $dbPass = "";
    // load db variables
    getDBInfo($infile, $serverName, $dbName, $dbUser, $dbPass);
    fclose($infile);
    // connect to server
    $dbconn = connectToDB($serverName, $dbName, $dbUser, $dbPass);
  }
//==================

  // @TODO: Finish and test sendMail
  // function to send an email using smtp
  function sendMail($from, $to, $subject, $body) {
    $host = 'smtpserver.com';
    $port = '25';
    $username = 'yourlogin';
    $password = 'yourpass';

    $headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject);
    $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));

    $mail = $smtp->send($to, $headers, $body);

    if(PEAR::isError($mail)) {
      echo("<p>" . $mail->getMessage() . "</p>");
    } else {
      echo("<p>Message successfully sent!</p>");
    }
  }
?>

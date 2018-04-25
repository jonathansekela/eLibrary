<!DOCTYPE html>
<!-- 
   Name: Jonathan Sekela
   Date: 2018/04/03
   purpose: SZ12 Library signup processing
-->         
<html>
   <head>    
      <title>Form Processing</title>
   </head>
   <body>      
      <h1>Signup</h1>
      <?php
         require("utility.php");
         if($_SERVER["REQUEST_METHOD"]=="POST") {
            $email = cleanInput($_POST["email"]);
            $password = password_hash(cleanInput($_POST["password"]), PASSWORD_DEFAULT);

            logMsg('Storing data for: '.$email);
            $dbname="../docs/server-info-sr.txt";
            logIntoDataBase($dbconn, $dbname);
            $query = "INSERT INTO users
                        (email, passwd)
                      VALUES (
                           '$email',
                           '$password'
                        );";
            logMsg($query);
            $result = $dbconn->query($query); 
            if(!$result) logMsgAndDie('insert command failed');
            else {
               logMsg('insert successful');
               echo "signup successful! Please verify your email address at $email.";
               // @TODO: send verification email - doesn't work on localhost, need actual webserver

               // redirect to login page
               $loc = "localhost/projects/sz12-TEST/login.html";
               header("Location: $loc")

            }
            disconnectDB($dbconn,$dbname);
         } else echo "a non-POST request - see system admin";
      ?> 
   </body>
</html>
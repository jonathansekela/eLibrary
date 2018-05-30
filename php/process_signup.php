<!DOCTYPE html>
<!-- 
   Name: Jonathan Sekela
   Date: 2018/05/30
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
            disconnectDB($dbconn,$dbname);
            if(!$result) logMsgAndDie('insert command failed');
            else {
               logMsg('insert successful');
               // @TODO: send verification email - doesn't work on localhost, need actual webserver
               $to_email_address = $email;
               $subject = "Please verify your account | EF eLibrary";
               $message = "Welcome to the EF eLibrary!\n\nPlease verify your account by clicking the link below.\n\n <a href=''>INSERT LINK HERE :V</a> \n\nThis is an automatically-generated message. Please don't reply to this address.";
               $headers = "From: noreply@ef.com";
               mail($to_email_address,$subject,$message,$headers);
               echo "signup successful! Please verify your email address at $email.";
            }
         } else echo "a non-POST request - see system admin";
      ?> 
   </body>
</html>
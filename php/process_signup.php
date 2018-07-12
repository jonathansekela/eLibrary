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
               logMsg('Creating email message...');
               $to_email_address = $email;
               logMsg("to: $to_email_address...");
               $subject = "Please verify your account | EF eLibrary";
               logMsg("subject: '$subject'...");
               $message = "Welcome to the EF eLibrary! <br> Please verify your account by clicking the link below. <br> <a href='13.125.196.197/php/validate-user.php'>Click here! :D</a> <br> This is an automatically-generated message. Please don't reply to this address.";
               $headers = "From: noreply@ef.com";
               logMsg("Sending mail using mail()...");
               mail($to_email_address,$subject,$message,$headers);
               logMsg("please check $email for confirmation.");
               echo "signup successful! Please verify your email address at $email.";
            }
         } else echo "a non-POST request - see system admin.";
      ?> 
   </body>
</html>
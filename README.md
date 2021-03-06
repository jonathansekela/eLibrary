# eLibrary 0.3.0
### EF eLibrary Web-application.
#### Purpose: self-service mobile library web-application
Parents will sign up with their email, password, phone number, student name, and WeChat contact information. They can scan a book's QR code to check the book out, and they can take it home to read on their own. After 1-2 weeks, members with checked out books will be notified that their book needs to be returned.
##### Dependencies:
* [JsQrScanner](https://github.com/jbialobr/JsQRScanner "JavaScript QR Scanner for HTML5 Supporting Browsers")
* [Bootstrap](https://getbootstrap.com/ "Bootstrap: the most popular HTML, CSS, and JS library in the world")
* [jQuery](https://code.jquery.com/jquery-3.3.1.min.js "Production jQuery download link")

#### Current To-Do
 1. __In-house Server Laptop__
    * [x] Acquire server laptop (temporary solution currently in place)
    * [ ] Developer mode on
    * [x] Bash shell enabled and installed
    * [ ] MAMP stack working properly
       * [ ] MySQLi extension
       * [ ] apache
       * [ ] MySQL database
    * [ ] MySQLWorkbench installed
    * [x] code editor:
        * [x] Sublime Text
    * [ ] IT team cooperation
 2. __AWS Site__
    * [x] EC2 instance
    * [x] LAMP stack
    * [x] Connection to admin computer
    * [x] security groups allow for beta testers to reliably connect when given URL
    * [ ] AWS RDS
      * [x] create MySQL server instance
      * [x] migrate schema from admin computer to instance
      * [ ] consistent, successful connection from EC2 to RDS
    * [ ] Fix AWS web-server permissions to allow js access to webcam
      * [ ] **update:** EC2 denies webcam access. camera feature will not work with current setup; need a dedicated server with in-house permissions granted.
      * [ ] could also ask for special AWS permissions, but this route seems unlikely to come to fruition
 3. __Admin page__
    * [x] Look at books
    * [ ] Add book
    * [ ] Remove book
    * [ ] Look at users
    * [ ] Email user
4. __Sign-up__
    * [x] form with email, password, password confirmation
    * [x] information inserted into database, salted, encrypted properly
    * [ ] verification email sent
    * [ ] verification php works
6. __Login__
    * [x] form with email/password
    * [ ] index page redirects to login w/o cookie

##### Change-log
- 2018/07/13: added callback to signup.js validateemail function
   - new bug found: validate-email.php says query successful, but validateemail ajax call calls error function
   - with current callback structure, validate still finishes before validateemail...
- 2018/07/12: changed all JS '<=' '>=' '!=' and '==' operators to '<==' '>==' '!==' and '===' respectively
   - Signup and Login JS need to be altered to take into account Javascript's asynchronous nature. Callbacks will be implemented for email validity checks
- 2018/07/03: changed server information to connect to localhost, enabled qr-code scanner for further testing
- 2018/06/19: general testing and debugging...
   - **signup email validation cannot be debugged without working MySQLi connection. [MySQLi problem](https://stackoverflow.com/questions/50692718/amazon-linux-os-db-connection-mysqli-installed-but-not-found) needs to be solved ASAP.**
- 2018/06/14: added server-side email verification to signup page
   - added php/validate-user.php
   - modified js/signup.js and signup.html
- 2018/06/05: worked on user sign-up and validation
   - added php/validate-user.php
   - disabled JsQRScanner to prevent problems with AWS permissions
   - [MySQLi problem](https://stackoverflow.com/questions/50692718/amazon-linux-os-db-connection-mysqli-installed-but-not-found) discovered, question asked
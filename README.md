# eLibrary 0.2.3
### EF eLibrary Web-application.
#### Purpose: self-service mobile library web-application
As of April 25th, 2018, I feel comfortable enough with the state of the application to put it on GitHub and treat it as more of a professional development. Thus, the GitHub repository and the readme. This will help me keep track of developments as they come, as well as direct people to projects and work done online.
##### Dependencies:
* [JsQrScanner](https://github.com/jbialobr/JsQRScanner "JavaScript QR Scanner for HTML5 Supporting Browsers")
* [Bootstrap](https://getbootstrap.com/ "Bootstrap: the most popular HTML, CSS, and JS library in the world")
* [jQuery](https://code.jquery.com/jquery-3.3.1.min.js "Production jQuery download link")

#### Current To-Do
 1. __Server Laptop__
    * _Acquire_ server laptop :v
    * Developer mode on
    * Bash shell enabled and installed
    * LAMP/WAMP stack working properly
    * MySQLWorkbench installed
    * code editor:
        * Atom
        * Notepad++
    * Admin password would make all this run _so much_ smoother...
 2. __AWS Site__
    * EC2 instance :white_check_mark:
    * LAMP stack :white_check_mark:
    * Connection to admin computer :white_check_mark:
    * security groups allow for beta testers to reliably connect when given URL :white_check_mark:
    * AWS RDS
      * create MySQL server instance :white_check_mark:
      * migrate schema from admin computer to instance :white_check_mark:
      * consistent, successful connection from EC2 to RDS
    * Fix AWS web-server permissions to allow js access to webcam
 3. __Admin page__
    * Look at books :white_check_mark:
    * Add book
    * Remove book
    * Look at users
    * Email user
4. __Sign-up__
    * form with email, password, password confirmation :white_check_mark:
    * information inserted into database, salted, encrypted properly :white_check_mark:
    * verification email sent
    * verification php works
6. __Login__
    * form with email/password :white_check_mark:
    * index page redirects to login w/o cookie

##### Change-log
- 2018/06/05: worked on user sign-up and validation
   - added php/validate-user.php
   - disabled JsQRScanner to prevent problems with AWS permissions
/*
   Name: R. Shore
   Editor: Jonathan Sekela
   Date created: 2-8-2016
   Class: CSC-2210

   Javascripts to support the processing of a signup form
*/

function isempty(aStr) {
  return (aStr === "");
}
//=======

function isDigit(aChar)
{
  return (aChar >= '0' && aChar <= '9');
}
//=======

function isAnInt(aNum)
{
  for(var i=0; i<aNum.length; i++)
     if(!isDigit(aNum.charAt(i)))
        return false;
  return true;
}
//=======

// function validates email client-side, then
// checks db for identical email addresses
// regarding the callback function: There's NO WAY this is a good idea...
function validateemail(email, callback = function(result) {
                                          result = JSON.parse(result);
                                          if (result === null) { // no identical email found
                                            console.log("validateemail(): result is null, no identical email found");
                                            return true;
                                          } else { // identical email found
                                            console.log("validateemail(): result is not null, identical email was found");
                                            alert(result.email);
                                            alert("Error: user with that email already exists");
                                            email.value="";
                                            email.focus();
                                            return false;
                                          }
}) { // RFC 5322 Official Standard 2018/04/05
  correct=RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
  if (!correct.test(email.value)) {
    alert("Error: Invalid entry for email");
    email.value="";
    email.focus();
    return false;
  } else {
    // check db for identical email address
    $.ajax({
      type: "POST",
      url: "php/validate-email.php",
      dataType: "text",
      data:
      {
        email: email.value
      },
      success: function(result) {
        callback(result);
      },
      error: function(xhr, status, error) {
        alert("function validateemail: " + status + ' ||| ' + error);
      }
    });
  }
}
//=======

function validatepasswords(pwd, pwdconf) {
  if (isempty(pwd.value)) {
    alert("Error: Please input a password");
    pwd.focus();
    return false;
  }
  if (isempty(pwdconf.value)) {
    alert("error: Please confirm your password");
    pwdconf.focus();
    return false;
  }
  if (pwd.value !== pwdconf.value) {
    alert("Error: Passwords do not match");
    pwdconf.focus();
    return false;
  }
  return true;
}

function validate(form) {
  // validate email
  if(!validateemail(form.email)) {
    console.log("validate(): email not valid.");
    return false;
  }
  // validate password and password confirmation
  if(!validatepasswords(form.password, form.password_confirmation)) {
    console.log("validate(): passwords not valid.");
    return false;
  }

  return true;
}
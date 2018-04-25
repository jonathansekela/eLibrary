/*
   Name: R. Shore
   Editor: Jonathan Sekela
   Date created: 2-8-2016
   Class: CSC-2210

   Javascripts to support the processing of a signup form
*/

function isempty(aStr) {
  return (aStr == "");
}
//=======

function isDigit(aChar)
{
  return (aChar >= '0' && aChar <= '9');
  // if(aChar >= '0' && aChar <= '9')
  //    return true;
  // else
  //    return false;
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

function validateemail(email) { // RFC 5322 Official Standard 2018/04/05
  correct=RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
  if (!correct.test(email.value)) {
    alert("Error: Invalid entry for email");
    email.value="";
    email.focus();
    return false;
  }
  return true;
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
  if(!validateemail(form.email)) return false;
  if(!validatepasswords(form.password, form.password_confirmation)) return false;

  return true;
}

function validateregform()
{
var fname=document.forms["register"]["fname"].value;
var lname=document.forms["register"]["lname"].value;
var email=document.forms["register"]["email"].value;
var pwd1=document.forms["register"]["pwd"].value;
var pwd2=document.forms["register"]["pwd2"].value;
var birthyear = parseInt(document.forms["register"]["year"].value);
var birthmonth = parseInt(document.forms["register"]["month"].value) - 1;
var birthday = parseInt(document.forms["register"]["day"].value);

if (fname==null || fname=="")
  {
  var div = document.getElementById("error");
    div.textContent = "First name must be filled in";
    var text = div.textContent;
  return false;
  }
  if (lname==null || lname=="")
  {
  var div = document.getElementById("error");
    div.textContent = "Last name must be filled in";
    var text = div.textContent;
  return false;
  }
  if (email==null || email=="")
  {
  var div = document.getElementById("error");
    div.textContent = "E-mail must be filled in";
    var text = div.textContent;
  return false;
  }
  var atpos=email.indexOf("@");
   var dotpos=email.lastIndexOf(".");
   if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) //Checks if @ is first character, if email is @. or if the . is not in the string
  	{
  		var div = document.getElementById("error");
    div.textContent = "Not a valid e-mail address";
    var text = div.textContent;
  		return false;
  	}
  if (pwd1 != pwd2)
  {
 var div = document.getElementById("error");
    div.textContent = "Passwords don't match";
    var text = div.textContent;
  return false;
  }

   if (pwd1 == "" || pwd1 == null)
  {
 var div = document.getElementById("error");
    div.textContent = "Passwords must be filled in";
    var text = div.textContent;
  return false;
  }

  
  	//Minimum Age to Allow on the Site. Due to Children's Online Privacy Protection, this is 13
 	var min_age = 13;

	var submitteddate = new Date((birthyear + min_age), birthmonth, birthday); //get date in JS format
	var today = new Date;

	if ( (today.getTime() - submitteddate.getTime()) < 0) { //If thier age is less than 13, this will return false
		alert("Sorry! Due to the Children's Online Privacy Protection Act, you must be 13 years old to join the Brotherhood.");
		return false;
		}
}

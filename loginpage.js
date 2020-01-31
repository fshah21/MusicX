function validatelogin()
{
var pwd=document.forms["loginbox"]["password"].value;
var email=document.forms["loginbox"]["email"].value;
if (pwd==null || pwd=="")
  {
  alert("Please fill in your password.");
  return false;
  }
if (email==null || email=="")
{
  alert("Email must be filled in.");
  return false;
}
}

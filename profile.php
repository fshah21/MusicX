<?php
session_start();
//Include MySQL config info
include("config.php");

//Kick out users who are not logged in


//Check to see if user exists
$userid = intval($_GET['id']);
$loginquery="SELECT * FROM login WHERE userid='$userid'";
$loginresult=mysql_query($loginquery);
if (!mysql_num_rows($loginresult))
{
		header("location: 404.php"); //If not redirect
}

//If users exists, start printing the page
 //Universal Start of Page
include("friending.php");

//Get Varibles for Friending
$userid = $_GET['id'];
$myuserid = $_SESSION['userid'];

//Get Info about this user
$userinfoquery="SELECT * FROM userinfo WHERE userid='$userid'";
$userinforesult = mysql_query($userinfoquery);
$userinfo = mysql_fetch_assoc($userinforesult);
$fname =  $userinfo['fname'];
$lname =  $userinfo['lname'];
echo "<head>
<script type=\"text/javascript\" src=\"dynamic.js\"></script>
<link href=\"bootstrap.css\" type=\"text/css\" rel=\"stylesheet\">
<link href=\"css/feed.css\" type=\"text/css\" rel=\"stylesheet\">
</head>
 <body style=\"background-color:black;\">";
if (isset($userinfo['defaultpicid']))
{
	$picid = $userinfo['defaultpicid'];
	$picinfoquery = "SELECT ext,width,height FROM pictures WHERE id = '$picid';";
	$result=mysql_query($picinfoquery,$conc) or die("Unable to insert pictureinfo into db");
	
	$picinfo = mysql_fetch_assoc($result);
	$ext = $picinfo['ext'];
	$width = $picinfo['width'];
	$height = $picinfo['height'];
	$picturelocation = "profilepics/$picid.$ext";
	echo "<img style=\"float: top;width:200px;max-height:200px;border-radius:20px;margin-left:40px;margin-top:40px;border:1px solid orange;padding:5px;\" src=\"$picturelocation\"";
	if ($width > 200)
    {
    $newwidth=200;
	$height=($height/$width)*$newwidth;
	$width = $newwidth;
	echo "$newwidth";
	}
	echo "width=\"$width\" height=\"$height\" alt=\"$fname $lname's Profile Picture\" />";
    echo "<p style=\"display:inline-block;margin-left:40px;font-size:40px;color:orange;position:absolute;margin-top:60px;margin-bottom:20px;\">$fname $lname</p>";
}
//echo "
//<!---Alert Area--->
//<table id=\alertarea\" align=\"right\"><tbody>
//<tr><td><br/>";

//echo "</td></tr><tr><td>
//</script>
//<span id='friendslist'></span>
//</td></tr>
//</tbody></table>
//<!--- End of Alert Area--->

?>
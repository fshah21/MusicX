<?php
session_start();
include("config.php");

$userid = $_SESSION['userid'];
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
	echo "<a href=\"uploadprofilepic.php\"><img style=\"float: top;width:200px;max-height:200px;border-radius:20px;margin-left:40px;margin-top:40px;border:1px solid orange;padding:5px;\" src=\"$picturelocation\"";
	if ($width > 200)
    {
    $newwidth=200;
	$height=($height/$width)*$newwidth;
	$width = $newwidth;
	echo "$newwidth";
	}
	echo "width=\"$width\" height=\"$height\" alt=\"$fname $lname's Profile Picture\" /></a>";
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
echo "<div class=\"row\">
<div class=\"col-md-2\" style=\"background-color:black;height:100%;margin-top:50px;\">
<p style=\"color:white;\">My Posts</p>
<p><a href=\"myfriends.php\" style=\"color:orange;\">Friends</a></p>
<p><a href=\"stream.html\" style=\"color:orange;\">Stream</a></p>
</div>
<div class=\"col-md-10\" style=\"background-color:black;height:100%;margin-top:50px;\">
<h1 style=\"display:inline-block;margin-left:80px;color:orange;font-size:30px;text-decoration:underline;\">Say Something ...</h1><form method=\"post\" action=\"feedpost.php\" name=\"dispatches\" onsubmit=\"return validateDispatches()\">
<textarea style=\"display:block;margin-left:auto;margin-right:auto;\" name=\"dispatch\" cols=\"100\" rows=\"3\">
</textarea><br>
<input id=\"but1\" style=\"margin-left:800px;display:inline !important;\" type=\"submit\" value=\"Post\"/>
</form>
<h1 style=\"margin-left:80px;color:orange;font-size:30px;text-decoration:underline;\">My Stream</h1>
<div class=\"col-md-12\" style=\"background-color:black;height:100%;margin-left:200px;\">
<span id='thefeed'>
</span>
</div>
</div>
<script type = \"text/javascript\">
window.onload = function() 
{
pullTheFeed($userid);
}
</script>
</div>";
?>

<!--<script>
alert("Hello");
</script>-->

    



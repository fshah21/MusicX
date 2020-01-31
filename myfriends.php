<?php

//Include MySQL config info
include("config.php");
//Kick out users who are not logged in
//include("authen.php");
session_start();
$userid = $_SESSION['userid'];
echo "<head>
<link href=\"bootstrap.css\" type=\"text/css\" rel=\"stylesheet\">
<link href=\"css/feed.css\" type=\"text/css\" rel=\"stylesheet\">
<script type=\"text/javascript\" src=\"dynamic.js\"></script>
</head>
 <body style=\"background-color:black\">";
$userid = $_SESSION['userid'];
$userinfoquery="SELECT * FROM userinfo WHERE userid='$userid'";
$userinforesult = mysql_query($userinfoquery);
$userinfo = mysql_fetch_assoc($userinforesult);
$fname =  $userinfo['fname'];
$lname =  $userinfo['lname'];
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
echo "<div class=\"row\">
<div class=\"col-md-2\" style=\"background-color:black;height:100%;margin-top:50px;\">
<p><a href=\"feed.php\" style=\"color:orange\">My Posts</a></p>
<p style=\"color:white\">Friends</p>
<p><a href=\"stream.html\" style=\"color:orange;\">Stream</a></p>
</div>
<div class=\"col-md-10\" style=\"background-color:black;height:100%;margin-top:50px;\">
<div class=\"col-md-3\">
<h1 style=\"display:inline-block;margin-left:80px;color:orange;font-size:30px;text-decoration:underline;\">My Friends</h1></div>";

echo "<div class=\"col-md-9\"><div id=\"uniCenterSearchBox\" style=\"margin-left:300px;margin-top:30px;\">
		<form id=\"uniSearchBox\" action=\"searchfr.php\" name=\"navsearch\" onsubmit=\"return searchValidate()\" method=\"get\">
		<input style=\"background-color:black;border: 2px solid orange;border-radius:12px; color:white; font-size:20px; width:200px;\" type=\"text\" name=\"query\" id=\"query\" size=\"40\" value=\"\"> 
		<input type=\"submit\" style=\"padding: 2px 2px;
        margin-left:5px;
    font-size: 20px;
    width: 200px;
    color:orange;
    text-align: center;
    background-color: black;
    border-color:orange;
    border-radius: 15px;\" value=\"People Search\">
		</form>
	</div></div>";
//Start printing the page
//include("header.php"); //Universal Start of Page
echo "
<div style=\"margin-left:100px;position:absolute;margin-top:100px;\">
<span id='friendslist'></span></div>
<script type = \"text/javascript\">
window.onload = function() 
{

printFriendsPageList($userid);
}
</script>";
echo "<script type=\"text/javascript\" src=\"friendship.js\"> </script>";

//Include MySQL config info

//Kick out users who are not logged in
 //Universal Start of Page

$userid = $_SESSION['userid'];
$requestsquery="SELECT * FROM relations WHERE userid1='$userid' and relation='0';";
$requestsresult=mysql_query($requestsquery) or die('Unable to check for requests');
$numberofrequests = mysql_num_rows($requestsresult);
if ($numberofrequests)
{
		 echo "<h1 style=\"color:orange;margin-top:300px;position:relative;\">You have $numberofrequests Request(s)!</h1><table id='requeststable' class='requesttable'><tr>";
		 while ($row = mysql_fetch_assoc($requestsresult)) 
		{
			//Get Info about this user
		$requesterid =  $row["userid2"];
		$requesterquery="SELECT * FROM userinfo WHERE userid='$requesterid'";
		$requesterresult=mysql_query($requesterquery) or die("Unable to query for user!");
		$requesterinfo = mysql_fetch_assoc($requesterresult);	
	
		//Check whether query was successful or not
		$fname = $requesterinfo['fname'];
		$lname = $requesterinfo['lname'];
		
		//Print Table Content
		echo "<tr><td><h3 style=\"margin-right:50px;\"><a href='profile.php?id=$requesterid' 'alt='$fname $lname's Profile'>$fname $lname</a></h3><td>";
    	echo "<button type=\"button\" style=\"font: 24px ; background-color:black; color:orange;font-size:20px; margin-top:20px;marign-left:30px;margin-right:20px;\"  onclick=\"window.location = 'addfr.php?id=$requesterid';\">Approve</button> <button type=\"button\" style=\"font: 24px ; background-color:black; color:orange;font-size:20px; margin-top:20px;marign-left:30px;margin-right:20px;\"  onclick=\"window.location = 'deletefr.php?id=$requesterid';\">Deny</button></td></tr>";
		}
		echo "</table>";
}

while ($row = mysql_fetch_assoc($requestsresult)) {
    echo $row["userid"];
    echo $row["fullname"];
    echo $row["userstatus"];
}


//Print off the Universal Footer of the page

?>
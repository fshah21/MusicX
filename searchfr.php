<?php
//Include MySQL config info
session_start();

//Kick out users who are not logged in
//include("authen.php");
include("config.php");
//Check to see if user exists
$query = $_GET['query'];

//include("header.php"); //Universal Start of Page

include("friending.php");
// echo "<br/><br/><br/>";

$queryterms = explode(" ",$query);
$myuserid = $_SESSION['userid'];
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
<p>My Posts</p>
<p style=\"color:white\">Friends</p>
<p>Recommendations</p>
<p>My Profile</p>
<p>Stream</p>
<p>Notifications</p>
</div>
<div class=\"col-md-10\" style=\"background-color:black;height:100%;margin-top:50px;\">
<div class=\"col-md-12\">
<h1 style=\"display:inline-block;margin-left:80px;color:orange;font-size:30px;\">Search Results for $query</h1></div>";
switch (count($queryterms))
{
	case 0:
	{
		echo "<hl>Please enter some search terms!<h1>";
	}
		break;
	case 1:
	{
		$searchterm = $queryterms[0];
		$searchquery="SELECT * FROM userinfo WHERE (fname='$searchterm') OR (lname='$searchterm');";
		$searchresult=mysql_query($searchquery) or die("Unable to search DB!");
		$numberofresults = mysql_num_rows($searchresult);
		if ($numberofresults)
		{
		 echo "<table style=\"margin-left:200px;width:500px;\" id='searchresults' class='searchresults' ><tr>";
		 while ($row = mysql_fetch_assoc($searchresult)) 
				{
					//Get Info about this user
					$friendid =  $row["userid"];
		
					//Info about user
					$fname = $row['fname'];
					$lname = $row['lname'];
		
					//Print Table Content
					echo "<tr><td><h3><a href='profile.php?id=$friendid' 'alt='$fname $lname's Profile'>$fname $lname</a></h3></td>";
					if(isset($row['city']))
					{
						echo $row['city'];
						echo ", ";
						echo $row['state'];
					}
					echo "<td>";
					$f = friendStatus($friendid,$myuserid);
					displayrelationoptions($f, $friendid);
					echo "</td></tr>";
					}
		echo "</table>";
		}
		else echo "<h1 style=\"margin-left:200px;color:white;font-size:20px;\">No Results</h1>";
	}
		break;
	case 2:
	{
		$searchterm1 = $queryterms[0];
		$searchterm2 = $queryterms[1];
		$searchquery="SELECT * FROM userinfo WHERE (fname='$searchterm1') AND (lname='$searchterm2');";
		$searchresult=mysql_query($searchquery) or die("Unable to search DB!");
		$numberofresults = mysql_num_rows($searchresult);
		if ($numberofresults)
		{
		 echo "<table style=\"margin-left:200px;width:500px;\" id='searchresults' class='searchresults'><tr>";
		 while ($row = mysql_fetch_assoc($searchresult)) 
				{
					//Get Info about this user
					$friendid =  $row["userid"];
		
					//Info about user
					$fname = $row['fname'];
					$lname = $row['lname'];
		
					//Print Table Content
					echo "<tr><td><h3><a id=$friendid' 'alt='$fname $lname's Profile'>$fname $lname</a></h3></td>";
					if(isset($row['city']))
					{
						echo $row['city'];
						echo ", ";
						echo $row['state'];
					}
					echo "<td>";
					$f = friendStatus($friendid,$myuserid);
					displayrelationoptions($f, $friendid);
					echo "</td></tr>";
					}
		echo "</table>";
		}
		else echo "<h1>No Results</h1>";
	}
		break;		
}
echo "</div>"
//Print off the Universal Footer of the page
//include ("footer.php");
?>
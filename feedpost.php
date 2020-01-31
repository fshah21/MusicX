<?php
session_start();

###Connect to database###
include("config.php");

$userid = $_SESSION['userid'];
$content = mysql_real_escape_string($_POST['dispatch']); //fix to make sure query is not messed up
$userinfoquery="SELECT * FROM userinfo WHERE userid='$userid'";
$userinforesult = mysql_query($userinfoquery);
$userinfo = mysql_fetch_assoc($userinforesult);
/*if(isset($_GET['recipient']))
{
	//The user is posting on another's wall
	$recipient = intval($_GET['recipient']);
	$sql = "INSERT into messages(userid,recipientid,content) values('$userid','$recipient','$content')";	
	$result=mysql_query($sql,$conc) or die("Unable to insert your posting to $recipient into db");
	//header("location: feed.php");
}
else
{
	//This means the user is posting a status
    */$name = $userinfo['fname'];
	$recipient = intval($name);
	$sql = "INSERT into messages(userid,content) values('$userid','$content')";	
	$result=mysql_query($sql,$conc) or die("Unable to insert your status into db");
	header("location: feed.php");
//printFriendsPageList($userid);
//pullUserInfo($userid);
//}


?>
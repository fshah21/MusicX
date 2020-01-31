<?php
function loginfailed()
{
		//include("header.php"); //Begining of page. Constructs page header and starts body table
		echo "<h2 align=\"center\" class=\"err\">Login Failed!<h2><h1>Please login or register.</h1>";
		//include ('regform.php'); //The Registration Form
		//include ('footer.php');  //Universal site footer
}


	//Include config info
	include('config.php');
	
	//Get Password
	$email = $_POST['email'];
	$password = $_POST['password'];
    echo $email;
    echo $password;

	//Validate Login Input
	if($email == '' || $password == '') {
		loginfailed();
		exit();
	}
    $query="SELECT * FROM login WHERE email='$email' AND password='$password'";
	$result=mysql_query($query);
	
	//Check whether login was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_start();//Start Session
			$user = mysql_fetch_assoc($result);
			$_SESSION['userid'] = $user['userid'];
			session_write_close();
			header("location: feed.php");
            echo "Logged In";
			exit();
		}else {
			//Login failed
			loginfailed();
	//		header("location: error.php");
			exit();
		}
	}else {
		die("Query failed");
	}


?>

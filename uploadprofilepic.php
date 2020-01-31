<?php
include("config.php");

 //Universal Start of Page
echo '<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>';
echo '<script src="js/jquery-2.2.3.min.js"></script>';
echo "<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>";
echo '<link href="bootstrap.css" type="text/css">';
echo '<link href="css/uploadprofilepic.css" type="text/css" rel="stylesheet">';
echo "<body style=\"background-color:black;\"><h1>Change Your Profile Picture Here !</h1> 
		  <div class=\"login-w3top\">
              
                <div class=\"now playing\" id=\"music\" style=\"margin-top:100px;\">
                  <span class=\"bar n1\">A</span>
                  <span class=\"bar n2\">B</span>
                  <span class=\"bar n3\">c</span>
                  <span class=\"bar n4\">D</span>
                  <span class=\"bar n5\">E</span>
                  <span class=\"bar n6\">F</span>
                  <span class=\"bar n7\">G</span>
                  <span class=\"bar n8\">H</span>
                </div>
    </div>
    <div class=\"mainw3-agileinfo form\"> 
			<div id=\"login\">
<form action=\"changeprofilepicture.php\" method=\"post\"
enctype=\"multipart/form-data\">
<div class=\"field-wrap\">
<label for=\"file\" style=\"margin-top:20px;font-size:20px;\">Choose Picture Here:</label>
<input type=\"file\" name=\"file\" id=\"file\" / style=\"margin-top:60px;margin-left:50%;width:50%;color:orange;\"> 
<br />
</div>
<input type=\"submit\" name=\"submit\" value=\"Upload Profile Picture\" class=\"button button-block\" />
</form>
</body>
";
?>
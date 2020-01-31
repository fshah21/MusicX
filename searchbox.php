<?php
session_start();
include("config.php");
echo "<div id=\"uniCenterSearchBox\">
		<form id=\"uniSearchBox\" action=\"searchfr.php\" name=\"navsearch\" onsubmit=\"return searchValidate()\" method=\"get\">
		<input type=\"text\" name=\"query\" id=\"query\" size=\"40\" value=\"\"> 
		<input type=\"submit\" value=\"People Search\">
		</form>
	</div>";
?>
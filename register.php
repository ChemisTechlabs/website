<?php

include("functions.php");

echo "<!DOCTYPE html>
	<html lang=\"en\">
	    <head>
	        <title>Member Registration Page</title>
	        <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />
	        <meta charset=\"utf-8\">
	        <!--Css-->    
	        <link href=\"css/style.css\" rel=\"stylesheet\"> 
	        <link rel=\"shortcut icon\" href=\"css/favicon.ico\"> 
	        <!--java-->
	        <script src=\"js/jquery.js\"></script>
	        <script src=\"js/bootstrap.js\"></script>           
	    </head>";

echo "<center><a href=\"index.php\"><img src=\"img/logo.png\"></a></center><div class=\"login\">";

if(!isset($_POST[submit])) {

	echo "<form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
	<a href=\"login.php\" class=\"pull-right\">Login</a>
	   <h2>Register</h2>
       <h5>First Name</h5>
	    <input type=\"text\" name=\"fname\">
	    <h5>Last Name</h5>
		<input type=\"text\" name=\"lname\">
	   <h5>Username</h5>
		<input type=\"text\" name=\"username\">
	   <h5>Password</h5>
		<input type=\"password\" name=\"password\">
	    <h5>Retype Password</h5>
		<input type=\"password\" name=\"verify\">
	    <h5>Email Address</h5>
		<input type=\"text\" name=\"email\">
	  	<input type=\"submit\" class=\"btn btn-large btn-block btn-info\" name=\"submit\" value=\"submit\">";

} else if(isset($_POST[submit]) && empty($_POST[fname]) or empty($_POST[lname]) or empty($_POST[username]) or empty($_POST[password]) or empty($_POST[verify]) or empty($_POST[email])) {

		echo "<span class=\"label label-important\">Please enter all fields in the form</span>
		<form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
	<a href=\"login.php\" class=\"pull-right\">Login</a>
	   <h2>Register</h2>
       <h5>First Name</h5>
	    <input type=\"text\" name=\"fname\">
	    <h5>Last Name</h5>
		<input type=\"text\" name=\"lname\">
	   <h5>Username</h5>
		<input type=\"text\" name=\"username\">
	   <h5>Password</h5>
		<input type=\"password\" name=\"password\">
	    <h5>Retype Password</h5>
		<input type=\"password\" name=\"verify\">
	    <h5>Email Address</h5>
		<input type=\"text\" name=\"email\">
	  	<input type=\"submit\" class=\"btn btn-large btn-block btn-info\" name=\"submit\" value=\"submit\">";

} else if(isset($_POST[submit]) && !empty($_POST[fname]) && !empty($_POST[lname]) && !empty($_POST[username]) && !empty($_POST[password]) && !empty($_POST[verify]) && !empty($_POST[email])) {

	//once all fields are in, must check a few constraints
	//check for existing username
	//usernames should be at least 6 characters in length, but less than 15
	//password should be at least 8 characters in length
	//passwords need to be the same
	//email must be valid

	if(db_num("$users_table","username='".$_POST[username]."'") == "1") {
		$error[] = "This username already exists";
	}
	if(!checkEmail($_POST[email])) {
		$error[] = "Please enter a valid email address";
	}
	if(strlen($_POST[username]) < 6 || strlen($_POST[username]) > 15) {
		$error[] = "The username must be between 6 and 15 characters in length";
	}
	if(strlen($_POST[password]) < 8) {
		$error[] = "The password needs to be at least 8 charactres in length";
	}
	if($_POST[password] != $_POST[verify]) {
		$error[] = "The passwords you entered don't match";
	}

	if(count($error) > 0) {
		echo "<span class=\"label label-important\">The following errors have occured while processing your member registration:<ul>";

			for($x = 0; $x < count($error); $x++) {
				echo "<li>".$error[$x]."</li>";
			}
			echo "</ul></span><p align=\"center\"><a href=\"".$_SERVER[PHP_SELF]."\">Please try again</a>";

	} else if(count($error) < 1) {

		$result = @mysql_query("INSERT INTO $users_table VALUES ('','".$_POST[username]."','".md5($_POST[password])."','".$_POST[fname]."','".$_POST[lname]."','".$_POST[email]."','1','".time()."')");

		echo "<h3>Username successfully added!</h3>
			Thank you for signing up with the username <b>$_POST[username].<a href=\"http://".$_SERVER[SERVER_NAME]."\"><br><center>Return to the homepage</a>";

	}

}


?>
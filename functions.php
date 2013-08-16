<?php
include "dbinit.php";
session_start();
ob_start();
function isLoggedIn() {
$user = $_SESSION[$sess_name];
	global $sess_name;

	// check if session is intact
	if(isset($_SESSION[$sess_name])) {
		return true;
	} else {
		return false;
	}
}

function db_connect() {

	global $db_host, $db_user, $db_pass, $db_name;
	mysql_connect($db_host, $db_user, $db_pass);
	mysql_select_db($db_name);

}
db_connect();
$user = $_SESSION[$sess_name];
function show_login() {

	global $users_table, $sess_name;

	// if user is not logged in, show the login form
	    
//Head
	echo "<!DOCTYPE html>
 <html lang=\"en\">
     <head>
         <title>Member Login Page</title>
         <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />
          <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
         <meta charset=\"utf-8\">
         <!--Css-->    
         <link href=\"css/style.css\" rel=\"stylesheet\"> 
         <link rel=\"shortcut icon\" href=\"css/favicon.ico\"> 
         <!--java-->
          <script src=\"js/jquery.js\"></script>
          <script src=\"js/bootstrap.js\"></script>           
      </head>"; 
      	    
	if($_GET[action] == "logout") {
		logout();
	}

	if(!isLoggedIn()) {
		// add header function if prefer
		echo "<center><a href=\"index.php\"><img src=\"img/logo.png\" class=\"img-responsive\"></a></center><div class=\"row\">
<div class=\"col-md-3 col-md-offset-5\"><div class=\"panel\">";		
		if(!isset($_POST[submit])) {
			echo "<form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
			<a href=\"join.php\" class=\"pull-right\">Registration</a>
			 <h2>Login</h2>
          <h5>User name</h5>
			    <input type=\"text\" name=\"username\"  placeholder=\"Username\">
			 <h5>Password</h5>
				<input type=\"password\" name=\"password\" placeholder=\"Password\">
				<br>										
			  <input type=\"submit\" class=\"btn btn-success\" name=\"submit\" value=\"Submit\"></div></div>";
			// add footer function here
			die();
		} else if(isset($_POST[submit]) && empty($_POST[username]) or empty($_POST[password])) {
			// add header function here
			echo "<span class=\"label label-danger\">Please enter a username/password to login</span><form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
			<a href=\"join.php\" class=\"pull-right\">Registration</a>
			 <h2>Login</h2>
          <h5>User name</h5>
			    <input type=\"text\" name=\"username\"  placeholder=\"Username\">
			 <h5>Password</h5>
				<input type=\"password\" name=\"password\"  placeholder=\"Password\">	
				<br>									
			  <input type=\"submit\" class=\"btn btn-success\" name=\"submit\" value=\"Submit\">";	
			die();
		} else if(isset($_POST[submit]) && !empty($_POST[username]) && !empty($_POST[password])) {
			// Validate their login
			$result = @mysql_query("SELECT * FROM $users_table WHERE username='".$_POST[username]."' AND password='".md5($_POST[password])."'");
			if(mysql_num_rows($result) < 1) {
				//not in database
				// add header function here
				echo "<span class=\"label label-danger\">Invalid username or password combination</span><form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
			<a href=\"join.php\" class=\"pull-right\">Registration</a>
			 <h2>Login</h2>
          <h5>User name</h5>
			    <input type=\"text\" name=\"username\" placeholder=\"Username\">
			 <h5>Password</h5>
				<input type=\"password\" name=\"password\" placeholder=\"Password\">	
				<br>									
			  <input type=\"submit\" class=\"btn btn-success\" name=\"submit\" value=\"Submit\">";
				die();
			} else {
				//entered correct, create session and refresh page
				$_SESSION[$sess_name] = $_POST[username];
				header("Location: /");
			}

		}

	}

}

function logout() {

	global $sess_name;

	unset($_SESSION[$sess_name]);
	session_destroy();

	header("Location: http://".$_SERVER[SERVER_NAME]."");

}

function isAdmin() {

	global $users_table, $sess_name;
	
	//once user is logged in, check their "PRIV" value
	//PRIV < 10 is regular admin
	//PRIV >= 10 is an Chemis

	$result = @mysql_query("SELECT priv FROM $users_table WHERE username='".$_SESSION[$sess_name]."'");
	$row = mysql_fetch_array($result);
	if($row[priv] < 10) {
		//regular user
		return false;
	} else if($row[priv] >= 10) {
		//is an admin
		return true;
	}
}

function checkEmail($email){
    return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
}

function db_field($field, $table, $condition) {
	$result = @mysql_query("SELECT $field FROM $table WHERE $condition");
	$row = mysql_fetch_array($result);
	return $row[$field];
}

function db_num($table, $condition) {
	$result = @mysql_query("SELECT * FROM $table WHERE $condition");
	return mysql_num_rows($result);
}
?>
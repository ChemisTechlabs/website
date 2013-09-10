<?php
include "dbinit.php";
session_start();
ob_start();

// Username
$user = $_SESSION[$sess_name];

function isLoggedIn() {

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

function show_login() {

	global $users_table, $sess_name;

	// if user is not logged in, show the login form
	    
//Head
	include "head.php";
      	    
	if($_GET[action] == "logout") {
		logout();
	}

	if(!isLoggedIn()) {		
		echo "<div class=\"container\"><center><a href=\"index.php\"><img src=\"../img/logo.png\" class=\"img-responsive\"></a></center><div class=\"row\">
<div class=\"col-md-3 col-md-offset-5\">";	
		if(!isset($_POST[submit])) {
			echo "<form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
			<a href=\"../join.php\" class=\"pull-right\">Registration</a>
			 <h2>Login</h2>
             <h5>User name</h5>
			    <input type=\"text\" name=\"username\" class=\"form-control\" placeholder=\"Username\">
			 <h5>Password</h5>
				<input type=\"password\" name=\"password\" class=\"form-control\" placeholder=\"Password\">
				<br>										
			  <input type=\"submit\" class=\"btn btn-large btn-outline btn-block\" name=\"submit\" value=\"Submit\"></div></div>";
			include 'foot.php';
			die();
		} else if(isset($_POST[submit]) && empty($_POST[username]) or empty($_POST[password])) {
	  echo "<span class=\"label label-danger\">Please enter a username/password to login</span><form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
			<a href=\"../join.php\" class=\"pull-right\">Registration</a>
			 <h2>Login</h2>
             <h5>User name</h5>
			    <input type=\"text\" name=\"username\" class=\"form-control\" placeholder=\"Username\">
			 <h5>Password</h5>
				<input type=\"password\" name=\"password\" class=\"form-control\"  placeholder=\"Password\">	
				<br>									
			  <input type=\"submit\" class=\"btn btn-large btn-outline btn-block\" name=\"submit\" value=\"Submit\"></div></div>";
          include 'foot.php';
			die();
		} else if(isset($_POST[submit]) && !empty($_POST[username]) && !empty($_POST[password])) {
			// Validate their login
			$result = @mysql_query("SELECT * FROM $users_table WHERE username='".$_POST[username]."' AND password='".md5($_POST[password])."'");
			if(mysql_num_rows($result) < 1) {
			//not in database		
	 echo "<span class=\"label label-danger\">Invalid username or password combination</span><form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
			<a href=\"../join.php\" class=\"pull-right\">Registration</a>
			 <h2>Login</h2>
             <h5>User name</h5>
			    <input type=\"text\" name=\"username\" class=\"form-control\" placeholder=\"Username\">
			 <h5>Password</h5>
			  <input type=\"password\" name=\"password\" class=\"form-control\" placeholder=\"Password\">	
				<br>									
			  <input type=\"submit\" class=\"btn btn-large btn-outline btn-block\" class=\"form-control\" name=\"submit\" value=\"Submit\"></div></div>";
          include 'foot.php';
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

function offline() {

	global $settings_table;
	
	//Offline or online status site
	//status = online - online 
	//status = ofline - offline 
	//hahahahahahahhahahahahaah
	
	$result = @mysql_query("SELECT value FROM $settings_table WHERE id='1'");
	$row = mysql_fetch_array($result);
	if($row[value] == "offline") {
	  return false;
	} else if($row[value] == "online") {
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

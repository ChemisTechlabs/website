<?php
include("../functions.php");

// check for $_SESSION[$sess_name];

if(isset($_SESSION[$sess_name])) {
	// if session is valid log user out
	// use unset to null the variable
	unset($_SESSION[$sess_name]);
	session_destroy();
	if($redir != "") {
		header("Location: $redir");
	} else {
		echo "<h1>You are logged out</h1>";
	}
} else {
	// if not logged in, redirect back to homepage
	header("Location: http://".$_SERVER[HTTP_HOST]."");
}
?>
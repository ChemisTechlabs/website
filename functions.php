<?php
<<<<<<< HEAD
$users_table = "users";

// mysql settings
$db_host = "localhost";
$db_user = "lomuz";
$db_pass = "199816";
$db_name = "chemis";

$sess_name = "chemis_user"; 
$path_to = "/"; 

$redir = "/"; 

session_start();
ob_start();
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
	
	echo "<!DOCTYPE html>
	<html lang=\"en\">
	    <head>
	        <title>Member Login Page</title>
	        <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />
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
		echo "<center><a href=\"index.php\"><img src=\"img/logo.png\"></a></center> 
		<div class=\"login\">";
		if(!isset($_POST[submit])) {
			echo "<form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
			<a href=\"join.php\" class=\"pull-right\">Registration</a>
			 <h2>Login</h2>
          <h5>User name</h5>
			    <input type=\"text\" name=\"username\">
			 <h5>Password</h5>
				<input type=\"password\" name=\"password\">
			  <input type=\"submit\" class=\"btn btn-large btn-block btn-info\" name=\"submit\" value=\"submit\">";
			// add footer function here
			die();
		} else if(isset($_POST[submit]) && empty($_POST[username]) or empty($_POST[password])) {
			// add header function here
			echo "<span class=\"label label-important\">Please enter a username/password to login</span><form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
			<a href=\"join.php\" class=\"pull-right\">Registration</a>
			 <h2>Login</h2>
          <h5>User name</h5>
			    <input type=\"text\" name=\"username\">
			 <h5>Password</h5>
				<input type=\"password\" name=\"password\">
			  <input type=\"submit\" class=\"btn btn-large btn-block btn-info\" name=\"submit\" value=\"submit\">";			
			die();
		} else if(isset($_POST[submit]) && !empty($_POST[username]) && !empty($_POST[password])) {
			// Validate their login
			$result = @mysql_query("SELECT * FROM $users_table WHERE username='".$_POST[username]."' AND password='".md5($_POST[password])."'");
			if(mysql_num_rows($result) < 1) {
				//not in database
				// add header function here
				echo "<span class=\"label label-important\">Invalid username or password combination</span><form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
			<a href=\"join.php\" class=\"pull-right\">Registration</a>
			 <h2>Login</h2>
          <h5>User name</h5>
			    <input type=\"text\" name=\"username\">
			 <h5>Password</h5>
				<input type=\"password\" name=\"password\">
			  <input type=\"submit\" class=\"btn btn-large btn-block btn-info\" name=\"submit\" value=\"submit\">";
				die();
			} else {
				//entered correct, create session and refresh page
				$_SESSION[$sess_name] = $_POST[username];
				header("Location: index.php");
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

=======

function connectToDB() {
    global $link, $dbhost, $dbuser, $dbpass, $dbname;
    ($link = mysql_pconnect("$dbhost", "$dbuser", "$dbpass")) || die("Couldn't connect to MySQL");
    mysql_select_db("$dbname", $link) || die("Couldn't open db: $dbname. Error if any was: " . mysql_error());
}

function newUser($login, $password) {
    global $link;
    $password = md5(md5($password));

    $query = "INSERT INTO users (login, password) VALUES('$login', '$password')";
    $result = mysql_query($query,$link) or die("Died inserting login info into db.  Error returned if any: " . mysql_error());

    return true;
}
//Then do not touch, running exclusively on magic
//Дальше не трогать, работает исключительно на магии 

function changePassword($oldPassword, $newPassword, $username) {
    global $link;
    
    $oldPassMd5 = md5(md5($oldPassword));
    $newPassMd5= md5(md5($newPassword));
    
    $result = mysql_query("select * from users where login='$username' and password='$oldPassMd5'",$link) or die ("Error in query: $query " . mysql_error());
    $row=  mysql_fetch_array($result);
    
    if(mysql_num_rows($row)>0) {
            mysql_query("update users set password='$newPassMd5' where id=".$row['id']."",$link) or die ("Error in query: $query " . mysql_error());
            return true;
    }else{
        return false;
    }
}
//Don't touch it too... It's another magic running...
//Não toque nisso também... Isso é outra mágica funcionando...

function displayErrors($messages) {
    print("<span class=\"label label-important\"><b>Following errors occurred:</b>\n<ul>\n");

    foreach ($messages as $msg) {
        print("<li>$msg</li>\n");
    }
    print("</ul>\n");
}

function checkLoggedIn($status) {
    switch ($status) {
        case "yes":
            if (!isset($_SESSION["loggedIn"])) {
                header("Location: login.php");
                exit;
            }
            break;
        case "no":
            if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true) {
                header("Location: index.php");
            }
            break;
    }
    return true;
}

function checkPass($login, $password) {
    global $link;
    $password = md5(md5($password));

    $query = "SELECT login, password FROM users WHERE login='$login' and password='$password'";
    $result = mysql_query($query, $link) or die("checkPass fatal error: " . mysql_error());

    if (mysql_num_rows($result) == 1) {
        $row = mysql_fetch_array($result);
        return $row;
    }
    return false;
}

function cleanMemberSession($login, $password) {
    $_SESSION["login"] = $login;
    $_SESSION["password"] = md5(md5($password));
    $_SESSION["loggedIn"] = true;
}

function flushMemberSession() {
    unset($_SESSION["login"]);
    unset($_SESSION["password"]);
    unset($_SESSION["loggedIn"]);
    session_destroy();
    return true;
}

function field_validator($field_descr, $field_data, $field_type, $min_length = "", $max_length = "", $field_required = 1) {

    global $messages;

    if (!$field_data && !$field_required) {
        return;
    }

    $field_ok = false;

    $email_regexp = "^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|";
    $email_regexp.="(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$";

    $data_types = array(
        "email" => $email_regexp,
        "digit" => "^[0-9]$",
        "number" => "^[0-9]+$",
        "alpha" => "^[a-zA-Z]+$",
        "alpha_space" => "^[a-zA-Z ]+$",
        "alphanumeric" => "^[a-zA-Z0-9]+$",
        "alphanumeric_space" => "^[a-zA-Z0-9 ]+$",
        "string" => ""
    );

    if ($field_required && empty($field_data)) {
        $messages[] = "Field $field_descr is a must";
        return;
    }

    if ($field_type == "string") {
        $field_ok = true;
    } else {
        $field_ok = ereg($data_types[$field_type], $field_data);
    }

    if (!$field_ok) {
        $messages[] = "Please enter normal $field_descr";
        return;
    }

    if ($field_ok && ($min_length > 0)) {
        if (strlen($field_data) < $min_length) {
            $messages[] = "$field_descr must be at least $min_length characters.";
            return;
        }
    }

    if ($field_ok && ($max_length > 0)) {
        if (strlen($field_data) > $max_length) {
            $messages[] = "$field_descr must not be longer $max_length characters.";
            return;
        }
    }
}

>>>>>>> b89a5511b03398226e31831e2ad6605c3aaadaf6
?>
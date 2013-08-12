<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin-Chemis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta name="author" content="Никита Бережной" >
    <!--Css-->    
    <link href="../css/style.css" rel="stylesheet">     
    <link rel="shortcut icon" href="../css/favicon.ico">
     <!--java-->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>    
  </head>
<body>
<img src="../img/logo.png" alt="logo">	
<div class="navbar hidden-phone hidden-tablet">
<div class="navbar-inner">
<ul class="nav" style="top: 50%;left: 35%;">    
 <li class="divider-vertical"></li>
 <li><a href="../">Site</a></li>
 <li class="divider-vertical"></li>
 <li><a href="add.php">Add log</a></li>
 <li class="divider-vertical"></li>
 <li><a href="users.php">Users</a></li>
 <li class="divider-vertical"></li>
 <li><a href="logout.php">Exit</a></li>
 </ul>
 </div>
 </div>
<div class="navbar navbar-fixed-top hidden-desktop">
<div class="navbar-inner">
<div class="container">
<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<div class="nav-collapse collapse">
<ul class="nav">
    <li class="divider-vertical"></li>
    <li><a href="../">Site</a></li>
    <li class="divider-vertical"></li>
    <li><a href="add.php">Add log</a></li>
    <li class="divider-vertical"></li>
    <li><a href="users.php">Users</a></li>
    <li class="divider-vertical"></li>
    <li><a href="logout.php">Exit</a></li>
</ul>
</div>
</div>
</div>
</div>
<?php
include("../functions.php"); 
 if(!isLoggedIn()) {
	show_login();
} else {

	if(!isAdmin()) {

		//user is logged in but a regular user
		echo "<h2 align=\"center\">Sorry, this page is for administrators only</h2>";

	} else {
	
		if(!isset($_GET[action])) {

			echo "
			<center>
			<a href=\"".$_SERVER[PHP_SELF]."?action=add\" class=\"btn btn-success\">Add new user</a>
			</center>	
			<br>	
			<table class=\"table table-bordered\">
			<thead>
			  <tr>
				<th>User ID</th>
				<th>Username</th>
				<th>Name</th>
				<th>Email</th>
				<th>Privilege</th>
				<th>User Added</th>
				<th>Edit</th>
			  </tr>
			  </thead>
			  <tbody>";

			  $result = @mysql_query("SELECT * FROM $users_table ORDER BY id");
			  while($row = mysql_fetch_array($result)) {
				  if($row[priv] < 10) {
					  $priv = "User";
				  } else if($row[priv] >= 10) {
					  $priv = "Chemis team";
				  }
				  echo "
				   <tr>
					<td>".$row[id]."</td>
					<td>".$row[username]."</td>
					<td>".$row[fname]." ".$row[lname]."</td>
					<td>".$row[email]."</td>
					<td>$priv</td>
					<td>".date("n/j/Y",$row[time])."</td>
					<td><a class=\"btn btn-danger btn-mini\" href=\"".$_SERVER[PHP_SELF]."?action=edit&id=$row[0]\">Edit</a></td>
				  </tr>";
			  }
			  echo "</tbody></table>";

		} else if($_GET[action] == "add") {

			echo "<h3 align=\"center\">Add a new Member</h3>";

			if(!isset($_POST[submit])) {

				echo "<form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."?action=add\">
				<center>
				<table align=\"center\">
				  <tr>
					<td colspan=2>Please fill out the form below to register for this site.</td>
				  </tr>
				  <tr>
					<td colspan=>&nbsp;</td>
				  </tr>
				  <tr>
					<td>First Name</td>
					<td><input type=\"text\" name=\"fname\"></td>
				  </tr>
				  <tr>
					<td>Last Name</td>
					<td><input type=\"text\" name=\"lname\"></td>
				  </tr>
				  <tr>
					<td>Username</td>
					<td><input type=\"text\" name=\"username\"></td>
				  </tr>
				  <tr>
					<td>Password</td>
					<td><input type=\"password\" name=\"password\"></td>
				  </tr>
				  <tr>
					<td>Retype Password</td>
					<td><input type=\"password\" name=\"verify\"></td>
				  </tr>
				  <tr>
					<td>Email Address</td>
					<td><input type=\"text\" name=\"email\"></td>
				  </tr>
				  <tr>
				    <td>User Type</td>
					<td><select name=\"user_type\"><option value=\"1\" selected>Regular User</option><option value=\"10\">Chemis team</option></select></td>
				  </tr>
				  <tr>
					<td colspan=2 align=center>
					<input type=\"submit\" name=\"submit\" class=\"btn btn-danger\" value=\"submit\"></td>
				  </tr>
				</table>";

			} else if(isset($_POST[submit]) && empty($_POST[fname]) or empty($_POST[lname]) or empty($_POST[username]) or empty($_POST[password]) or empty($_POST[verify]) or empty($_POST[email])) {

				echo "<center><font color=\"red\"><b>Please enter all fields in the form</b></font></center>";

			} else if(isset($_POST[submit]) && !empty($_POST[fname]) && !empty($_POST[lname]) && !empty($_POST[username]) && !empty($_POST[password]) && !empty($_POST[verify]) && !empty($_POST[email])) {

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
					echo "<center><table>
					  <tr>
						<td>The following errors have occured while processing your member registration:<ul>";

						for($x = 0; $x < count($error); $x++) {
							echo "<li><font color=\"red\"><b>".$error[$x]."</b></font></li>";
						}
						echo "</ul></td></tr></table>
						<p align=\"center\"><a href=\"".$_SERVER[PHP_SELF]."?action=add\">Please try again</a></center>";

				} else if(count($error) < 1) {

					//constraints met, add user to database

					$result = @mysql_query("INSERT INTO $users_table VALUES ('','".$_POST[username]."','".md5($_POST[password])."','".$_POST[fname]."','".$_POST[lname]."','".$_POST[email]."','".$_POST[user_type]."','".time()."')");

					echo "<center><h3>Username successfully added!</h3>
					Thank you for signing up with the username <b>$_POST[username]</b>.</center>";

				}

			}

		} else if($_GET[action] == "edit" && isset($_GET[id])) {

			echo "<h2 align=\"center\">Edit user</h2>";

			if(!isset($_POST[submit])) {

				$result = @mysql_query("SELECT * FROM $users_table WHERE id='".$_GET[id]."'");
				$row = mysql_fetch_array($result);

				if(($row[id]==1) || ($row[username] == $_SESSION[$sess_name])) {
					// default admin account, cannot delete
					$disable = " disabled";
					$show_del = "This account cannot be deleted";
				} else {
					$disable = "";
					$show_del = "<input type=\"checkbox\" name=\"delete\" value=\"yes\"> I wish to delete this account";
				}

				echo "<form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."?action=edit&id=$_GET[id]\">
				<center>
				<table align=\"center\">
				  <tr>
					<td colspan=2>Please fill out the form below to edit this user.<p>
					<font color=\"red\">**</font> NOTE:<br>Password Not required--only if changing it</td>
				  </tr>
				  <tr>
					<td colspan=>&nbsp;</td>
				  </tr>
				  <tr>
					<td>First Name</td>
					<td><input type=\"text\" name=\"fname\" value=\"".$row[fname]."\"></td>
				  </tr>
				  <tr>
					<td>Last Name</td>
					<td><input type=\"text\" name=\"lname\" value=\"".$row[lname]."\"></td>
				  </tr>
				  <tr>
					<td>Username</td>
					<td><input type=\"text\" name=\"username\" value=\"".$row[username]."\" disabled></td>
				  </tr>
				  <tr>
					<td>Password</td>
					<td><input type=\"password\" name=\"password\"></td>
				  </tr>
				  <tr>
					<td>Retype Password</td>
					<td><input type=\"password\" name=\"verify\"></td>
				  </tr>
				  <tr>
					<td>Email Address</td>
					<td><input type=\"text\" name=\"email\" value=\"".$row[email]."\"></td>
				  </tr>
				  <tr>
				    <td>User Type</td>
					<td><select name=\"user_type\"$disable>";
					
					if($row[priv] < 10) {
						echo "<option value=\"1\" selected>Regular User</option><option value=\"10\">Chemis team</option>";
					} else if($row[priv] >= 10) {
						echo "<option value=\"1\">Regular User</option><option value=\"10\" selected>Chemis team</option>";
					}
					
					echo "</select></td>
				  </tr>
				  <tr>
				    <td colspan=2>$show_del</td>
				  </tr>
				  <tr>
					<td colspan=2 align=center>
					<input type=\"submit\" name=\"submit\" value=\"submit\"></td>
				  </tr>
				</table>";

			} else if(isset($_POST[submit]) && empty($_POST[fname]) or empty($_POST[lname]) or empty($_POST[email])) {

				echo "<center><font color=\"red\"><b>Please enter all fields in the form</b></font></center>";

			} else if(isset($_POST[submit]) && !empty($_POST[fname]) && !empty($_POST[lname]) && !empty($_POST[email])) {

				if($_POST[delete] == "yes") {
					$delete = @mysql_query("DELETE FROM $users_table WHERE id='".$_GET[id]."'");
					echo "<center><b>You successfully deleted this user account</b></center>";
				} else {
					if(!checkEmail($_POST[email])) {
						$error = "Please enter a valid email address";
					}

					if($error != "") {
						echo "<center><table>
						  <tr>
							<td>The following errors have occured while processing your member registration:<ul>";
								echo "<li><font color=\"red\"><b>".$error."</b></font></li>";						
							echo "</ul></td></tr></table>
							<p align=\"center\"><a href=\"".$_SERVER[PHP_SELF]."?action=edit&id=$row[0]\">Please try again</a></center>";

					} else if($error == "") {

						if(!empty($_POST[password])) {
							if((strlen($_POST[password]) < 8) || ($_POST[password] != $_POST[verify])) {
								echo "<center><font color=\"red\"><b>Make certain the passwords match and are at least 8 characters in length</b></font></center>";
								$continue = 0;
							} else {
								$continue = 1;
								$update = @mysql_query("UPDATE $users_table SET password='".md5($_POST[password])."' WHERE id='".$_GET[id]."'");
							}
						} else {
							$continue = 1;
						}
						if($continue) {
							if($_GET[id] == "1") {
								$add_priv = "10";
							} else {
								$add_priv = $_POST[user_type];
							}
							$update = @mysql_query("UPDATE $users_table SET fname='".$_POST[fname]."', lname='".$_POST[lname]."', email='".$_POST[email]."', priv='$add_priv' WHERE id='".$_GET[id]."'");

							echo "<center><h3>Username successfully updated!</h3>
							You successfully updated this user account.</center>";

						}

					}

				}

			}

		} else if($_GET[action] == "logout") {
			unset($_SESSION[$sess_name]);
			session_destroy();
			echo "<h3>You have successfully logged out</h3>";
		}

	}

}

if(isset($_GET[action])) {

	echo "<p align=\"center\"><a href=\"".$_SERVER[PHP_SELF]."\">Return</a>";

}

?>
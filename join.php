<?php
include_once("config.php");

checkLoggedIn("no");


if(isset($_POST["submit"])){
  field_validator("login name", $_POST["login"], "alphanumeric", 4, 15);
  field_validator("password", $_POST["password"], "string", 4, 15);
  field_validator("confirmation password", $_POST["password2"], "string", 4, 15);

  if(strcmp($_POST["password"], $_POST["password2"])) {

    $messages[]="Your passwords do not match";
  }
 
  $query="SELECT login FROM users WHERE login='".$_POST["login"]."'";

  $result=mysql_query($query, $link) or die("MySQL query $query failed.  Error if any: ".mysql_error());

  if( ($row=mysql_fetch_array($result)) ){
    $messages[]="Login \"".$_POST["login"]."\" is already taken, try another.";
  }

  if(empty($messages)) {
    newUser($_POST["login"], $_POST["password"]);

    cleanMemberSession($_POST["login"], $_POST["password"]);

    header("Location: index.php");

  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <meta charset="utf-8">
    <title>Registration Chemis</title>
    <meta name="description" content="">
    <meta name="author" content="Никита Бережной" >
    <!--Css-->    
    <link href="css/style.css" rel="stylesheet"> 
    <link rel="shortcut icon" href="css/favicon.ico">    
    </head> 
    <body> 
<center><a href="index.php"><img src="img/logo.png"></a></center>
<div class="login">
<form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="POST">
<?php
if(!empty($messages)){  displayErrors($messages);}
print("</span><br>")
?>
<a href="login.php" class="pull-right">Login</a>
<h2>Register</h2>
<h5>User name</h5>
<input type="text" name="login" value="<?php print isset($_POST["login"]) ? $_POST["login"] : "" ; ?>" maxlength="15">
<h5>Password</h5>
<input type="password" name="password" maxlength="15">
<h5>Repeat password</h5>
<input type="password" name="password2" maxlength="15">
<input name="submit" type="submit" class="btn btn-large btn-block btn-info" value="Submit">
</form>
</div>
</body>
</html>
<?php
include_once("config.php");

checkLoggedIn("no");

if(isset($_POST["submit"])) {
  field_validator("login name", $_POST["login"], "alphanumeric", 4, 15);
  field_validator("password", $_POST["password"], "string", 4, 15);
  if($messages){
    doIndex();
    exit;
  }

    if( !($row = checkPass($_POST["login"], $_POST["password"])) ) {
        $messages[]="Incorrect login/password, try again";
    }

  if($messages){
    doIndex();
    exit;
  }

  cleanMemberSession($row["login"], $row["password"]);

  header("Location: index.php");
} else {
  doIndex();
}

function doIndex() {
  global $messages; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <meta charset="utf-8">
    <title>Login Chemis</title>
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
if($messages) { displayErrors($messages); }
print("</span><br>")
?>
<a href="join.php" class="pull-right">Registration</a>
<h2>Login</h2>
<h5>User name</h5>
<input type="text" name="login" value="<?php print isset($_POST["login"]) ? $_POST["login"] : "" ; ?>" maxlength="15">
<h5>Password</h5>
<input type="password" name="password" value="" maxlength="15"><br>
<input name="submit" class="btn btn-large btn-block btn-info" type="submit" value="Submit">
</form>
</div>
</body>
</html>
<?php
}
?>
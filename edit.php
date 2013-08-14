<?php
include "functions.php";
include 'head.php';
?>
<body> 	   
  <div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav">
  <div class="container">
    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>     
    </button>
    <a href="../" class="navbar-brand"><img src="img/nav.png" class="img-responsive"></a>
    <div class="nav-collapse collapse bs-navbar-collapse">
      <ul class="nav navbar-nav">         
                 <li><a href="index.php">Home</a></li>
                <li class="divider-vertical"></li>
                <li><a href="downloads.php">Downloads</a></li>
                <li class="divider-vertical"></li>
                <li><a href="about.php">About</a></li>
                <li class="divider-vertical"></li>
                <li><a href="contact.php">Contact</a></li>               
            </ul> 
             <ul class="nav navbar-nav pull-right">
             <li class="dropdown">
            <?      if(!isLoggedIn()) {
	echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Login / Register <b class=\"caret\"></b></a>
	<ul class=\"dropdown-menu\">
	<li><a href=\"login.php\">Login</a></li>
	<li><a href=\"join.php\">Register</a></li>
	</ul>	</li>";
} else {
	echo "	
  <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">".$_SESSION[$sess_name]." <b class=\"caret\"></b></a>
   <ul class=\"dropdown-menu\">
    <li><a href=\"#\">Alpha test</a></li>
    <li class=\"divider\"></li>
    <li><a href=\"logout.php\">Exit</a></li>
  </ul></li>";
}   
	           
      if(!isAdmin()) {
  	}else {
  echo "
  <a href=\"admin\"><img src=\"img/admin.png\" alt=\"Admin panel\"></a>
  <a href=\"admin/users.php\"><img src=\"img/users.png\" alt=\"Users panel\"></a>
  <a href=\"admin/add.php\"><img src=\"img/news.png\" alt=\"News panel\"></a>";       
}
  		?>        
    </div>
  </div>
</div>
<div class="row">
<div class="col-md-6 col-md-offset-3">  
<?php
if(!isLoggedIn()) {
	show_login();
} else {
echo "<div class=\"panel panel-success\"><div class=\"panel-heading\"><h3 class=\"panel-title\">Edit user</h3></div>";

			if(!isset($_POST[submit])) {

				$result = @mysql_query("SELECT * FROM $users_table WHERE username='".$_SESSION[$sess_name]."'");
				$row = mysql_fetch_array($result);

				 echo "<div class=\"panel-body\"><form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
			    	<p>First Name</p>
					<input type=\"text\" name=\"fname\" value=\"".$row[fname]."\">
				   <p>Last Name</p>
					<input type=\"text\" name=\"lname\" value=\"".$row[lname]."\">
				   <p>Password</p>
					<input type=\"password\" name=\"password\">
				   <p>Retype Password</p>
					<input type=\"password\" name=\"verify\">
				   <p>Email Address</p>
					<input type=\"text\" name=\"email\" value=\"".$row[email]."\">
					<br>
				  	<input type=\"submit\" name=\"submit\" class=\"btn btn-success\" value=\"submit\">";

		} else if(isset($_POST[submit]) && empty($_POST[fname]) or empty($_POST[lname]) or empty($_POST[email])) {

				echo "<center><font color=\"red\"><b>Please enter all fields in the form</b></font><p align=\"center\"><a href=\"".$_SERVER[PHP_SELF]."\">Try again</a></center></center>";

			} else if(isset($_POST[submit]) && !empty($_POST[fname]) && !empty($_POST[lname]) && !empty($_POST[email])) {
				
					if(!checkEmail($_POST[email])) {
						$error = "Please enter a valid email address";
					}				
					if($_POST[password] != $_POST[verify]) {
						$error = "The passwords you entered don't match";
					}
				
					if($error != "") {
						echo "The following errors have occured while processing your member registration:<ul>";
								echo "<li><font color=\"red\"><b>".$error."</b></font></li>";						
							echo "</ul>
							<p align=\"center\"><a href=\"".$_SERVER[PHP_SELF]."\">Please try again</a></center>";


					} else if($error == "") {

						if(!empty($_POST[password])) {
							if((strlen($_POST[password]) < 8) || ($_POST[password] != $_POST[verify])) {
								echo "<center><font color=\"red\"><b>Make certain the passwords match and are at least 8 characters in length</b></font></center><p align=\"center\"><a href=\"".$_SERVER[PHP_SELF]."\">Try again</a></center>";
								$continue = 0;
							} else {
								$continue = 1;
								$update = @mysql_query("UPDATE $users_table SET password='".md5($_POST[password])."' WHERE username='".$_SESSION[$sess_name]."'");
							}
						} else {
							$continue = 1;
						}	
							if($continue) {					
							$update = @mysql_query("UPDATE $users_table SET fname='".$_POST[fname]."', lname='".$_POST[lname]."', email='".$_POST[email]."' WHERE username='".$_SESSION[$sess_name]."'");
							echo "<center><h3>Username successfully updated!</h3>
							You successfully updated this user account.</center>";

}
}
}	
}					
?>
</div>
</div>
<?
include "foot.php";
?>
</body>
</html>
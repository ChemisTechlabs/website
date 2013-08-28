<?php
include 'langs.php';
include "functions.php";
include 'head.php';
include 'menu_bar.php';
?>
<div class="container">
<div class="col-md-5 col-md-offset-3">  
<?php
if(!isLoggedIn()) {
	show_login();
} else {
echo "<div class=\"panel panel-success\"><div class=\"panel-heading\"><h3 class=\"panel-title\">".$lang['E_TITLE']."</h3></div>";

			if(!isset($_POST[submit])) {

				$result = @mysql_query("SELECT * FROM $users_table WHERE username='".$_SESSION[$sess_name]."'");
				$row = mysql_fetch_array($result);

				 echo "<div class=\"panel-body\"><form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
			    	<p>".$lang['E_FIRST']."</p>
					<input type=\"text\" name=\"fname\" class=\"form-control\" value=\"".$row[fname]."\">
				   <p>".$lang['E_LAST']."</p>
					<input type=\"text\" name=\"lname\" class=\"form-control\" value=\"".$row[lname]."\">
				   <p>".$lang['E_PASS']."</p>
					<input type=\"password\" class=\"form-control\" name=\"password\">
				   <p>".$lang['E_REPASS']."</p>
					<input type=\"password\" class=\"form-control\" name=\"verify\">
				   <p>".$lang['E_MAIL']."</p>
					<input type=\"text\" name=\"email\" class=\"form-control\" value=\"".$row[email]."\">
					<br>
				  	<input type=\"submit\" name=\"submit\" class=\"btn btn-outline btn-block\" value=\"".$lang['E_POST']."\">";

		} else if(isset($_POST[submit]) && empty($_POST[fname]) or empty($_POST[lname]) or empty($_POST[email])) {

				echo "<center><font color=\"red\"><b>".$lang['E_FIELDS']."</b></font><p align=\"center\"><a href=\"".$_SERVER[PHP_SELF]."\">".$lang['E_TRY']."</a></center></center>";

			} else if(isset($_POST[submit]) && !empty($_POST[fname]) && !empty($_POST[lname]) && !empty($_POST[email])) {
				
					if(!checkEmail($_POST[email])) {
						$error = "".$lang['E_VMAIL']."";
					}				
					if($_POST[password] != $_POST[verify]) {
						$error = "".$lang['E_MPASS']."";
					}
				
					if($error != "") {
						echo "".$lang['E_ERRORS']."<ul>";
								echo "<li><font color=\"red\"><b>".$error."</b></font></li>";						
							echo "</ul>
							<p align=\"center\"><a href=\"".$_SERVER[PHP_SELF]."\">".$lang['E_TRY']."</a></center>";


					} else if($error == "") {

						if(!empty($_POST[password])) {
							if((strlen($_POST[password]) < 8) || ($_POST[password] != $_POST[verify])) {
								echo "<center><font color=\"red\"><b>".$lang['E_LSPASS']."</b></font></center><p align=\"center\"><a href=\"".$_SERVER[PHP_SELF]."\">".$lang['E_TRY']."</a></center>";
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
							echo "<center><h3>".$lang['E_SE']."</h3></center>";

}
}
}	
}					
?>
</div>
</div>
</div>
</div>
<?
include "foot.php";
?>
</body>
</html>
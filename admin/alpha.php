<?
include "../head.php";
?>
<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
<nav class="navbar navbar-collapse navbar-fixed-top bs-docs-nav" role="navigation">
  <div class="navbar-header">
 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
   <span class="sr-only">Toggle navigation</span>
   <span class="icon-bar"></span>
   <span class="icon-bar"></span>
   <span class="icon-bar"></span>
 </button>
 <a class="navbar-brand" href="../"><img src="../img/nav.png" class="img-responsive"></a>
  </div>
  <div class="collapse navbar-collapse navbar-ex1-collapse">
 <ul class="nav navbar-nav">
 <li class="divider-vertical"></li>
 <li><a href=".">Panel</a></li>
 <li class="divider-vertical"></li>
 <li><a href="add.php">Add log</a></li>
 <li class="divider-vertical"></li>
 <li><a href="users.php">Users</a></li>
 <li class="divider-vertical"></li>
 <li><a href="alpha.php">Test</a></li>
 <li class="divider-vertical"></li>
 <li><a href="logout.php">Exit</a></li>     
       </ul>
  </div>
</nav>
</header>
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
			<table class=\"table table-bordered\">
			<thead>
			  <tr>
				<th>User ID</th>
				<th>Username</th>
				<th>Date</th>
				<th>Status</th>				
				<th>Edit</th>
			  </tr>
			  </thead>
			  <tbody>";

			  $result = @mysql_query("SELECT * FROM $alpha_table ORDER BY id");
			  while($row = mysql_fetch_array($result)) {
			            if($row[status] == 1) {
					 $ds = "Unresolved";
				  } else if($row[status] == 2) {
					 $ds = "Authorized";	
			     } else if($row[status] == 0) {
					  $ds = "Unconsidered";	
			  } 
				  echo "
				   <tr>
					<td>".$row[id]."</td>
					<td>".$row[username]."</td>
					<td>".$row[date]."</td>
					<td>$ds</td>					
					<td><a class=\"btn btn-danger btn-mini\" href=\"".$_SERVER[PHP_SELF]."?action=edit&id=$row[0]\">Edit</a></td>
				  </tr>";
			  }
			  echo "</tbody></table>";
		
		} else if($_GET[action] == "edit" && isset($_GET[id])) {
			echo "<h2 align=\"center\">Providing access to the alpha test</h2><center>";
           
			if(!isset($_POST[yes])) {
			echo "<form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."?action=edit&id=$_GET[id]\">
<input type=\"submit\" name=\"yes\" class=\"btn btn-success btn-lg\"value=\"Сonfirm\">";
				 $update = @mysql_query("UPDATE $alpha_table SET status='1' WHERE id='".$_GET[id]."'");
             } else {
					echo "<center><h3>Username successfully updated!</h3>
					You successfully updated this user account.</center>";					
				}
			
			if(!isset($_POST[no])) {
					echo "<form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."?action=edit&id=$_GET[id]\">
               <input type=\"submit\" name=\"no\" class=\"btn btn-danger btn-lg\"value=\"Reject\">";
					 $update = @mysql_query("UPDATE $alpha_table SET status='2' WHERE id='".$_GET[id]."'");
					 } else {
					echo "<center><h3>Username successfully updated!</h3>
					You successfully updated this user account.</center>";
					}		
		
		
	}
	}
	}
?>
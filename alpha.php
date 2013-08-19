<?php
include "functions.php";
include 'head.php';
if(!isLoggedIn()) {
	show_login();
} else {
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.carousel').carousel({interval: 5000});
    });
</script>
<body> 	   
  <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
   <nav class="navbar navbar-collapse navbar-fixed-top bs-docs-nav" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="../"><img src="img/nav.png" class="img-responsive"></a>
  </div>
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
     <li><a href="index.php">Home</a></li>
                <li class="divider-vertical"></li>
                <li><a href="downloads.php">Downloads</a></li>
                <li class="divider-vertical"></li>
                <li><a href="about.php">About</a></li>
                <li class="divider-vertical"></li>
                <li><a href="contact.php">Contact</a></li>       
          </ul>
        <ul class="nav navbar-nav navbar-right">  
          <? if(!isLoggedIn()) {
	echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Login / Register<b class=\"caret\"></b></a>
    <ul class=\"dropdown-menu\">
	<li><a href=\"login.php\">Login</a></li>
	<li><a href=\"join.php\">Register</a></li>
	</ul>
	</li>";
} else {
	echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">".$user."<b class=\"caret\"></b></a>
    <ul class=\"dropdown-menu\">
    <li><a href=\"alpha.php\">Alpha test</a></li>
    <li><a href=\"edit.php\">Settings</a></li>
    <li class=\"divider\"></li>
    <li><a href=\"logout.php\">Exit</a></li>
  </ul>
</li>";
}   
	           
      if(!isAdmin()) {
  	}else {
  echo "
  <a href=\"admin\"><img src=\"img/admin.png\" alt=\"Admin panel\"></a>";       
}
  		?>        
        </ul>        
      </li>
    </ul>
  </div>
</nav>
</header>
    <div class="container">
        <div class="row">
<div class="col-8">                   
<h1>A special unit Alpha.</h1>
<div class="col-lg-2">   
<img src="img/alpha.png" alt="Alpha">
</div>
<br>
<h2>
In Chemis created a new division, is focused on testing.</h2>
<h4>  
While it called <b>"Alpha Lab"</b>
In division has its own culture and atmosphere.   
</h4>
<a href="?add=add"  class="btn btn-default btn-lg">Apply now</a>
</div>
<hr>
<center>
<? 
if($_GET[add]) {
echo "<form method=\"POST\" action=\"".$_SERVER[PHP_SELF]."\">
<input type=\"submit\" name=\"submit\" class=\"btn btn-primary btn-lg\"value=\"Join the team\">";
}
?>
<?
if($_POST[submit]) {	
 $result = mysql_query("SELECT * FROM $alpha_table WHERE username='".$user."'");
 if(mysql_num_rows($result) > 0) {
 echo "<span class=\"label label-warning\">You have already applied! Wait for the administration's decision</span>"; 
 } else {  
$result = mysql_query ("INSERT INTO $alpha_table  (ip, username, date, status)  VALUES ('$ip_address','$user','$date','0')");	
}
}
$result = @mysql_query("SELECT * FROM $alpha_table where username='".$user."'");
			  while($row = mysql_fetch_array($result)) {
				  if($row[status] == 1) {
					 $ds = "<h4><span class=\"label label-danger\">Administration is not your application and you can download the Chemis-alpha.</span></h4>";
				  } else if($row[status] == 2) {
					 $ds = "<h4><span class=\"label label-success\">Administration has approved your application and you can download the Chemis-alpha.</span></h4><br>
					 <a href=\"".$alpha_chemis."\"  class=\"btn btn-success btn-lg\">Apply now</a>";	
			     } else if($row[status] == 0) {
					  $ds = "<h4><span class=\"label label-default\">Your request is under consideration by the administration.</span></h4>";	 
}	
}
}
?>
<? echo "$ds";?>
</div>
</div>
</center>
<?
 include 'foot.php';
 ?>
</body>
</html>
<?php
include "functions.php";
include 'head.php';
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
          <? 
          if(!isLoggedIn()) {
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
  <a href=\"admin\" class=\"navbar-t\"><img src=\"img/admin.png\" alt=\"Admin panel\"></a>";       
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
          
 <?
if($_POST[submit])
{		
if(!isLoggedIn()) {		 
$result = mysql_query ("INSERT INTO $download_table  (ip, date, nl)  VALUES ('$ip_address','$date','1')");
header("location: $chemis");		
} else { 
$result = mysql_query ("INSERT INTO $download_table  (ip, username, date)  VALUES ('$ip_address','$user','$date')"); 
header("location: $chemis");			
}
}	
?>
<center>

<form method="POST" action="<?echo $_SERVER['PHP_SELF'];?>">
<input type="submit" name="submit" class="btn btn-outline btn-lg" value="Download Chemis">
	</form>	
	</center>
	</div>
	</div>
	<hr>
                 <div class="col-xs-6 col-md-6">                  
              <center><h2>Chemis is constantly updated</h2> 
          <img src="img/calendar" class="img-relative"> 
                </div>
            <div class="col-xs-6 col-md-6">    
            <center> <h2>Our products are protected</h2>       
            <img src="img/lock" class="img-relative">
           </div>
            <div class="col-xs-6 col-md-6">
              <center><h2>With Chemis you'll have the most accurate results</h2>
           <img src="img/calculator" class="img-relative"> 
             </div>
            <div class="col-xs-6 col-md-6">
             <center><h2>We care about users</h2>
            <img src="img/user" class="img-relative">  
           </div>          
           </div>
           </div>            
        
    <?php
    include 'foot.php';
    ?>
</body>
</html>

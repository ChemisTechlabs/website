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
	</ul>
	</li>";
} else {
	echo "	
  <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">".$_SESSION[$sess_name]." <b class=\"caret\"></b></a>
   <ul class=\"dropdown-menu\">
    <li><a href=\"#\">Alpha test</a></li>
    <li><a href=\"edit.php\">Settings</a></li>
    <li class=\"divider\"></li>
    <li><a href=\"logout.php\">Exit</a></li>
  </ul>
</li>";
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
    <div class="container">
        <div class="row">
            <div class="col-lg-8 hidden-phone hidden-tablet">
                <div class="well well-large">
                    <div id="myCarousel" class="carousel container slide">
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="active item"><img src="img/chemis-logo.png" alt="" /></div>
                            <div class="item"><img src="img/chemis-logo.png" alt="" /></div>
                            <div class="item"><img src="img/chemis-logo.png" alt="" /></div>
                            <div class="item"><img src="img/chemis-logo.png" alt="" /></div>
                        </div>
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
                    </div>
                </div> 
            </div> 
           <div class="col-lg-4">                   
<?
if($_POST[submit])
{		
if(!isLoggedIn()) {		 
$result = mysql_query ("INSERT INTO $alpha_table (ip, date, nl)  VALUES ('$ip_address','$date','1')");
header("location: $chemis");		
} else { 
$result = mysql_query ("INSERT INTO $alpha_table (ip, username, date)  VALUES ('$ip_address','$user','$date')"); 
header("location: $chemis");			
}
}	
?>
<form method="POST" action="<?echo $_SERVER['PHP_SELF'];?>">
	<input type="submit" name="submit" class="btn btn-success" value="Download">
	</form>            
    <?php
    include 'foot.php';
    ?>
</body>
</html>
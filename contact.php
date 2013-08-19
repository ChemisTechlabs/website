<?php
include "functions.php";
include 'head.php';
?>
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
 <div class="containerd">
<div class="row">
<div class="col-lg-7">
<div class="well well-small" style="color:#800080;">
<h1>Support & Contact</h1>
</div>
<i style="font-size: large;">
We will be ready to accept any proposals for the project!<br>
Communication with the command:<br>
<hr>
Guilherme Caldas - lead developer, project manager <a href="mailto:guilhermecaldas@yandex.com">guilhermecaldas@yandex.com</a><br>
<hr>
Nikita Berezhnoj - Web developer, designer <a href="mailto:nik.pr2012@yandex.ru">Nik.pr2012@yandex.ru</a>
 </i>
</div>
<div class="col-lg-5">
<img src="img/biglogo.jpg" class="img-responsive" alt="Chemis team">
</div>
</div>
</div>
 <?php
 include 'foot.php';
?>
</body>
</html>

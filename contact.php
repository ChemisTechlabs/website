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
    <a href="../" class="navbar-brand">Chemis</a>
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
                  <?            
               if(!isAdmin()) {
	        	}else {
	        echo "<div class=\"pull-right\">
	     <a href=\"admin\"><img src=\"img/admin.png\" alt=\"Admin panel\"></a>
        <a href=\"admin/users.php\"><img src=\"img/users.png\" alt=\"Users panel\"></a>
        <a href=\"admin/add.php\"><img src=\"img/news.png\" alt=\"News panel\"></a></div>";       
      }
  		?>        
    </div>
  </div>
</div>  
            <img src="img/logo.png" class="img-responsive">            
            <? //echo "Hello, <b>".$_SESSION[$sess_name]."</b>";?>              
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

<?php
include "functions.php";
include 'head.php';
?>
     <script type="text/javascript">
      $(document).ready(function() {
        $('.carousel').carousel({interval: 5000});
      });
    </script>         
     </head>    	 
	<body>	
	<div class="row-fluid">
   <div class="span10">
   <img src="img/logo.png">
   </div>    
	</div> 
   <div class="navbar hidden-phone hidden-tablet">
   <div class="navbar-inner">
	<ul class="nav" style="top: 50%;left: 30%;">
    <li><a href="index.php">Home</a></li>
    <li class="divider-vertical"></li>
    <li><a href="downloads.php">Downloads</a></li>
    <li class="divider-vertical"></li>
    <li><a href="about.php">About</a></li>
    <li class="divider-vertical"></li>
    <li class="active">
   <a href="contact.php">Contact</a></li>
    </ul>
               <?            
               if(!isAdmin()) {
	        	}else {
	        echo "<div class=\"pull-right nav-collapse\">
	     <a href=\"admin\"><img src=\"img/admin.png\" alt=\"Admin panel\"></a>
        <a href=\"admin/users.php\"><img src=\"img/users.png\" alt=\"Users panel\"></a>
        <a href=\"admin/add.php\"><img src=\"img/news.png\" alt=\"News panel\"></a></div>";       
      }
  		?> 
    </div>
    </div>    
<div class="navbar navbar-fixed-top hidden-desktop">
<div class="navbar-inner">
<div class="container">
<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<div class="nav-collapse collapse">
<ul class="nav">
 <li class="active">
 <a href="index.php">Home</a></li>
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
	        echo "
	     <a href=\"admin\"><img src=\"img/admin.png\" alt=\"Admin panel\"></a>
        <a href=\"admin/users.php\"><img src=\"img/users.png\" alt=\"Users panel\"></a>
        <a href=\"admin/add.php\"><img src=\"img/news.png\" alt=\"News panel\"></a>";       
      }
  		?> 
</div>
</div>
</div>
</div>
<div class="container-fluid">
<div class="row-fluid">
<div class="span7">
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
<div class="span5 pull-right">
<img src="img/biglogo.jpg" alt="Chemis team">
</div>
</div>
</div>
 <?php
 include 'foot.php';
?>
</body>
</html>






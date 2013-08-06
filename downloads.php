<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Chemis-app</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Никита Бережной" >
    <!--Css-->    
    <link href="css/style.css" rel="stylesheet"> 
    <link rel="shortcut icon" href="css/favicon.ico"> 
    <!--java-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-carousel.js"></script>  
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
		<div class="span2">	
	<i style="color:#800080; font-size: large;"> Facebook</i>	
		<a href="https://www.facebook.com/chemisproject" target="_blank"><img src="img/fb.png" alt="Facebook"></a>
		<i style="color:#800080; font-size: large;">Vkontakte</i>
		<a href="http://vk.com/chemisproject" target="_blank"><img src="img/vk.png" alt="Vkontakte"></a>
	 </div> 
   </div>
 	<div class="navbar hidden-phone hidden-tablet">
   <div class="navbar-inner">
	<ul class="nav" style="top: 50%;left: 30%;">
 <li><a href="index.php">Home</a></li>
 <li class="divider-vertical"></li>
 <li class="active">
 <a href="downloads.php">Downloads</a></li>
 <li class="divider-vertical"></li>
 <li><a href="about.php">About</a></li>
 <li class="divider-vertical"></li>
 <li><a href="contact.php">Contact</a></li>
    </ul>
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
</div>
</div>
</div>
</div>
<div class="container-fluid">
<div class="row-fluid">
<div class="span8 hidden-phone hidden-tablet">
<div class="well well-large">
<div id="myCarousel" class="carousel container slide">
 <!-- Carousel items -->
<div class="carousel-inner">
  <div class="active item"><img src="http://cs14113.vk.me/c540103/v540103897/3196/ciBlYXf-WD4.jpg" alt="" /></div>
  <div class="item"><img src="http://cs14113.vk.me/c540103/v540103897/3196/ciBlYXf-WD4.jpg" alt="" /></div>
  <div class="item"><img src="http://cs14113.vk.me/c540103/v540103897/3196/ciBlYXf-WD4.jpg" alt="" /></div>
</div>
<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
  </div>
  </div> 
  </div> 
  <div class="span4">
<?php    
    include "dbinit.php";
        
    $query = "SELECT * FROM `news`";
    $result = mysql_query($query);

    if (!$result)
    {
	  print "<center><br>ошибка:" . mysql_error() . "<br></center>";
    }
    elseif (mysql_num_rows($result) == 0)
    {
	 print "<center><div class=\"alert alert-error\">Новостей нет</div></center>\n";
    }
    else
    {
	 $rows = array();
	 while ($row = mysql_fetch_assoc($result)) 
	 {
	     $rows[]= $row;
	 }
         $rows = array_reverse($rows);
         foreach($rows as $row)
         {  
	     print "<div class=\"well well-small alert alert-info\">{$row['date']}</div><div style=\"color:#800080;\" class=\"well well-small\">{$row['text']}</div>";    
         }
    }
?>
  </div>  
  </div>
  </div> 
<div class="modal-footer">
<p>&copy; 2013 Chemis Team. <a href="http://vk.com/nikitoshi2013" target="_blank">Nikita Berezhnoj</a> &middot; <a href="http://vk.com/guilherme_caldas" target="_blank">Guilherme Caldas</a> &middot; 
Ana Evangelho</p>
</div>
</body>
</html>






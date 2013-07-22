<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Chemis-app</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
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
    <style>      
      .carousel {             
        overflow: hidden;
      }
      .carousel .item {
        -webkit-transition: opacity 1s;
        -moz-transition: opacity 1s;
        -ms-transition: opacity 1s;
        -o-transition: opacity 1s;
        transition: opacity 1s;
      }
       .carousel-control {
      width: 20px;   
      font-size: 100px;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
      background-color: transparent;
      border: 0;
      z-index: 10;      
    } 
    .carousel .active.left, .carousel .active.right {
        left:0;
        opacity:0;
        z-index:2;
      }
      .carousel .next, .carousel .prev {
        left:0;
        opacity:1;
        z-index:1;
      }
    
   .carousel{
      	
}
}
    </style>    
   </head>    	 
	<body>	
	<img src="img/logo.png" class="logo">	
 	<div class="navbar">
   <div class="navbar-inner">
	<ul class="nav" style="top: 50%;left: 25%;">
    <li class="active">
    <a href="#">Home</a></li>
    <li class="divider-vertical"></li>
    <li><a href="#">Downloads</a></li>
    <li class="divider-vertical"></li>
    <li><a href="#">About</a></li>
    <li class="divider-vertical"></li>
    <li><a href="#">Contact</a></li>
    </ul>
    </div>
    </div>
<div class="container-fluid">
<div class="row-fluid">
<div class="span8">
<div class="well well-large hidden-phone">
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





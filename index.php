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
    <div class="row-fluid">
        <div class="span10">
            <img src="img/logo.png">
            </div>
            <? //echo "Hello, <b>".$_SESSION[$sess_name]."</b>";?>
           </div>         	
        <div class="navbar hidden-phone hidden-tablet">
        <div class="navbar-inner">
            <ul class="nav" style="top: 50%;left: 30%;">
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
            <div class="span8 hidden-phone hidden-tablet">
                <div class="well well-large">
                    <div id="myCarousel" class="carousel container slide">
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="active item"><img src="http://rcruz.net/wp-content/uploads/2012/11/Aquaria.jpg" alt="" /></div>
                            <div class="item"><img src="http://www.qpratools.com/gallery/0005/aquaria-luxaeterna-front.jpg" alt="" /></div>
                            <div class="item"><img src="http://cs310222.vk.me/v310222030/1909/8O7JYBai_q8.jpg" alt="" /></div>
                            <div class="item"><img src="http://metaltalk.net/images3/angra1.jpg" alt="" /></div>
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

                if (!$result) {
                    print "<center><br>ошибка:" . mysql_error() . "<br></center>";
                } elseif (mysql_num_rows($result) == 0) {
                    print "<center><div class=\"alert alert-error\">Новостей нет</div></center>\n";
                } else {
                    $rows = array();
                    while ($row = mysql_fetch_assoc($result)) {
                        $rows[] = $row;
                    }
                    $rows = array_reverse($rows);
                    foreach ($rows as $row) {
                        print "<div class=\"well well-small alert alert-info\">{$row['date']}</div><div style=\"color:#800080;\" class=\"well well-small\">{$row['text']}</div>";
                    }
                }
                ?>
            </div>  
        </div>
    </div> 
    <?php
    include 'foot.php';
    ?>
</body>
</html>
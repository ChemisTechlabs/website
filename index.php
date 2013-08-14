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
                        print "<div class=\"panel panel-info\"><div class=\"panel-heading\"><h3 class=\"panel-title\">{$row['date']}</h3></div><div style=\"color:#800080;\">{$row['text']}</div></div>";
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
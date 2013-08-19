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
            <div class="col-lg-8">
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
$page = $_GET['page'];
$result0 = mysql_query("SELECT COUNT(*) FROM $news_table");
$temp = mysql_fetch_array($result0);
$posts = $temp[0];
$total = (($posts - 1) / $num) + 1;
$total =  intval($total);
$page = intval($page);
if(empty($page) or $page < 0) $page = 1;
if($page > $total) $page = $total;
$start = $page * $num - $num;			
$result = @mysql_query("SELECT * FROM $news_table ORDER BY id DESC LIMIT $start, $num");

                if (!$result) {
                    print "<center><br>error:" . mysql_error() . "<br></center>";
                } elseif (mysql_num_rows($result) == 0) {
                    print "<center><div class=\"alert alert-error\">No news</div></center>\n";
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
<?
if($page - 5 > 0) $page5left = '<a href=?page='. ($page - 5) .'>'. ($page - 5) .'</a>';
if($page - 4 > 0) $page4left = '<a href=?page='. ($page - 4) .'>'. ($page - 4) .'</a>';
if($page - 3 > 0) $page3left = '<a href=?page='. ($page - 3) .'>'. ($page - 3) .'</a>';
if($page - 2 > 0) $page2left = '<a href=?page='. ($page - 2) .'>'. ($page - 2) .'</a>';
if($page - 1 > 0) $page1left = '<a href=?page='. ($page - 1) .'>'. ($page - 1) .'</a>';
if($page) $pagenow = '<a href=?page='. ($page) .'>'. ($page) .'</a>';
if($page + 5 <= $total) $page5right = '<a href=?page='. ($page + 5) .'>'. ($page + 5) .'</a>';
if($page + 4 <= $total) $page4right = '<a href=?page='. ($page + 4) .'>'. ($page + 4) .'</a>';
if($page + 3 <= $total) $page3right = '<a href=?page='. ($page + 3) .'>'. ($page + 3) .'</a>';
if($page + 2 <= $total) $page2right = '<a href=?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = '<a href=?page='. ($page + 1) .'>'. ($page + 1) .'</a>';
?>
<?
if ($total > 1)
{
echo "<ul class=\"pager\"><li>$page5left</li> <li>$page4left</li> <li>$page3left<li> <li>$page2left</li> <li>$page1left</li> <li class=\"disabled\">$pagenow</li> <li>$page1right</li> <li>$page2right</li> <li>$page3right</li> <li>$page4right</li> <li>$page5right</li></ul>";
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
<?php
include "../head.php";
include "../functions.php";
if(!isLoggedIn()) {
	show_login();
} else {

	if(!isAdmin()) {

		//user is logged in but a regular user
		echo "<h2 align=\"center\">Sorry, this page is for administrators only</h2>";

	} else {

#############################################################################################################################################
#############################################################################################################################################     
     if (@$_GET['do'] == "add")
     {
     include "add.php"; exit;
     }
     if (@$_GET['do'] == "edit")
     {
     include "edit.php"; exit;
     }
     if (@$_GET['do'] == "delete")
     {
     include "delete.php"; exit;
     }
#############################################################################################################################################
#############################################################################################################################################
     if (@$_POST)
     {
         $posts_id = $_POST;
	 	 foreach($posts_id as $post_id)
         {
	     $query = "DELETE FROM `news` WHERE `id`='$post_id'";
	     if (!mysql_query($query)) echo mysql_error();
	 
	 }
     }
#############################################################################################################################################
#############################################################################################################################################
?>
<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
<nav class="navbar navbar-collapse navbar-fixed-top bs-docs-nav" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="../"><img src="../img/nav.png" class="img-responsive"></a>
  </div>
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
    <li class="divider-vertical"></li>
 <li><a href=".">Panel</a></li>
 <li class="divider-vertical"></li>
 <li><a href="add.php">Add log</a></li>
 <li class="divider-vertical"></li>
 <li><a href="users.php">Users</a></li>
 <li class="divider-vertical"></li>
 <li><a href="alpha.php">Test</a></li>
 <li class="divider-vertical"></li>
 <li><a href="logout.php">Exit</a></li>     
          </ul>
  </div>
</nav>
</header>
<div class="container">
<div class="row-">
<div class="col-lg-7">
<?php
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
$result = @mysql_query("SELECT * FROM $news_table ORDER BY id DESC LIMIT $start , $num");

    if (mysql_num_rows($result) == 0) {
 	     print "<center><h3><span class=\"label label-danger\">No news</span></h3></center><br>";
   } else {            
       $rows = array();
   while ($row = mysql_fetch_assoc($result)) {
       $rows[] = $row;
     }
                   
	 echo "<form action=\"{$_SERVER["PHP_SELF"]}\" method=\"POST\" name=\"delete_checked\">\n";
       $rows = $rows;
  foreach ($rows as $row) {                                                                                                                                     
	     print "<center><div class=\"panel panel-info\"><div class=\"panel-heading\"><h3 class=\"panel-title\">{$row['date']}</h3></div><div style=\"color:#800080;\">{$row['text']}</div><p>\n<a class=\"btn btn-danger\" href=\"index.php?do=delete&new={$row['id']}\" OnClick=\"return confirm('Delete this news?');\">Delete</a>&nbsp;<a class=\"btn btn-warning\" href=\"index.php?do=edit&new={$row['id']}\">Edit</a></center>\n";    
         }
	 echo "</form>\n";
    }
?>
<?
if($page - 5 > 0) $page5left = '<a href=index.php?page='. ($page - 5) .'>'. ($page - 5) .'</a>';
if($page - 4 > 0) $page4left = '<a href=index.php?page='. ($page - 4) .'>'. ($page - 4) .'</a>';
if($page - 3 > 0) $page3left = '<a href=index.php?page='. ($page - 3) .'>'. ($page - 3) .'</a>';
if($page - 2 > 0) $page2left = '<a href=index.php?page='. ($page - 2) .'>'. ($page - 2) .'</a>';
if($page - 1 > 0) $page1left = '<a href=index.php?page='. ($page - 1) .'>'. ($page - 1) .'</a>';
if($page) $pagenow = '<a href=index.php?page='. ($page) .'>'. ($page) .'</a>';
if($page + 5 <= $total) $page5right = '<a href=index.php?page='. ($page + 5) .'>'. ($page + 5) .'</a>';
if($page + 4 <= $total) $page4right = '<a href=index.php?page='. ($page + 4) .'>'. ($page + 4) .'</a>';
if($page + 3 <= $total) $page3right = '<a href=index.php?page='. ($page + 3) .'>'. ($page + 3) .'</a>';
if($page + 2 <= $total) $page2right = '<a href=index.php?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = '<a href=index.php?page='. ($page + 1) .'>'. ($page + 1) .'</a>';
?>
<?
if ($total > 1)
{
echo "<ul class=\"pager\"><li>$page5left</li> <li>$page4left</li> <li>$page3left<li> <li>$page2left</li> <li>$page1left</li> <li class=\"disabled\">$pagenow</li> <li>$page1right</li> <li>$page2right</li> <li>$page3right</li> <li>$page4right</li> <li>$page5right</li></ul>";
}
?>
</div>
<div class="col-lg-4">
<?
//Not login
$notlogin = @mysql_query("SELECT COUNT(*) FROM $download_table where nl='1'");
$row = mysql_fetch_row($notlogin);
$nl= $row[0]; 
//Login
$login = @mysql_query("SELECT COUNT(*) FROM $download_table where nl='0'");
$rowl = mysql_fetch_row($login);
$ln = $rowl[0]; 
?>
 <div class="list-group">
        <a href="?see=people" class="list-group-item">
          <h4 class="list-group-item-heading">People download programs <b><? echo "$nl"?></b></h4>
          <p class="list-group-item-text">This takes into account unregistered users download.</p>
        </a>
        <a href="?see=users" class="list-group-item">
          <h4 class="list-group-item-heading">Users download the program <b><? echo "$ln"?></b></h4>
          <p class="list-group-item-text">This takes into account the registered users download.</p>
        </a>        
      </div>
      <div class="alert alert-success">Downloads:<b> <? printf($nl+$ln) ?></b></div>
    </div>
    <div class="col-lg-1">
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="submit" name="online" class="btn btn-success"value="On site">
</form>
<?
if(($_POST[online])) {
 $update = @mysql_query("UPDATE $settings_table  SET value='online' WHERE id='1'");
 } 
?> 
<br>		
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="submit" name="offline" class="btn btn-danger" value="Off site">
</form>
<?
if(($_POST[offline])) {
 $update = @mysql_query("UPDATE $settings_table SET value='offline' WHERE id='1'");
 } 	
?>
</div> 
<?
if($_GET[see] == "people") {
echo "<br><table class=\"table table-striped\">
			<thead>
			  <tr>
				<th>#</th>				
				<th>IP</th>
				<th>Date</th>				
			  </tr>
			  </thead>
			  <tbody>";

			  $result = @mysql_query("SELECT * FROM $download_table where nl='1'");
			  while($row = mysql_fetch_array($result)) {
				  echo "
				   <tr>
					<td>".$row[id]."</td>
					<td>".$row[ip]."</td>					
					<td>".$row[date]."</td>					
				  </tr>";
			  }
			  echo "</tbody></table>";	
		}	
	
	if($_GET[see] == "users") {
   echo "<br><table class=\"table table-striped\">
			<thead>
			  <tr>
				<th>#</th>
				<th>IP</th>
				<th>Username</th>
				<th>Date</th>				
			  </tr>
			  </thead>
			  <tbody>";

			  $result = @mysql_query("SELECT * FROM $download_table  where nl='0'");
			  while($row = mysql_fetch_array($result)) {
				  echo "
				   <tr>
					<td>".$row[id]."</td>
					<td>".$row[ip]."</td>
					<td>".$row[username]."</td>
					<td>".$row[date]."</td>					
				  </tr>";
			  }
			  echo "</tbody></table>";	
	}	
?>
</div>
</div>
</div>
<?
include "../foot.php";
?>
</body>
</head>
<?
}
}
?>

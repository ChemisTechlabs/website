<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin-Chemis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta name="author" content="Никита Бережной" >
    <!--Css-->    
    <link href="../css/style.css" rel="stylesheet">     
    <link rel="shortcut icon" href="../css/favicon.ico">
     <!--java-->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>    
  </head>
<body>
<?php
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
	 //print_r($posts_id);
	 foreach($posts_id as $post_id)
         {
	     $query = "DELETE FROM `news` WHERE `id`='$post_id'";
	     if (!mysql_query($query)) echo mysql_error();
	 
	 }
     }
#############################################################################################################################################
#############################################################################################################################################
?>
<div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav">
  <div class="container">
    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>     
    </button>
    <a href="../" class="navbar-brand"><img src="../img/nav.png" class="img-responsive"></a>
    <div class="nav-collapse collapse bs-navbar-collapse">
      <ul class="nav navbar-nav">       
 <li class="divider-vertical"></li>
 <li><a href=".">Panel</a></li>
 <li class="divider-vertical"></li>
 <li><a href="add.php">Add log</a></li>
 <li class="divider-vertical"></li>
 <li><a href="users.php">Users</a></li>
 <li class="divider-vertical"></li>
 <li><a href="logout.php">Exit</a></li>
 </ul>   
 </div>
 </div>
 </div>
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
	 echo "<form action=\"{$_SERVER["PHP_SELF"]}\" method=\"POST\" name=\"delete_checked\">\n";
         foreach($rows as $row)
         {                                                                                                                                      
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
$notlogin = @mysql_query("SELECT COUNT(*) FROM $alpha_table where nl='1'");
$row = mysql_fetch_row($notlogin);
$nl= $row[0]; 
//Login
$login = @mysql_query("SELECT COUNT(*) FROM $alpha_table where nl='0'");
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

			  $result = @mysql_query("SELECT * FROM $alpha_table where nl='1'");
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

			  $result = @mysql_query("SELECT * FROM $alpha_table where nl='0'");
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
<div class="modal-footer">
<p>&copy; 2013 Chemis Team. <a href="http://vk.com/nikitoshi2013" target="_blank">Nikita Berezhnoj</a> &middot; <a href="http://vk.com/guilherme_caldas" target="_blank">Guilherme Caldas</a> &middot; 
Ana Evangelho</p>
</div>
</body>
</head>
<?
}
}
?>

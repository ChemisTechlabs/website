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
include "../dbinit.php";
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
$date = date("d.m.Y H:i:s");
?>
<img src="../img/logo.png" alt="logo">	
 	<div class="navbar hidden-phone hidden-tablet">
<div class="navbar-inner">
<ul class="nav" style="top: 50%;left: 35%;">    
 <li class="divider-vertical"></li>
 <li><a href="../">Site</a></li>
 <li class="divider-vertical"></li>
 <li><a href="add.php">Add log</a></li>
 <li class="divider-vertical"></li>
 <li><a href="users.php">Users</a></li>
 <li class="divider-vertical"></li>
 <li><a href="logout.php">Exit</a></li>
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
    <li class="divider-vertical"></li>
    <li><a href="../">Site</a></li>
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
</div>
<div class="container-fluid">
<div class="row-fluid">
<div class="span6">
<?php
    $query = "SELECT * FROM `news`";
    $result = mysql_query($query);
                                        
    if (!$result)
    {
	  print "<center>Error:" . mysql_error() . "<br></center>\n";
    }
    elseif (mysql_num_rows($result) == 0)
    {
	 print "<center>No news<br></center>\n";
    }
    else
    {
	 $rows = array();
	 while ($row = mysql_fetch_assoc($result)) 
	 {
	     $rows[]= $row;
	 }
         $rows = array_reverse($rows);
	 echo "<form action=\"{$_SERVER["PHP_SELF"]}\" method=\"POST\" name=\"delete_checked\">\n";
         foreach($rows as $row)
         {                                                                                                                                      
	     print "<center>\n<b><div class=\"well well-small alert alert-info\">{$row['date']}</div></b>\n<div class=\"well well-small\">{$row['text']}</div><p>\n<a class=\"btn btn-primary disabled\" href=\"index.php?do=delete&new={$row['id']}\" OnClick=\"return confirm('Delete this news?');\">Delete</a>&nbsp;<a class=\"btn btn-primary disabled\" href=\"index.php?do=edit&new={$row['id']}\">Edit</a></center>\n";    
         }
	 echo "</form>\n";
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

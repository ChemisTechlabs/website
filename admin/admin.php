<?php
session_start();
if (!$_SESSION['admin']) { Header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin-Chemis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta name="author" content="Никита Бережной" >
    <!--Css-->    
    <link href="../css/style.css" rel="stylesheet">     
    <link rel="shortcut icon" href="ico/favicon.ico">
  </head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
<div class="container">
<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<ul class="nav">
<li>
<a href="../">Site</a>
</li>
<li>
<a href="logout.php">Exit</a>
</li>
</div>
</div>
</div>
</div> 
<div class="container-fluid">
<div class="row-fluid">
<div class="span10">
</div>
<div class="span4">
<div class="well well-small">
Loading nightly builds
</div>
<form enctype="multipart/form-data" action="upload.php" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="666999666999">
Downloadable assembly: <input type="file" name="uploadfile">
<button class="btn btn-primary" type="submit">Download</button>
</form>
</div>
</div>
</div>
</body>
</head>

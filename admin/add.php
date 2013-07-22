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
    <link rel="shortcut icon" href="../css/favicon.ico">  
    </head>
<body>
<?php
include "../dbinit.php";
$date = $_POST['date'];
echo "<div class=\"hero-unit\"><center>$date</center><p>\n";

$phpself = $_SERVER["PHP_SELF"]."?do=add";
$print_form = 0;
    if (@$_POST)
    {
   $text = $_POST['addtext'];    
   
	if (strlen($text) > 5000)
	{
	    print "Maximum 5000 characters din posts.<br>\n"; 
            $print_form = 1;
	}
	elseif (strlen($text) <= 1)
	{
	    print "The minimum length of 2 characters of posts.<br>\n"; 
            $print_form = 1;
	}
        else
        {
	    $query = "INSERT INTO `news` ( `date` , `text` ) 
	    VALUES (
   	    '$date', '$text'  
	    );";
	    if (mysql_query($query))
	    {
	        print "<p><center>The news has been added successfully!<p>\n<a href=\"admin.php?do=add\">Add more</a><br>\n<a href=\"admin.php\">Admin center</a><br />\n<a href=\"../\">Site</a>\n";
            }
            else
            {
                print "Error:" . mysql_error() . "\n";
            }
         }
    }       
    else
    {
        $print_form = 1;
    }
    
    if ($print_form == 1)
    {
	?>
	<div class="container-fluid">
   <div class="row-fluid">
    <div class="span2">	
	Необходимо использовать Html теги!<br>Также их нужно закрывать!
	<br>О всех тегах можно узнать на сайте <a href="http:\\htmlbook.ru" target="_blank">HtmlBook</a>
   </div>
	<div class="span10">	
 <form name="addform" action="<?=$phpself ?>" method="POST">
 Заголовок:<br><input type="text" name="date" value="<?=$row_date ?>"><p>
 <textarea style=" min-width:700px;min-height:300px;" name="addtext" wrap="hard"></textarea>  
 <br><input class="btn btn-large btn-primary" type="submit" value="Add news">  
  <a class="btn btn-success" href="index.php">Admin center</a>
   </div>
   </div>
   </div>    
 <?php
 }
?>
</body>
</html>
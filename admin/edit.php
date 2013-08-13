<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Edit news</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta name="author" content="Никита Бережной" >
    <!--Css-->    
    <link href="../css/style.css" rel="stylesheet">     
    <link rel="shortcut icon" href="../css/favicon.ico">    
  </head>
<body>
<?php	
$date = date("d.m.Y H:i:s");
echo "<div class=\"hero-unit\"><center>$date</center><p>\n";

$new_id = $_GET['new'];

	$query = "SELECT * FROM `news` WHERE `id`='$new_id' LIMIT 1";
        $result = mysql_query($query);
        if (mysql_num_rows($result) != 1)
        {
            print "<p><center>This news does not exist!<p>\n<br />\n<a href=\"index.php\">Admin center</a>\n"; exit;
	}
$phpself = $_SERVER["PHP_SELF"]."?do=edit&new=$new_id";
$print_form = 0;

    if (@$_POST)
    {
        $post_date =  $_POST['date'];
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
	    $query = "UPDATE `news` SET `date`='$post_date', `text`='$text' WHERE `id`='$new_id'";
	    if (mysql_query($query))
	    {
	        print "<p><center>News edited successfully!<p>\n<br />\n<a href=\"index.php\">Admin center</a>\n";
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
	$query = "SELECT * FROM `news` WHERE `id`='$new_id'";
        $result = mysql_query($query);
        $row = mysql_fetch_assoc($result);
        
        $row_date = $row['date'];
        $row_text = $row['text'];
	$row_text = str_replace("<br />", "", $row_text);	
	?>
<form name="addform" action="<?=$phpself ?>" method="POST">
  Date:<br><input type="text" name="date" value="<?=$row_date ?>"><p>
 <textarea style=" min-width:700px;min-height:300px;" name="addtext" cols=63 rows=10 wrap="hard"><?=$row_text ?></textarea>  
 <br><input class="btn btn-large btn-primary" type="submit" value="Apply">
  <a class="btn btn-success" href="index.php">Admin center</a>
  <?php  
   }
?>
</body>
</html> 
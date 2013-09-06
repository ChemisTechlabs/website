<?php
include "../head.php";
?>
  <script type="text/javascript">
tinymce.init({
    selector: "textarea",
  plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ]
 });
</script>
<?php
include "../functions.php";
if(!isLoggedIn()) {
	show_login();
} else {

	if(!isAdmin()) {

		//user is logged in but a regular user
		echo "<h2 align=\"center\">Sorry, this page is for administrators only</h2>";

	} else {
$date = date("d.m.Y H:i:s");
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
	        print "<p><center>The news has been added successfully!<p>\n<a href=\"add.php\">Add more</a><br>\n<a href=\"index.php\">Admin center</a><br />\n<a href=\"../\">Site</a>\n";
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
	<div class="container">
   <div class="row">
    <div class="col-lg-10">	
<form name="addform" action="<?=$phpself ?>" method="POST"> 
 <textarea style=" min-width:700px;min-height:300px;" name="addtext" wrap="hard"></textarea>  
 <br><input class="btn btn-large btn-primary" type="submit" value="Add news">  
 <a class="btn btn-success" href="index.php">Admin center</a>
   </div>
   </div>
   </div>    
 <?php
 }
 }
 }
?>
</body>
</html>
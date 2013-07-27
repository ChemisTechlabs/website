<?PHP    
    $path = '../nightly/';
    $d=@opendir($path);
    if(!$d) die("Каталог ".$path." не найден!");
    $s=0;
    while($e=readdir($d)){
    if(is_file($path."/".$e)) $s++;
    }
     print "<span class=\"badge\">$s</div>";
?>



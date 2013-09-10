<?php
include "functions.php";
include "langs.php";
       if (offline()) {
          show_login();
         } else {
echo "<div class=\"alert alert-info\">".$lang['O_AUTH']."</div><hr>";
}
include "foot.php";
 ?>

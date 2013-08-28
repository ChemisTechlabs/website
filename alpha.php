<?php
include_once 'langs.php';
include "functions.php";
include 'head.php';
if (!isLoggedIn()) {
    show_login();
} else {
?>
<?php
include 'menu_bar.php';
?>
        <div class="container">
            <div class="row">
                <div class="col-8">                   
                    <h1><? echo $lang['A_TITLE'] ?></h1>
                    <div class="col-lg-2">   
                        <img src="img/alpha.png" alt="Alpha">
                    </div>
                    <br>
                    <h2>
                    <? echo $lang['A_SLOGAN'] ?>
                    </h2>
                    <h4>  
                    <? echo $lang['A_SLOGAN2'] ?>
                    </h4>
                       <?
                    echo "<form method=\"POST\" action=\"" . $_SERVER[PHP_SELF] . "\">
                    <input type=\"submit\" name=\"submit\" class=\"btn btn-outline btn-lg\"value=\"".$lang['A_BTN']."\">";
                   ?>
                </div>
                <hr>
                <center>
                    <?
                    if ($_POST[submit]) {
                        $result = mysql_query("SELECT * FROM $alpha_table WHERE username='" . $user . "'");
                        if (mysql_num_rows($result) > 0) {
                            echo "<span class=\"label label-warning\">".$lang['A_ALREADY']."</span>";
                        } else {
                     $result = mysql_query("INSERT INTO $alpha_table  (ip, username, date, status)  VALUES ('$ip_address','$user','$date','0')");
                     }
                    }
                    $result = @mysql_query("SELECT * FROM $alpha_table where username='" . $user . "'");
                    while ($row = mysql_fetch_array($result)) {
                        if ($row[status] == 1) {
                            $ds = "<h4><span class=\"label label-danger\">".$lang['A_NO']."</span></h4>";
                        } else if ($row[status] == 2) {
                            $ds = "<h4><span class=\"label label-success\">".$lang['A_YES']."</span></h4><br>
					 <a href=\"" . $alpha_chemis . "\"  class=\"btn btn-success btn-lg\">".$lang['A_DOWNLOAD']."</a>";
                        } else if ($row[status] == 0) {
                            $ds = "<h4><span class=\"label label-default\">".$lang['A_WAIT']."</span></h4>";
                        }
                    }
                }
                ?>
     <? echo "$ds"; ?>
        </div>
    </div>
<?
include 'foot.php';
?>
</body>
</html>
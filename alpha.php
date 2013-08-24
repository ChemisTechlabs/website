<?php
include "functions.php";
include 'head.php';
if (!isLoggedIn()) {
    show_login();
} else {
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.carousel').carousel({interval: 5000});
        });
    </script>
    <body> 	   
        <?php
        include 'menu_bar.php';
        ?>
        <div class="container">
            <div class="row">
                <div class="col-8">                   
                    <h1>Unit AlphaTest</h1>
                    <div class="col-lg-2">   
                        <img src="img/alpha.png" alt="Alpha">
                    </div>
                    <br>
                    <h2>ChemisProject has a division focused on testing.</h2>
                    <h4>  
                        It's called by <strong>AlphaLab</strong> and has its own atmosphere and culture.
                    </h4>
                    <!--a href="?add=add"  class="btn btn-default btn-lg">Join now!</a-->
                    <?
                    //if($_GET[add]) {
                    echo "<form method=\"POST\" action=\"" . $_SERVER[PHP_SELF] . "\">
                    <input type=\"submit\" name=\"submit\" class=\"btn btn-primary btn-lg\"value=\"Join the team\">";
                    //}
                    ?>
                </div>
                <hr>
                <center>

                    <?
                    if ($_POST[submit]) {
                        $result = mysql_query("SELECT * FROM $alpha_table WHERE username='" . $user . "'");
                        if (mysql_num_rows($result) > 0) {
                            echo "<span class=\"label label-warning\">You have already applied! Wait for the administration's decision</span>";
                        } else {
                            $result = mysql_query("INSERT INTO $alpha_table  (ip, username, date, status)  VALUES ('$ip_address','$user','$date','2')");
                        }
                    }
                    $result = @mysql_query("SELECT * FROM $alpha_table where username='" . $user . "'");
                    while ($row = mysql_fetch_array($result)) {
                        if ($row[status] == 1) {
                            $ds = "<h4><span class=\"label label-danger\">Administration is not your application and you can download the Chemis-alpha.</span></h4>";
                        } else if ($row[status] == 2) {
                            $ds = "<h4><span class=\"label label-success\">Administration has approved your request and you can download the Chemis-alpha.</span></h4><br>
					 <a href=\"" . $alpha_chemis . "\"  class=\"btn btn-success btn-lg\">Download ChemisDesktop Alpha</a>";
                        } else if ($row[status] == 0) {
                            $ds = "<h4><span class=\"label label-default\">Your request is under consideration by the administration.</span></h4>";
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
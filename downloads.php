 <?php
 include_once 'langs.php';
 include "functions.php";
 include 'head.php';
 include 'menu_bar.php';
 ?>
        <div class="container">
            <div class="row">
                <div class="col-8">  

                    <?
                    if ($_POST[submit]) {
                        if (!isLoggedIn()) {
                            $result = mysql_query("INSERT INTO $download_table  (ip, date, nl)  VALUES ('$ip_address','$date','1')");
                            header("location: $chemis");
                        } else {
                            $result = mysql_query("INSERT INTO $download_table  (ip, username, date)  VALUES ('$ip_address','$user','$date')");
                            header("location: $chemis");
                        }
                    }
                    ?>
                    <center>

                        <form method="POST" action="<? echo $_SERVER['PHP_SELF']; ?>">
                            <input type="submit" name="submit" class="btn btn-outline btn-lg" value="<?php echo $lang['D_DOWNLOAD']; ?>">
                        </form>	
                    </center>
                </div>
            </div>
            <hr>
            <div class="col-xs-6 col-md-6">                  
                <center><h3><?php echo $lang['D_CAL']; ?></h3> 
                    <img src="img/calendar.png" class="img-responsive"/> 
            </div>
            <div class="col-xs-6 col-md-6">    
                <center> <h3><?php echo $lang['D_LOC']; ?></h3>       
                    <img src="img/lock.png" class="img-responsive"/>
            </div>
            <div class="col-xs-6 col-md-6">
                <center><h3><?php echo $lang['D_CALK']; ?></h3>
                    <img src="img/calculator.png" class="img-responsive"/> 
            </div>
            <div class="col-xs-6 col-md-6">
                <center><h3><?php echo $lang['D_USERS']; ?></h3>
                    <img src="img/user.png" class="img-responsive"/>  
            </div>          
        </div>


        <?php
        include 'foot.php';
        ?>
    </body>
</html>

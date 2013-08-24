<!DOCTYPE html>
<html lang="en">
    <?php
    include "functions.php";
    include 'head.php';
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
                            <input type="submit" name="submit" class="btn btn-outline btn-lg" value="Download Chemis">
                        </form>	
                    </center>
                </div>
            </div>
            <hr>
            <div class="col-xs-6 col-md-6">                  
                <center><h3>Chemis is constantly updated</h3> 
                    <img src="img/calendar.png" class="img-responsive"/> 
            </div>
            <div class="col-xs-6 col-md-6">    
                <center> <h3>Our products are protected</h3>       
                    <img src="img/lock.png" class="img-responsive"/>
            </div>
            <div class="col-xs-6 col-md-6">
                <center><h3>With Chemis you'll have the most accurate results</h3>
                    <img src="img/calculator.png" class="img-responsive"/> 
            </div>
            <div class="col-xs-6 col-md-6">
                <center><h3>We care about users</h3>
                    <img src="img/user.png" class="img-responsive"/>  
            </div>          
        </div>


        <?php
        include 'foot.php';
        ?>
    </body>
</html>

<html>

    <?php
    include "functions.php";
    include "head.php";
    include "langs.php";
    ?>
    <body>
        <div class="container">
            <?php
            if (offline()) {

                global $users_table, $sess_name;
                ?>

                <center>
                    <a href="index.php"><img src="img/logo.png" class="img-responsive"/></a>
                </center>
                <div class="row">
                    <div class="col-md-3 col-md-offset-5">

                        <?php
                        if ($_GET[action] == "logout") {
                            logout();
                        }

                        //if user is not logged in, show the login form
                        if (!isLoggedIn()) {

                            if (!isset($_POST[submit])) {
                                //do nothing
                            } else if (isset($_POST[submit]) && empty($_POST[username]) or empty($_POST[password])) {
                                echo "<span class=\"label label-danger\">Please enter a username/password to login</span>";
                            } else if (isset($_POST[submit]) && !empty($_POST[username]) && !empty($_POST[password])) {
                                // Validate their login
                                $result = @mysql_query("SELECT * FROM $users_table WHERE username='" . $_POST[username] . "' AND password='" . md5($_POST[password]) . "'");

                                if (mysql_num_rows($result) < 1) {
                                    //not in database
                                    echo "<span class=\"label label-danger\">Invalid username or password combination</span>";
                                } else {
                                    //entered correct, create session and refresh page
                                    $_SESSION[$sess_name] = $_POST[username];
                                    header("Location: index.php");
                                }
                            }
                        }
                        ?>

                        <form method="POST" action="<?php $_SERVER[PHP_SELF] ?>">
                            <a href="join.php" class="pull-right">Registration</a>
                            <h2>Login</h2>
                            <h5>User name</h5>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                            <h5>Password</h5>
                            <input type="password" name="password" class="form-control" placeholder="Password">	
                            <br>									
                            <input type="submit" class="btn btn-large btn-outline btn-block form-control" name="submit" value="Submit">
                        </form>

                    </div>
                </div>


                <?php
                include 'foot.php';
                ?>
            </div>
        </body>
        <?php
    } else {
        echo "<div class=\"alert alert-info\">  " . $lang['O_AUTH'] . " </div><hr>";
    }
    ?>
</html>
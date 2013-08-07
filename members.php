<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8">
        <title>Chemis-app</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Никита Бережной" >
        <!--Css-->    
        <link href="css/style.css" rel="stylesheet"> 
        <link rel="shortcut icon" href="css/favicon.ico"> 
        <!--java-->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
    </head>    	 
    <body>
        <div class="row-fluid">
            <div class="span10">
                <img src="img/logo.png">
            </div>    
            <div class="span2">	
                <i style="color:#800080; font-size: large;"> Facebook</i>	
                <a href="https://www.facebook.com/chemisproject" target="_blank"><img src="img/fb.png" alt="Facebook"></a>
                <i style="color:#800080; font-size: large;">Vkontakte</i>
                <a href="http://vk.com/chemisproject" target="_blank"><img src="img/vk.png" alt="Vkontakte"></a>
            </div> 
            <div class="span2">
                <div class="btn-group">
                    <button class="btn"><i class="icon-user"></i> 
                        <?php
                        include_once("config.php");
                        checkLoggedIn("yes");
                        print($_SESSION["login"]);
                        ?>
                    </button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Действие</a></li>
                        <li><a href="#">Другое действие</a></li>
                        <li><a href="#">Еще и еще</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>






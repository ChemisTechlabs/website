<?php   
    
    $admin_login = "nikitoshi"; //Логин Администратора
    $admin_password = "199816";   //пароль Админнистратора
    
    $dbhost = "localhost";  //Сервер БД (в 90% случаев это localhost)
    $dbname = "chemis";       //название БД
    $dbuser = "lomuz";       //пользователь БД   
    $dbpass = "199816"; //Пароль пользователя БД

    mysql_connect($dbhost, $dbuser, $dbpass);     //Не Изменять!
    mysql_select_db($dbname);                     //Не Изменять!
    
?>
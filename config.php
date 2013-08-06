<?php
# Запуск сессии
session_start();
# Служит для отладки, показывает все ошибки, предупреждения и т.д.
error_reporting(E_ALL);
# Подключение файлов с функциями
include_once("functions.php");
# В этом массиве далее мы будем хранить сообщения системы, т.е. ошибки.
$messages=array();
# Данные для подключения к БД
$dbhost="localhost";
$dbuser="lomuz";
$dbpass="199816";
$dbname="chemis";
# Вызываем функцию подключения к БД
connectToDB();
?>
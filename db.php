<?php
//Подключение к базе данных
$mysqli = mysqli_connect('localhost', 'root', '', 'log', "3306");
$db_table = "history";
if(mysqli_connect_errno()){
    echo "Ошибка в подключении к базе данных";
}
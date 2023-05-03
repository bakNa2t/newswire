<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "techart_news";

$link = mysqli_connect($host, $user, $password, $database);

if (!$link) {
    echo 'Ошибка соединения с базой данных "techart-news". <br>';
    echo mysqli_connect_error();
    exit;
}

?>
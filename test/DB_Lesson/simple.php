<?php


$link = mysqli_connect('localhost', 'mysql', 'mysql');//ПОДКЛЮЧИЛИСЬ

//Получить все базы данных
/**
    $databasesQuery = mysqli_query($link, "SHOW DATABASES;");
    $userFriendlyResult = mysqli_fetch_all($databasesQuery);
    var_dump($userFriendlyResult);
*/

mysqli_select_db($link, 'kostas');
$tablesQuery = mysqli_query($link, "SHOW TABLES;");
$tables = mysqli_fetch_all($tablesQuery);



mysqli_close($link);
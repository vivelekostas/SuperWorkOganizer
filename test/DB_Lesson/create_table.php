<?php

$link = mysqli_connect('localhost', 'mysql', 'mysql', 'kostas');//ПОДКЛЮЧИЛИСЬ k DB KOSTAS


$createTableSql = 
    "CREATE TABLE
        `tasks` (
            `id` MEDIUMINT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `category` VARCHAR(255),
            `status` SMALLINT(6) NOT NULL,
            PRIMARY KEY(`id`)
        );";

$tableQuery = mysqli_query($link, $createTableSql);


if ( $tableQuery != false ) {
    $tablesQuery = mysqli_query($link, "SHOW TABLES;");
    $tables = mysqli_fetch_all($tablesQuery);
    var_dump($tables);
} else {
    echo 'Всё пропало';
}

mysqli_close($link);
<?php


//Пока оставить в текущем, не интерактивном варианте из-за сложности исполнения

$link = mysqli_connect('localhost', 'mysql', 'mysql', 'kostas');//ПОДКЛЮЧИЛИСЬ k DB KOSTAS

//пере-ая с SQL коммандой для создания новой таблицы
$createTableSql =
    "CREATE TABLE
        `murcha` (
            `id` MEDIUMINT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `category` VARCHAR(255),
            `status` SMALLINT(6) NOT NULL,
            PRIMARY KEY(`id`)
        );";

//создаёт новую таблицу
$tableQuery = mysqli_query($link, $createTableSql);


if ( $tableQuery != false ) {
    $tablesQuery = mysqli_query($link, "SHOW TABLES;");    //выводит список всех таблиц
    $tables = mysqli_fetch_all($tablesQuery);
    var_dump($tables);
} else {
    echo 'Всё пропало';
}

mysqli_close($link);
<?php

class TasksDBManager {

    public function insertNewTask($newTask) {
        $mysqli = new mysqli(HOST, USERNAME, PASSWD, DBNAME); //ПОДКЛЮЧИЛИСЬ k DB KOSTAS

        $query = "INSERT INTO tasks VALUES (NULL, '"
                . $newTask->getName() . "', '"
                . $newTask->getCategory() . "', "
                . $newTask->getStatus() . ");";

        $mysqli->query($query);
        echo base64_decode('0JrQvtGB0YLRj9C9LCDRgtGLINC70YPRh9GI0LjQuSE= ');
        $mysqli->close();
    }

    public function createTableSql() {
        $mysqli = new mysqli(HOST, USERNAME, PASSWD, DBNAME);

        $createTableSql = "CREATE TABLE
        `tasks` (
            `id` MEDIUMINT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `category` VARCHAR(255),
            `status` SMALLINT(6) NOT NULL,
            PRIMARY KEY(`id`)
        );";

        $mysqli->query($createTableSql);

        $mysqli->close();
    }

    public function checkForTasks() {
        $mysqli = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
        $query = "SHOW TABLES FROM `kostas`;";
        $result = $mysqli->query($query);
        $tables = $result->fetch_all();    //получаю список всех т. из БД в виде массива 
        $mysqli->close();

        $contol = false;    //как бы "флажок"
        foreach ($tables as $name) {
            if (in_array("tasks", $name)) {    //ищет в массиве нужную т. "tasks"
                $contol = true;    //активирует флажок если tasks уже существует
            }
        }
        return $contol;    //возвращает true либо false  
    }

}

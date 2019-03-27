<?php


class TasksDBManager {

    public function insertNewTask($newTask) {
        $mysqli = new mysqli('localhost', 'mysql', 'mysql', 'kostas'); //ПОДКЛЮЧИЛИСЬ k DB KOSTAS

        $query = "INSERT INTO tasks VALUES (NULL, '"
                . $newTask->getName() . "', '"
                . $newTask->getCategory() . "', "
                . $newTask->getStatus() . ");";

        $mysqli->query($query);

        $mysqli->close();
        
    }

    public function createTableSql() {
        $mysqli = new mysqli('localhost', 'mysql', 'mysql', 'kostas');
        
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

}

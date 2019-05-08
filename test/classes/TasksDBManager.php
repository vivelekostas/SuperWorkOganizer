<?php

/**
 * Работает с задачами:
 * создаёт таблицу `tasks` и проверяет DB её наличие;
 * сохраняет в DB; выводит списки по различным категориям и статусам;
 *
 * @author User
 */
class TasksDBManager {

    private $link;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $dsn = 'mysql:host=' . Config::getHost() .
                ';dbname=' . Config::getDBname() .
                ';charset=' . Config::getCharset();
        $this->link = new PDO($dsn, Config::getUsername(), Config::getPasswd());
        return $this;
    }

    /**
     * создаёт таблицу task
     */
    public function createTableSql() {
        $sql = "CREATE TABLE
        `tasks` (
            `id` MEDIUMINT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `category` VARCHAR(255),
            `status` SMALLINT(6) NOT NULL,
            PRIMARY KEY(`id`)
        );";
        $createTableSql = $this->link->exec($sql);
        $createTableSql = null; // удаляет объект https://www.php.net/manual/ru/pdo.connections.php
    }

    /**
     * проверяет DB наличие таблицы `tasks`
     * @return boolean
     */
    public function checkForTasks() {
        $showTablesQuery = "SHOW TABLES FROM `kostas`;";
        $result = $this->link->query($showTablesQuery);
        $tables = $result->fetchAll();

        $control = false;
        foreach ($tables as $name) {
            if (in_array('tasks', $name)) {
                $control = true;
            }
        }
        $result = null;
        $tables = null;
        return $control;
    }

    /**
     * Сохраняет новую задачу в DB
     * @param type $Task
     * @return boolean
     */
    public function insertNewTask($Task) {
        $insertQuery = "INSERT INTO `tasks` VALUES (?, ?, ?, ?);";
               
        $stmtPrepareQuery = $this->link->prepare($insertQuery);
        $stmtPrepareQuery->execute([null, $Task->getName(),$Task->getCategory(),$Task->getStatus()]);
        $stmtPrepareQuery = null;

        return true;
    }

    /**
     * возвращает массив всех задач 
     * @return type
     */
    public function getAllTasks() {
        $showAllQuery = "SELECT * FROM `tasks`;";
        $showAllTasks = $this->link->query($showAllQuery);
        $arrayOfTasks = $showAllTasks->fetchAll();
        $showAllTasks = null;
        return $arrayOfTasks;
    }

    /**
     * возвращает массив всех актуальных(рабочих) задач 
     * @return type
     */
    public function getAllActualTasks() {
        $showAllActualQuery = "SELECT * FROM `tasks` WHERE `status` < ?;";
        $stmtPrepareQuery = $this->link->prepare($showAllActualQuery);
        $stmtPrepareQuery->execute(['3']);
        $arrayOfAllActual = $stmtPrepareQuery->fetchAll(PDO::FETCH_ASSOC);
        $stmtPrepareQuery = null;
        return $arrayOfAllActual;
    }

    /**
     * возвращает массив всех готовых задач
     * @return type
     */
    public function getAllFinishedTasks() {
        $showAllFinishedQuery = "SELECT * FROM `tasks` WHERE `status` = ?;";
        $stmtPrepareQuery = $this->link->prepare($showAllFinishedQuery);
        $stmtPrepareQuery->execute(['3']);
        $arrayOfAllFinished = $stmtPrepareQuery->fetchAll(PDO::FETCH_ASSOC);
        $stmtPrepareQuery = null;
        return $arrayOfAllFinished;
    }

    /**
     * возвращает массив всех актуальных простых задач
     * @return type
     */
    public function getAllActualSimple() {
        $showActualSimpleQuery = "SELECT * FROM `tasks` WHERE `status` = ? AND `category` = ?;";
        $stmtPrepareQuery = $this->link->prepare($showActualSimpleQuery);
        $stmtPrepareQuery->execute(['1', 'simple']);
        $arrayOfActualSimple = $stmtPrepareQuery->fetchAll(PDO::FETCH_ASSOC);
        $stmtPrepareQuery = null;
        return $arrayOfActualSimple;
    }

    /**
     * возвращает массив всех актуальных сложных задач
     * @return type
     */
    public function getAllActualComplex() {
        $showActualComplexQuery = "SELECT * FROM `tasks` WHERE `status` = ? AND `category` = ?;";
        $stmtPrepareQuery = $this->link->prepare($showActualComplexQuery);
        $stmtPrepareQuery->execute(['1', 'complex']);
        $arrayOfActualComplex = $stmtPrepareQuery->fetchAll(PDO::FETCH_ASSOC);
        $stmtPrepareQuery = null;
        return $arrayOfActualComplex;
    }

    /**
     * возвращает массив всех еженедельных задач
     * @return type
     */
    public function getAllWeekly() {
        $allWeeklyQuery = "SELECT * FROM `tasks` WHERE `category` = ?;";
        $stmtPrepareQuery = $this->link->prepare($allWeeklyQuery);
        $stmtPrepareQuery->execute(['weekly']);
        $arrayOfAllWeekly = $stmtPrepareQuery->fetchAll(PDO::FETCH_ASSOC);
        $stmtPrepareQuery = null;
        return $arrayOfAllWeekly;
    }

    /**
     * возвращает массив всех простых задач
     * @return type
     */
    public function allSimple() {
        $allSimpleQuery = "SELECT * FROM `tasks` WHERE `category` = ?;";
        $stmtPrepareQuery = $this->link->prepare($allSimpleQuery);
        $stmtPrepareQuery->execute(['simple']);
        $arrayOfAllSimple = $stmtPrepareQuery->fetchAll(PDO::FETCH_ASSOC);
        $stmtPrepareQuery = null;
        return $arrayOfAllSimple;
    }

    /**
     * возвращает массив всех сложных задач
     * @return type
     */
    public function allComplex() {
        $allComplexQuery = "SELECT * FROM `tasks` WHERE `category` = ?;";
        $stmtPrepareQuery = $this->link->prepare($allComplexQuery);
        $stmtPrepareQuery->execute(['complex']);
        $arrayOfAllComplex = $stmtPrepareQuery->fetchAll(PDO::FETCH_ASSOC);
        $stmtPrepareQuery = null;
        return $arrayOfAllComplex;
    }

}

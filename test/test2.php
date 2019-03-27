<?php

require_once ("./classes/Task.php");
require_once ('./classes/TasksManager.php');
require_once ('./classes/TasksDBManager.php');

echo 'Хотите создать новую задачу? y/n: ';
$task = readline();
if ($task === "y") {
    echo "Название задачи: ";
    $name = readline("Название задачи: ");
    echo "Укажите категорию: ";
    $category = readline("Укажите категорию: ");
    echo "Укажите статус: ";
    $status = readline("Укажите статус: ");
    $newTask = new Task($name, $category, $status);    //создаёт новую задачу
} elseif ($task === "n") {
    echo "Зря :(";
    die();
} else {
    echo 'ИДИ В БАНЮ ДОЛБАНЫЙ ХАЦКЕР';
    die();
}

echo "Куда сохранить новую задачу: в DB или file? ";
$save = readline();
if ($save === "DB") {
//  БЛОК ПРОВЕРКИ БД на существование т. "tasks" 
    $mysqli = new mysqli('localhost', 'mysql', 'mysql', 'kostas'); 
    $query = "SHOW TABLES FROM `kostas`;";
    $result = $mysqli->query($query);
    $tables = mysqli_fetch_all($result, MYSQLI_NUM);    //получаю список всех т. из БД в виде массива


    $contol_array = array();    //как бы "флажок"
    foreach ($tables as $name) {
        if (in_array("tasks", $name)) {    //ищет в массиве нужную т. "tasks"
            array_push($contol_array, "tasks");    //активирует флажок если tasks уже существует
        }
//  КОНЕЦ БЛОКА ПРОВЕРКИ БД
        
    } if ($contol_array == true) {    //вып-ся если флажок активен - просто добавляет нвоую задачу
        $newTasksDBManager = new TasksDBManager();
        $newTasksDBManager->insertNewTask($newTask);
        echo 'Задача успешно сохранена в DB';
    } if ($contol_array == false) {    //вып-ся если флажок не активен - сначала создаёт т., а потом добавляет
        $newTable = new TasksDBManager();
        $newTable->createTableSql();
        $newTasksDBManager = new TasksDBManager();
        $newTasksDBManager->insertNewTask($newTask);
        echo 'Задача успешно сохранена в DB';
    }
} elseif ($save === "file") {
    $newTaskManager = new TasksManager();
    $newTaskManager->save($newTask);
    echo 'Задача успешно сохранена в соотвестфующий файл';
} else {
    echo 'ИДИ В БАНЮ ДОЛБАНЫЙ ХАЦКЕР';
    die();
}

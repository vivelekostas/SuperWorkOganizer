<?php

require_once ("./classes/Task.php");
require_once ('./classes/TasksManager.php');
require_once ('./classes/TasksDBManager.php');
require_once ('./config.php');


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
    $newCheckFor = new TasksDBManager();
    $hasTask = $newCheckFor->checkForTasks();    //проверяет DB на наличие tasks, воз-щая true/false

    if ($hasTask) {    //вып-ся если флажок активен (true) - просто добавляет новую задачу
        $newCheckFor->insertNewTask($newTask);
        echo ' Задача успешно сохранена в DB';
    } else {    //вып-ся если флажок не активен (false) - сначала создаёт т., а потом добавляет
        $newCheckFor->createTableSql();
        $newCheckFor->insertNewTask($newTask);
        echo ' Задача успешно сохранена в DB';
    }
} elseif ($save === "file") {
    $newTaskManager = new TasksManager();
    $newTaskManager->save($newTask);
    echo 'Задача успешно сохранена в соотвестфующий файл';
} else {
    echo 'ИДИ В БАНЮ ДОЛБАНЫЙ ХАЦКЕР';
    die();
}

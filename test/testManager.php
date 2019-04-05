<?php

require_once ("./classes/Task.php");
require_once ('./classes/TasksManager.php');
require_once ('./classes/TasksDBManager.php');
//require_once ('./config.php');    // подключает константы
require_once ('./classes/Config.php');    // подключает класс Config с статическими свойствами и функциями


echo 'Хотите создать новую задачу? y/n: ';
$task = readline();
if ($task === 'y') {
    echo "Название задачи: ";
    $name = readline("Название задачи: ");
    echo "Укажите категорию: ";
    $category = readline("Укажите категорию: ");
    echo "Укажите статус: ";
    $status = readline("Укажите статус: ");
    $newTask = new Task($name, $category, $status);    //создаёт новую задачу
} elseif ($task === 'n') {
    echo 'Может вы хотите посмотреть список задач? y/n ';
    $list = readline();
    if ($list === 'y') {
        $showlist = new TasksDBManager();
        $list = $showlist->showAllTasks();
    }
    echo 'вывести список построчно(s) или стобцом(c): ';
    $styleList = readline();
    if ($styleList === 's') {
        foreach ($list as $entry) {    //выводит инфо о задаче строкой
            echo ' ID: ' . $entry['id'] . ';  Название: ' . $entry['name'] . ';  Категория: ' . $entry['category'] . ';  Статус: ' . $entry['status'];
            echo PHP_EOL;
        }
        die();
    } elseif ($styleList === 'c') {
        foreach ($list as $entry) {    //выводит инфо о задаче столбцом
            echo ' ID: ' . $entry['id'] . '; ' . PHP_EOL . ' Название: ' . $entry['name'] . '; ' . PHP_EOL . ' Категория: ' . $entry['category'] . '; ' . PHP_EOL . ' Статус: ' . $entry['status'] . PHP_EOL;
            echo PHP_EOL;
        }
        die();
    }
} elseif ($list === 'n') {
    echo 'Ты сам не знаешь чего ты хочешь!!';
    die();
} else {
    echo 'ИДИ В БАНЮ ДОЛБАНЫЙ ХАЦКЕР';
    die();
}

echo "Куда сохранить новую задачу: в DB или file? ";
$save = readline();
if ($save === "DB") {
    $newTaskManager = new TasksDBManager();
    $hasTask = $newTaskManager->checkForTasks();    //проверяет DB на наличие tasks, воз-щая true/false

    if ($hasTask) {    //вып-ся если флажок активен (true) - просто добавляет новую задачу
        $newTaskManager->insertNewTask($newTask);
        echo ' Задача успешно сохранена в DB';
        die();
    } else {    //вып-ся если флажок не активен (false) - сначала создаёт т., а потом добавляет
        $newTaskManager->createTableSql();
        $newTaskManager->insertNewTask($newTask);
        echo ' Задача успешно сохранена в DB';
        die();
    }
} elseif ($save === "file") {
    $newTaskManager = new TasksManager();
    $newTaskManager->save($newTask);
    echo 'Задача успешно сохранена в соотвестфующий файл';
} else {
    echo 'ИДИ В БАНЮ ДОЛБАНЫЙ ХАЦКЕР';
    die();
}

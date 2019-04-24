<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './classes/Config.php';    
require_once './classes/TasksDBManager.php';
require_once './classes/СreateTask.php';
require_once './classes/TasksCSVManager.php';


echo 'Создать новую задачу - 1' . PHP_EOL .
 'Список всех актуальных задачь - 2' . PHP_EOL .
 'Список еженедельных задачь - 3' . PHP_EOL .
 'Список актуальных простых задачь - 4' . PHP_EOL .
 'Список актуальных сложных задачь - 5' . PHP_EOL .
 'Список всех готовых задачь - 6' . PHP_EOL .
 'Ввод: ';

$var = readline();
if ($var === '1') {
    echo "Название задачи: ";
    $name = readline();
    echo "Укажите категорию weekly/simple/complex: ";
    $category = readline();
    echo "Укажите статус: 1(текущая)/2(еженедельная)/3(готовая): ";
    $status = readline();
    
    $newTask = new СreateTask($name, $category, $status);

    echo "Куда сохранить новую задачу: в DB или file? ";
    $save = readline();
    if ($save === "DB") {
        $newTaskSaver = new TasksDBManager();
        $dis = $newTaskSaver->Display($newTask);
        $hasTask = $newTaskSaver->checkForTasks();    //проверяет DB на наличие tasks, воз-щая true/false

        if ($hasTask) {    //вып-ся если флажок активен (true) - просто добавляет новую задачу
            $newTaskSaver->insertNewTask($newTask);
            echo ' Задача успешно сохранена в DB';
            die();
        } else {    //вып-ся если флажок не активен (false) - сначала создаёт т., а потом добавляет
            $newTaskSaver->createTableSql();
            $newTaskSaver->insertNewTask($newTask);
            echo ' Задача успешно сохранена в DB';
            die();
        }
    } elseif ($save === "file") {
        $newTaskSaver = new TasksCSVManager();
        $newTaskSaver->save($newTask);
        echo 'Задача успешно сохранена в соотвестфующий файл';
        die();
    }
} elseif ($var === '2') {
    $showActualTasks = new TasksDBManager();
    $listOfActual = $showActualTasks->showAllActualTasks();
    foreach ($listOfActual as $entry) {    //выводит инфо о задаче строкой
        echo ' ID: '
        . $entry['id'] .
        ';  Название: '
        . $entry['name'] .
        ';  Категория: '
        . $entry['category'] .
        ';  Статус: '
        . $entry['status'];
        echo PHP_EOL;
    }
    die();
} elseif ($var === '3') {
    $showWeekly = new TasksDBManager();
    $listOfWeekly = $showWeekly->allWeekly();
    foreach ($listOfWeekly as $entry) {    //выводит инфо о задаче строкой
        echo ' ID: '
        . $entry['id'] .
        ';  Название: '
        . $entry['name'] .
        ';  Категория: '
        . $entry['category'] .
        ';  Статус: '
        . $entry['status'];
        echo PHP_EOL;
    }
    die();
} elseif ($var === '4') {
    $showSimple = new TasksDBManager();
    $listOfSimple = $showSimple->allActualSimple();
    foreach ($listOfSimple as $entry) {    //выводит инфо о задаче строкой
        echo ' ID: '
        . $entry['id'] .
        ';  Название: '
        . $entry['name'] .
        ';  Категория: '
        . $entry['category'] .
        ';  Статус: '
        . $entry['status'];
        echo PHP_EOL;
    }
    die();
} elseif ($var === '5') {
    $showComplex = new TasksDBManager();
    $listOfComplex = $showComplex->allActualComplex();
    foreach ($listOfComplex as $entry) {    //выводит инфо о задаче строкой
        echo ' ID: '
        . $entry['id'] .
        ';  Название: '
        . $entry['name'] .
        ';  Категория: '
        . $entry['category'] .
        ';  Статус: '
        . $entry['status'];
        echo PHP_EOL;
    }
    die();
} elseif ($var === '6') {
    $showFinished = new TasksDBManager();
    $listOfFinished = $showFinished->showAllFinishedTasks();
    foreach ($listOfFinished as $entry) {    //выводит инфо о задаче строкой
        echo ' ID: '
        . $entry['id'] .
        ';  Название: '
        . $entry['name'] .
        ';  Категория: '
        . $entry['category'] .
        ';  Статус: '
        . $entry['status'];
        echo PHP_EOL;
    }
    die();
}

//=======================================================





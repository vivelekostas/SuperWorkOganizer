<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './classes/Config.php'; 
require_once './classes/Task.php';
require_once './classes/TasksDBManager.php';
require_once './classes/TasksCSVManager.php';
require './vendor/autoload.php';

use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\ConsoleOutput;


echo 'Создать новую задачу - 1' . PHP_EOL .
 'Список всех актуальных задач - 2' . PHP_EOL .
 'Список еженедельных задач - 3' . PHP_EOL .
 'Список актуальных простых задач - 4' . PHP_EOL .
 'Список актуальных сложных задач - 5' . PHP_EOL .
 'Список всех готовых задач - 6' . PHP_EOL .
 'Ввод: ';

$output = new ConsoleOutput();

$var = readline();
if ($var === '1') {
    echo "Название задачи: ";
    $name = readline();
    echo "Укажите категорию weekly/simple/complex: ";
    $category = readline();
    echo "Укажите статус: 1(текущая)/2(еженедельная)/3(готовая): ";
    $status = readline();
    
    try {
        $Task = new Task($name, $category, $status);
        $output->writeln('<info>Норм, задача есть.</info>');
    } catch (Exception $exc) {
        $output->writeln('<error>' . $exc->getMessage() . '</error>');
        $output->writeln($exc->getTraceAsString());
        die();
    }

    echo "Куда сохранить новую задачу: в DB или file? ";
    $save = readline();
    if ($save === "DB") {
        $newTaskSaver = new TasksDBManager();
        display($Task);
        $hasTask = $newTaskSaver->checkForTasks();    //проверяет DB на наличие tasks, воз-щая true/false

        if ($hasTask) {    //вып-ся если флажок активен (true) - просто добавляет новую задачу
            $newTaskSaver->insertNewTask($Task);
            echo ' Задача успешно сохранена в DB';
            die();
        } else {    //вып-ся если флажок не активен (false) - сначала создаёт т., а потом добавляет
            $newTaskSaver->createTableSql();
            $newTaskSaver->insertNewTask($Task);
            echo ' Задача успешно сохранена в DB';
            die();
        }
    } elseif ($save === "file") {
        $newTaskSaver = new TasksCSVManager();
        $newTaskSaver->save($Task);
        echo 'Задача успешно сохранена в соотвестфующий файл';
        die();
    }
} elseif ($var === '2') {
    $showActualTasks = new TasksDBManager();
    $listOfActual = $showActualTasks->getAllActualTasks();
    $table = new Table($output);
    $table
            ->setHeaders(array('id', 'Название', 'Категория', 'Статус'))
            ->setRows($listOfActual);
    $table->render();
    die();
    
} elseif ($var === '3') {
    $showWeekly = new TasksDBManager();
    $listOfWeekly = $showWeekly->getAllWeekly();
    $table = new Table($output);
    $table
            ->setHeaders(array('id', 'Название', 'Категория', 'Статус'))
            ->setRows($listOfWeekly);
    $table->render();
    die();
    
} elseif ($var === '4') {
    $showSimple = new TasksDBManager();
    $listOfSimple = $showSimple->getAllActualSimple();
    $table = new Table($output);
    $table
            ->setHeaders(array('id', 'Название', 'Категория', 'Статус'))
            ->setRows($listOfSimple);
    $table->render();
    die();
    
} elseif ($var === '5') {
    $showComplex = new TasksDBManager();
    $listOfComplex = $showComplex->getAllActualComplex();
    $table = new Table($output);
    $table
            ->setHeaders(array('id', 'Название', 'Категория', 'Статус'))
            ->setRows($listOfComplex);
    $table->render();
    die();
    
} elseif ($var === '6') {
    $showFinished = new TasksDBManager();
    $listOfFinished = $showFinished->getAllFinishedTasks();
    $table = new Table($output);
    $table
            ->setHeaders(array('id', 'Название', 'Категория', 'Статус'))
            ->setRows($listOfFinished);
    $table->render();
    die();
}

//=======================================================
/**
 * возвращает инфо о новой задаче
 * @param type $Task
 */
function display($Task) {
        echo 'НОВАЯ ЗАДАЧА' . PHP_EOL;
        echo "Название: {$Task->getName()}" . PHP_EOL;
        echo "Категория: {$Task->getCategory()}" . PHP_EOL;
        echo "Статус: {$Task->getStatus()}" . PHP_EOL;
    }



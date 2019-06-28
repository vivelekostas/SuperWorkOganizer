<?php

require_once '../classes/Config.php';
require_once '../classes/Task.php';
require_once '../classes/TasksDBManager.php';
require_once '../classes/TasksCSVManager.php';
require '../vendor/autoload.php';

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

$actionId = readline();
if ($actionId === '1') {
    echo "Название задачи: ";
    $name = readline();
    echo "Укажите категорию weekly/simple/complex: ";
    $category = readline();
    echo "Укажите статус: 1(текущая)/2(еженедельная)/3(готовая): ";
    $status = readline();
    
    try {
        $task = new Task($name, $category, $status);
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
        display($task);
        $hasTask = $newTaskSaver->checkForTasks();    //проверяет DB на наличие tasks, воз-щая true/false

        if ($hasTask) {    //вып-ся если флажок активен (true) - просто добавляет новую задачу
            $newTaskSaver->insertNewTask($task);
            echo ' Задача успешно сохранена в DB';
            die();
        } else {    //вып-ся если флажок не активен (false) - сначала создаёт т., а потом добавляет
            $newTaskSaver->createTableSql();
            $newTaskSaver->insertNewTask($task);
            echo ' Задача успешно сохранена в DB';
            die();
        }
    } elseif ($save === "file") {
        $newTaskSaver = new TasksCSVManager();
        $newTaskSaver->save($task);
        echo 'Задача успешно сохранена в соответствующий файл';
        die();
    }
} elseif ($actionId === '2') {
    $tasksManager = new TasksDBManager();
    $listOfActual = $tasksManager->getAllActualTasks();
    $table = new Table($output);
    $table
            ->setHeaders(array('id', 'Название', 'Категория', 'Статус'))
            ->setRows($listOfActual);
    $table->render();
} elseif ($actionId === '3') {
    $showWeekly = new TasksDBManager();
    $listOfWeekly = $showWeekly->getAllWeekly();
    $table = new Table($output);
    $table
            ->setHeaders(array('id', 'Название', 'Категория', 'Статус'))
            ->setRows($listOfWeekly);
    $table->render();
} elseif ($actionId === '4') {
    $taskManager = new TasksDBManager();
    $listOfSimple = $taskManager->getAllActualSimple();
    $table = new Table($output);
    $table
            ->setHeaders(array('id', 'Название', 'Категория', 'Статус'))
            ->setRows($listOfSimple);
    $table->render();
} elseif ($actionId === '5') {
    $taskManager = new TasksDBManager();
    $listOfComplex = $taskManager->getAllActualComplex();
    $table = new Table($output);
    $table
            ->setHeaders(array('id', 'Название', 'Категория', 'Статус'))
            ->setRows($listOfComplex);
    $table->render();
} elseif ($actionId === '6') {
    $showFinished = new TasksDBManager();
    $listOfFinished = $showFinished->getAllFinishedTasks();
    $table = new Table($output);
    $table
            ->setHeaders(array('id', 'Название', 'Категория', 'Статус'))
            ->setRows($listOfFinished);
    $table->render();
}

//=======================================================
/**
 * возвращает инфо о новой задаче
 * @param type $task
 */
function display($task)
{
    echo 'НОВАЯ ЗАДАЧА' . PHP_EOL;
    echo "Название: {$task->getName()}" . PHP_EOL;
    echo "Категория: {$task->getCategory()}" . PHP_EOL;
    echo "Статус: {$task->getStatus()}" . PHP_EOL;
}

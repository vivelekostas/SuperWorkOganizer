<?php

require_once ("./classes/Task.php");
require_once ('./classes/TasksMeneger.php');

echo 'do yo want to create-task? y/n: ';
$task = readline();
if ($task === "y") {
    echo "Название задачи: ";
    $name = readline("Название задачи: ");

    echo "Укажите категорию: ";
    $category = readline("Укажите категорию: ");

    echo "Укажите статус: ";
    $status = readline("Укажите статус: ");
    $newTask = new Task($name, $category, $status);
    
    $newTaskMeneger = new TasksMeneger();
    $newTaskMeneger->save($newTask);
    
//    echo 'КАТЕГОРИЯ созданной задачи: ' . $newTask->category;

} elseif ($task === "n") {
    echo "Зря :(";
    die();
} else {
    echo 'ИДИ В БАНЮ ДОЛБАНЫЙ ХАЦКЕР';
    die();
}












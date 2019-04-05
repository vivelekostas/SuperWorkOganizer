<?php

class TasksManager {

    public function save($newTask) {

        switch ($newTask->getCategory()) {
            case "weekly":
                $filename = './category/weekly.csv';
                break;
            case "simple":
                $filename = './category/once-only/simple.csv';
                break;
            case "complex":
                $filename = './category/once-only/complex.csv';
                break;
        }
        $dataTask = "Название: " . $newTask->getName() . "; Категория: " . $newTask->getCategory() . "; Статус: " . $newTask->getStatus() . PHP_EOL;
        file_put_contents($filename, $dataTask, FILE_APPEND);
    }

}

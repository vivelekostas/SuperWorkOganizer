<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TasksMeneger
 *
 * @author User
 */
//class TasksMeneger {
//
//    public function save($newTask) {
//        
//        if ($newTask->category === "weekly") {
//            $filename = './category/weekly.csv';
//        } elseif ($newTask->category === "simple") {
//            $filename = './category/once-only/simple.csv';
//        } elseif ($newTask->category === "complex") {
//            $filename = './category/once-only/complex.csv';
//        }
//        $dataTask = "Название: " . $newTask->name . "; Категория: " . $newTask->category . "; Статус: " . $newTask->status . PHP_EOL;
//        file_put_contents($filename, $dataTask, FILE_APPEND);
//    }
//
//}

class TasksMeneger {

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

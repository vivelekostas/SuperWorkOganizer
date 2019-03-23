<?php


class TasksDBManager {
//  Функция сохраняет новую задачу в DB
    public function insertNewTask($newTask) {
        $link = mysqli_connect('localhost', 'mysql', 'mysql', 'kostas');    //ПОДКЛЮЧИЛИСЬ k DB KOSTAS

        $query= "INSERT INTO tasks VALUES (NULL, '"    //пере-ая с корректной коммандой для SQL
                . $newTask->getName(). "', '"
                . $newTask->getCategory(). "', "
                . $newTask->getStatus(). ");";

        mysqli_query($link, $query);    //создаёт задачу
        
        mysqli_insert_id($link);    //присваевает новой задаче id

        mysqli_close($link);
    }
    
}

// Копия для переделки в ООП формат
//class TasksDBManager {
//
//    public function insertNewTask($newTask) {
//        $link = mysqli_connect('localhost', 'mysql', 'mysql', 'kostas'); //ПОДКЛЮЧИЛИСЬ k DB KOSTAS
//
//        $query= "INSERT INTO tasks VALUES (NULL, '" 
//                . $newTask->getName(). "', '"
//                . $newTask->getCategory(). "', "
//                . $newTask->getStatus(). ");";
//        
//        $insertQuery = mysqli_query($link, $query);
//        
//        mysqli_insert_id($link);
//
//        mysqli_close($link);
//    }
//    
//}

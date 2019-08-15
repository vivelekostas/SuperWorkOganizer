<?php
require_once '../classes/Config.php';
require_once '../classes/TasksDBManager.php';
?>

<!DOCTYPE html>
<html>
    
    <!--head-->
    <?php require_once './template/head.php'; ?>
    
    <body>
        
        <!--menu--> 
        <?php require_once './template/menu.php'; ?>
        <h1>Список еженедельных задач</h1>
        <div>
            <?php
            $taskManager = new TasksDBManager();
            $listOfFinished = $taskManager->getAllFinishedTasks();
            ?>
            <table class="table table-dark table-bordered table-hover table-sm">
                <caption>Список выполненых задач</caption>
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Название</th>
                    <th scope="col">Категория</th>
                    <th scope="col">Статус</th>
                </tr> 
                </thead>
                <tbody>
            <?php
            foreach ($listOfFinished as $entry) {
                echo '<tr><td>'
                . $entry['id'] .
                '</td><td>'
                . $entry['name'] .
                '</td><td>'
                . $entry['category'] .
                '</td><td>'
                . $entry['status'] .
                '</td></tr>';
            }
            ?>
                </tbody>
            </table>
        </div>

        <!--Футер-->
        <?php require_once './template/footer.php'; ?>
    </body>
</html>

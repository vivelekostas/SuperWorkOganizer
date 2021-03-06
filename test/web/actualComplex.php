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
        <div>
            <?php
            $taskManager = new TasksDBManager();
            $listOfComplex = $taskManager->getAllActualComplex();
            ?>
            <table class="table table-bordered table-hover table-sm">
                <caption>Список рабочих сложных задач</caption>
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Название</th>
                        <th scope="col">Категория</th>
                        <th scope="col">Статус</th>
                    </tr> 
                </thead>
                <tbody>
                    <?php
                    foreach ($listOfComplex as $entry) {
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



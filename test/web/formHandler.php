
<html>
    <?php
    require_once './template/head.php';
    ?>
    <body>

        <?php
        require_once './config.php';
        require_once '../classes/Config.php';
        require_once '../classes/Task.php';
        require_once '../classes/TasksDBManager.php';
        ?>
        <!--menu--> 
        <?php require_once './template/menu.php'; ?> 

        <?php
        try {
            $task = new Task($_POST[TASK_NAME_KEY], $_POST[CATEGORY_KEY], $_POST[STATUS_KEY]);
            $insert = new TasksDBManager();
            $hasTask = $insert->checkForTasks();
            if ($hasTask) {    //вып-ся если флажок активен (true) - просто добавляет новую задачу
                $insert->insertNewTask($task);
                echo '<h3>Задача успешно создана! <span class="badge badge-secondary">Done!</span></h3>';
                display($task);
            } else {    //вып-ся если флажок не активен (false) - сначала создаёт т., а потом добавляет
                $insert->createTableSql();
                $insert->insertNewTask($task);
                echo ' Задача успешно сохранена в DB';
                display($task);
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        ?>

        <?php
        function display($task)
        {
            echo '<h4><span class="badge badge-secondary">НОВАЯ ЗАДАЧА</span></h4>';
            echo "Название: {$task->getName()} <br>";
            echo "Категория: {$task->getCategory()} <br>";
            echo "Статус: {$task->getStatus()} <br>";
        }
        ?>

        <br>
        <br>

        <?php require_once './template/footer.php'; ?>
    </body>
</html>
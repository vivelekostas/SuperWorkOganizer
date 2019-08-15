<?php
require_once './config.php';
?>
<!DOCTYPE html>
<html>
    <!--head-->
    <?php require_once './template/head.php'; ?>
    <body>
        <!--menu--> 
        <?php require_once './template/menu.php'; ?> 
        <div class="content">
            <div><?php echo date('Y-d-m H:i:s'); ?></div>

            <!--форма создания новой задачи-->
            <?php require_once './template/createTaskForm.php';?>
        </div>
        <br>
        <br>
        <!--Футер-->
        <?php require_once './template/footer.php'; ?>
    </body>
</html>

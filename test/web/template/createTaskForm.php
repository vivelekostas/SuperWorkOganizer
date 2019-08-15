<!--форма))-->
<div class="container">
    <div class="row">
        <div class="col-lg-4 form-container">
            <h2>Новая задача</h2>
            <form role="form" method="POST" action="formHandler.php">
                <div class="form-group">
                    <label for="taskname"><h5>Название задачи</h5></label>
                    <input name="<?php echo TASK_NAME_KEY ?>" type="text" class="form-control" placeholder="Введите название задачи">
                    <p class="help-block">Да придумай любое название уже!</p>
                </div>
                <div class="form-group">
                    <label for="category"><h5>Категория задачи</h5></label><br>
                    <input name="<?php echo CATEGORY_KEY ?>" type="radio" value="weekly"> Еженедельная
                    <input name="<?php echo CATEGORY_KEY ?>" type="radio" value="simple"> Простая
                    <input name="<?php echo CATEGORY_KEY ?>" type="radio" value="complex"> Сложная <br>
                    <!--<p class="help-block">Выбери одну категорию!</p>-->
                </div>
                <div class="form-group">
                    <label for="<?php echo STATUS_KEY ?>"><h5>Статус задачи</h5></label>
                    <select name="status" class="custom-select">
                        <option value="1">Новая</option>
                        <option value="2">Еженедельная</option>
                        <option value="3">Готовая</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Создать задачу</button>
            </form>
        </div>
    </div>
</div>
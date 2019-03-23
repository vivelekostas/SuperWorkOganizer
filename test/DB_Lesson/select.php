<?php

$link = mysqli_connect('localhost', 'mysql', 'mysql', 'kostas'); //ПОДКЛЮЧИЛИСЬ k DB KOSTAS

$selectQuery = mysqli_query($link, "SELECT * FROM tasks");
$data = mysqli_fetch_assoc($selectQuery);


var_dump($data);


mysqli_close($link);
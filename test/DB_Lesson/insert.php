<?php

//$_POST;
//$_GET;

//   4,5,6); DROP DATABASE;

$link = mysqli_connect('localhost', 'mysql', 'mysql', 'kostas'); //ПОДКЛЮЧИЛИСЬ k DB KOSTAS

$insertQuery = mysqli_query($link,
        "INSERT INTO tasks VALUES (3," . $_GET['name'] . ", 'ровная', 2);"
        );
//$data = mysqli_fetch_assoc($selectQuery);


//var_dump($data);


mysqli_close($link);
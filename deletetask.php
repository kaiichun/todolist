<?php

    $todolist = [];

    $host = 'devkinsta_db';
    $dbname = 'ToDoList';
    $dbuser = 'root';
    $dbpassword = 'GBhUwpF3t3QzDYbo';
    $database = new PDO("mysql:host=$host;dbname=$dbname",
    $dbuser,
    $dbpassword);

    $deletetask = $_POST['deletetask'];

if(empty($deletetask)){
    echo "ERROR 404 =)";
}else{
    $sql = "DELETE FROM todolist WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'id' => $deletetask
    ]);
    header("Location: /");
}
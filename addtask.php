<?php
$todolist = [];
$host = 'devkinsta_db';
$dbname = 'ToDoList';
$dbuser = 'root';
$dbpassword = 'GBhUwpF3t3QzDYbo';
$database = new PDO(
    "mysql:host=$host;dbname=$dbname",
    $dbuser,
    $dbpassword
);

$task_name = $_POST['task_name'];
if(empty($task_name)){
    echo "ERROR 404";
}else{
    $sql = 'INSERT INTO todolist (`task`,`completed`) VALUES(:task,:completed)';
    $query = $database->prepare($sql);
    $query->execute([
        'task' => $task_name,
        'completed' => 0
    ]);
    header("Location: index.php");
    exit;
}
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

$completedtask = $_POST['completedtask'];
$deletetask = $_POST['deletetask'];

if ( $completedtask == 1 ) {
    $completedtask = 0;
} else if( $completedtask == 0 ) {
    $completedtask = 1;
}

if (empty($deletetask)){
       echo"ERROR 404 =)"; 
} else {
    $sql = 'UPDATE todolist set completed = :completed WHERE id = :id';
    // prepare
    $query = $database->prepare( $sql );
    // execute

    $query->execute([ 
        'completed' => $completedtask,
        'id' =>$deletetask
    ]); 
    header("Location: index.php");
    exit;

}
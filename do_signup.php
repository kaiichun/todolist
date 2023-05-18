<?php

    session_start();

        $host = 'devkinsta_db';
        $dbname = 'ToDoList';
        $dbuser = 'root';
        $dbpassword = 'GBhUwpF3t3QzDYbo' ;
        $database = new PDO ("mysql:host=$host;dbname=$dbname",
        $dbuser,
        $dbpassword);

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

    if (empty($name)||empty($email)||empty($password)||empty($confirm_password)){
        echo'All rows are required';
    }else if($password !== $confirm_password){
        echo'The password is not match.';
    }else if(strlen($password)<8){
        echo "your pass must be at least 8 characters";
    }else{
        $sql="INSERT INTO users (`name`,`email`,`password`) VALUES (:name,:email,:password)";
        $query=$database->prepare($sql);
        $query->execute([
            'name'=>$name,
            'email'=>$email,
            'password'=>password_hash($password, PASSWORD_DEFAULT)
        ]);

        header("Location: login.php");
        exit;
    }
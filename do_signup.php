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

        $sql = "SELECT * FROM users where email = :email";
        $query = $database->prepare( $sql );
        $query->execute([
            'email' => $email
        ]);
        $user = $query->fetch();

    if (empty($name)||empty($email)||empty($password)||empty($confirm_password)){
        $error = 'All rows are required';
    }else if($password !== $confirm_password){
        $error = 'The password is not match.';
    }else if(strlen($password)<8){
        $error = "your pass must be at least 8 characters";
    }else if ( $user ) {
        $error = "The email you interted has already been used by other user!";
    }else{
        $sql="INSERT INTO users (`name`,`email`,`password`) VALUES (:name,:email,:password)";
        $query=$database->prepare($sql);
        $query->execute([
            'name'=>$name,
            'email'=>$email,
            'password'=>password_hash($password, PASSWORD_DEFAULT)
        ]);

        header("Location: /login");
        exit;
    }

    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;
        header("Location: /signup");
        exit;
    }
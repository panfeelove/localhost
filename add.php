<?php

    define('DB_HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'cw');
    // echo "<pre>";
    // echo print_r($_POST);
    // echo "</pre>";

    $new_discipline = filter_var(trim($_POST['added_disc']),FILTER_SANITIZE_STRING);
    
    $new_group_name = filter_var(trim($_POST['added_gName']),FILTER_SANITIZE_STRING);
    $new_group_size = filter_var(trim($_POST['added_gSize']),FILTER_SANITIZE_STRING);
    $new_group_course = filter_var(trim($_POST['added_gCourse']),FILTER_SANITIZE_STRING);

    $new_teacher_name = filter_var(trim($_POST['added_tName']),FILTER_SANITIZE_STRING);
    $new_teacher_contacts = filter_var(trim($_POST['added_tContact']),FILTER_SANITIZE_STRING);
    $new_teacher_password = filter_var(trim($_POST['added_tPass']),FILTER_SANITIZE_STRING);

    $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if($mysql->connect_errno)exit('DataBase connection error');
    $mysql->set_charset('utf-8');
    $question ="";
    if($new_discipline != NULL){
        $question = "INSERT INTO `disciplines` (`name`) VALUES ('$new_discipline')";
    }
    
    if($new_group_name != NULL && $new_group_size != NULL && $new_group_course != NULL){
        $question ="INSERT INTO `groups`(`name`,`size`,`course`) VALUES ('$new_group_name','$new_group_size','$new_group_course')";
    }

    if($new_teacher_name != NULL && $new_teacher_password != NULL){
        $question ="INSERT INTO `teachers`(`name` , `password` , `phone`) VALUES ('$new_teacher_name','$new_teacher_password','$new_teacher_contacts')";
    }


    $add = mysqli_query($mysql,$question);


    $mysql->close();

    header("Location: /loged.php");



?>
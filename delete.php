<?php 
    define('DB_HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'cw');


    $del_teacher = filter_var(trim($_POST['t_id']),FILTER_SANITIZE_STRING);
    $del_discipline = filter_var(trim($_POST['d_id']),FILTER_SANITIZE_STRING);
    $del_group = filter_var(trim($_POST['g_id']),FILTER_SANITIZE_STRING);


    $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if($mysql->connect_errno)exit('DataBase connection error');
    $mysql->set_charset('utf-8');
    $question ="";
    if($del_teacher != NULL){
        $question = "DELETE FROM `teachers` WHERE `teachers`.`id` = '$del_teacher'";
    }
    
    if($del_discipline != NULL){
        $question ="DELETE FROM `disciplines` WHERE `disciplines`.`id` ='$del_discipline'";
    }

    if($del_group != NULL){
        $question ="DELETE FROM `groups` WHERE `groups`.`id` = '$del_group'";
    }


    $add = mysqli_query($mysql,$question);


    $mysql->close();

    header("Location: /loged.php");













?>
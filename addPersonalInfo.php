<?php 

    // echo "<pre>";
    // echo print_r($_POST);
    // echo "</pre>";
    define('DB_HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'cw');
    
    $u_id = $_COOKIE[userid];
    $d_id = filter_var(trim($_POST['d_id']),FILTER_SANITIZE_STRING);
    $g_id = filter_var(trim($_POST['g_id']),FILTER_SANITIZE_STRING);
     $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
     if($mysql->connect_errno)exit('DataBase connection error');
     $mysql->set_charset('utf-8');

     $question = mysqli_query($mysql,"INSERT INTO `plan`(`d_id`, `t_id`,`g_id`,`other`,`semestr`) VALUES ('$d_id','$u_id','$g_id','','')");

    //INSERT INTO `plan`(`d_id`, `t_id`,`g_id`,`other`,`semestr`) VALUES ('1','4','3','','')


    $mysql->close();
    header("Location: /loged.php");
?>
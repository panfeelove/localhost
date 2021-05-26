<?php 
    define('DB_HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'cw');

    $login=filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

    $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if($mysql->connect_errno)exit('DataBase connection error');
    $mysql->set_charset('utf-8');

    $result = mysqli_query($mysql,"SELECT * FROM `teachers` WHERE `name` = '$login' AND `password` = '$pass'");
    $user = mysqli_fetch_assoc($result);
    if(count($user) == 0){
        echo "<h1>Помилка авторизації. Невірний логін або пароль , <a href='login.html'>спробуйте ще..</a></h1>";
        exit();
    }
    setcookie('user',$user[name],time() + 3600 , "/");
    setcookie('userid',$user[id],time() + 3600 , "/");


    $mysql->close();

    header("Location: /loged.php");
?>
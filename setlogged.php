<?php 

        define('DB_HOST','localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'root');
        define('DB_NAME', 'cw');
        $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if($mysql->connect_errno)exit('DataBase connection error');
        $mysql->set_charset('utf-8');

        $d=filter_var(trim($_POST['disid']),FILTER_SANITIZE_STRING);
        $g = filter_var(trim($_POST['groupid']),FILTER_SANITIZE_STRING);

        $result = mysqli_query($mysql,"SELECT * FROM `plan` WHERE `d_id` = '$d' AND `g_id` = '$g'");
        $answer = mysqli_fetch_assoc($result);

        if(count($answer) == 0){
            echo "<h1>Помилка у виборі , спробуйте ще..</h1>";
            $tb = 0;
            setcookie('tbv' , $tb , time()+10 , "/loged.php");
            exit();
    }

    $tb = 1;
    setcookie('did' , $d , time()+60 , "/loged.php");
    setcookie('gid' , $g , time()+60, "/loged.php");
    setcookie('tbv' , $tb , time()+10 , "/loged.php");

    setcookie('lc',$answer[lectures],time() + 60 , "/loged.php");
    setcookie('pr',$answer[practics],time() + 60 , "/loged.php");
    setcookie('lb',$answer[labs],time() + 60 , "/loged.php");
    setcookie('ks',$answer[kons_sem],time() + 60 , "/loged.php");
    setcookie('ke',$answer[kons_ex],time() + 60 , "/loged.php");
    setcookie('rr',$answer[rozrah],time() + 60 , "/loged.php");
    setcookie('zal',$answer[zalik],time() + 60 , "/loged.php");
    setcookie('exam',$answer[exams],time() + 60 , "/loged.php");
    setcookie('prac',$answer[prak],time() + 60 , "/loged.php");
    setcookie('dz',$answer[dip_zah],time() + 60 , "/loged.php");
    setcookie('asp',$answer[aspirant],time() + 60 , "/loged.php");
    setcookie('other',$answer[other],time() + 60 , "/loged.php");
    setcookie('sem',$answer[semestr],time() + 60 , "/loged.php");

    setcookie('i_lc',$answer[i_lectures],time() + 60 , "/loged.php");
    setcookie('i_pr',$answer[i_practics],time() + 60 , "/loged.php");
    setcookie('i_lb',$answer[i_labs],time() + 60 , "/loged.php");
    setcookie('i_cw',$answer[i_courseworks],time() + 60 , "/loged.php");
    setcookie('i_rr',$answer[i_rozrah],time() + 60 , "/loged.php");
    setcookie('i_zal',$answer[i_zalik],time() + 60 , "/loged.php");
    setcookie('i_exam',$answer[i_exams],time() + 60 , "/loged.php");
    setcookie('i_prak',$answer[i_prak],time() + 60 , "/loged.php");


        $mysql->close();

        header("Location: /loged.php");

?>
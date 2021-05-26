<?php 
    // echo '<pre>';
    // echo print_r($_POST);
    // echo '<pre>';

    define('DB_HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'cw');
    $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if($mysql->connect_errno)exit('DataBase connection error');
    $mysql->set_charset('utf-8');
    $u_id = $_COOKIE[userid];
    $d_id = filter_var(trim($_POST['dis_id']),FILTER_SANITIZE_STRING);
    $g_id = filter_var(trim($_POST['gr_id']),FILTER_SANITIZE_STRING);
    if($_POST['action'] == 'Update'){
        $i_lectures = filter_var(trim($_POST['i_lections']),FILTER_SANITIZE_STRING);
        $i_practics = filter_var(trim($_POST['i_practics']),FILTER_SANITIZE_STRING);
        $i_labs = filter_var(trim($_POST['i_labs']),FILTER_SANITIZE_STRING);
        $i_cw = filter_var(trim($_POST['i_cw']),FILTER_SANITIZE_STRING);
        $i_prak = filter_var(trim($_POST['i_prak']),FILTER_SANITIZE_STRING);
        $i_rozrob = filter_var(trim($_POST['i_rozrob']),FILTER_SANITIZE_STRING);
        $i_zalik = filter_var(trim($_POST['i_zalik']),FILTER_SANITIZE_STRING);
        $i_exam = filter_var(trim($_POST['i_exam']),FILTER_SANITIZE_STRING);



        $lectures = filter_var(trim($_POST['lections']),FILTER_SANITIZE_STRING);
        $practics = filter_var(trim($_POST['practics']),FILTER_SANITIZE_STRING);
        $labs = filter_var(trim($_POST['labs']),FILTER_SANITIZE_STRING);
        $ksem = filter_var(trim($_POST['ksem']),FILTER_SANITIZE_STRING);
        $kexam = filter_var(trim($_POST['kexam']),FILTER_SANITIZE_STRING);
        $rozrob = filter_var(trim($_POST['rozrob']),FILTER_SANITIZE_STRING);
        $zalik = filter_var(trim($_POST['zalik']),FILTER_SANITIZE_STRING);
        $exam = filter_var(trim($_POST['exam']),FILTER_SANITIZE_STRING);
        $_pract = filter_var(trim($_POST['_pract']),FILTER_SANITIZE_STRING);
        $dzah = filter_var(trim($_POST['dzah']),FILTER_SANITIZE_STRING);


        $aspirant = filter_var(trim($_POST['aspirant']),FILTER_SANITIZE_STRING);
        $other = filter_var(trim($_POST['other']),FILTER_SANITIZE_STRING);
        $semestr = filter_var(trim($_POST['semestr']),FILTER_SANITIZE_STRING);

        $question = mysqli_query($mysql,"UPDATE `plan` SET `i_lectures` = '$i_lectures' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `i_practics` = '$i_practics' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `i_labs` = '$i_labs' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `i_courseworks` = '$i_cw' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `i_prak` = '$i_prak' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `i_rozrah` = '$i_rozrah' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `i_zalik` = '$i_zalik' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `i_exams` = '$i_exams' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");

        $question = mysqli_query($mysql,"UPDATE `plan` SET `lectures` = '$lectures' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `practics` = '$practics' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `labs` = '$labs' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `kons_sem` = '$ksem' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `kons_ex` = '$kexam' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `rozrah` = '$rozrob' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `zalik` = '$zalik' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `exams` = '$exam' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `prak` = '$_pract' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `dip_zah` = '$dzah' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
      
      
        $question = mysqli_query($mysql,"UPDATE `plan` SET `aspirant` = '$aspirant' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `other` = '$other' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");
        $question = mysqli_query($mysql,"UPDATE `plan` SET `semestr` = '$semestr' WHERE `plan`.`t_id` = '$u_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`d_id` = '$d_id'");

    }else if($_POST['action'] == 'Delete'){
        $add = mysqli_query($mysql,"DELETE FROM `plan` WHERE `plan`.`d_id` = '$d_id' AND `plan`.`g_id` = '$g_id' AND `plan`.`t_id`='$u_id'");
    }
    //UPDATE `plan` SET `t_id` = '2' WHERE `plan`.`id` = 4;

    $tb = 0;
    setcookie('tbv' , $tb , time()+10 , "/loged.php");









    $mysql->close();

    header("Location: /loged.php")
?>
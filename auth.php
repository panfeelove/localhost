<?php
    
    $login=filter_var(trim($_POST['search']),FILTER_SANITIZE_STRING);

    define('DB_HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'cw');
    

     $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
     if($mysql->connect_errno)exit('DataBase connection error');
     $mysql->set_charset('utf-8');


     
    $result = mysqli_query($mysql,"SELECT * FROM `teachers` WHERE `name` = '$login'");
    //$result = $mysql->query("SELECT `id` FROM `teachers` WHERE `name` = '$login'");



    $user = mysqli_fetch_assoc($result);
    if(count($user)==0){
        echo "<h1>Помилка пошуку , <a href='index.php'>спробуйте ще..</a></h1>";
        exit();
    }





    $u_name = $user[name];
    $u_id = $user[id];
    function get_nplan($u_id){

        $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if($mysql->connect_errno)exit('DataBase connection error');
        $mysql->set_charset('utf-8');
   
        $i = 0;
        $result = mysqli_query($mysql,"SELECT * FROM `plan` WHERE `t_id` = '$u_id'");
        while($punkt = mysqli_fetch_assoc($result)){

            $d_id = $punkt[d_id];
            $d_temp = mysqli_fetch_assoc(mysqli_query($mysql,"SELECT * FROM `disciplines` WHERE `id` = '$d_id'"));
            $g_id = $punkt[g_id];
            $g_temp = mysqli_fetch_assoc(mysqli_query($mysql,"SELECT * FROM `groups` WHERE `id` = '$g_id'"));

            

            echo "    
            <tr>
            <th scope='col'>$d_temp[id]</th>
            <th scope='col'>$d_temp[name]</th>
            <th scope='col'>$g_temp[course]</th>
            <th scope='col'>$g_temp[size]</th>
            <th scope='col'>$g_temp[name]</th>
            <th scope='col'>Груп</th>
            <th scope='col'>$punkt[i_lectures]</th>
            <th scope='col'>$punkt[i_practics]</th>
            <th scope='col'>$punkt[i_labs]</th>
            <th scope='col'>$punkt[i_courseworks]</th>
            <th scope='col'>$punkt[i_prak]</th>
            <th scope='col'>$punkt[i_rozrah]</th>
            <th scope='col'>$punkt[i_zalik]</th>
            <th scope='col'>$punkt[i_exams]</th>
            <th scope='col'>$punkt[aspirant]</th>
            <th scope='col'>$punkt[other]</th>
            <th scope='col'>$punkt[i_sum]</th>
            <th scope='col'>$punkt[semestr]</th>
          </tr>";

            $i+=1;
            
        }
        $mysql->close();
    }





    function get_tplan($u_id){

      $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
      if($mysql->connect_errno)exit('DataBase connection error');
      $mysql->set_charset('utf-8');
 
      $i = 0;
      $result = mysqli_query($mysql,"SELECT * FROM `plan` WHERE `t_id` = '$u_id'");
      while($punkt = mysqli_fetch_assoc($result)){

          $d_id = $punkt[d_id];
          $d_temp = mysqli_fetch_assoc(mysqli_query($mysql,"SELECT * FROM `disciplines` WHERE `id` = '$d_id'"));
          $g_id = $punkt[g_id];
          $g_temp = mysqli_fetch_assoc(mysqli_query($mysql,"SELECT * FROM `groups` WHERE `id` = '$g_id'"));

          

          echo "    
          <tr>
          <th scope='col'>$d_temp[id]</th>
          <th scope='col'>$d_temp[name]</th>
          <th scope='col'>$g_temp[course]</th>
          <th scope='col'>$g_temp[size]</th>
          <th scope='col'>$g_temp[name]</th>
          <th scope='col'>Груп</th>
          <th scope='col'>$punkt[lectures]</th>
          <th scope='col'>$punkt[practics]</th>
          <th scope='col'>$punkt[labs]</th>
          <th scope='col'>$punkt[kons_sem]</th>
          <th scope='col'>$punkt[kons_ex]</th>
          <th scope='col'>$punkt[rozrah]</th>
          <th scope='col'>$punkt[courseworks]</th>
          <th scope='col'>$punkt[zalik]</th>
          <th scope='col'>$punkt[exams]</th>
          <th scope='col'>$punkt[prak]</th>
          <th scope='col'>$punkt[dip_zah]</th>
          <th scope='col'>$punkt[aspirant]</th>
          <th scope='col'>$punkt[other]</th>
          <th scope='col'>$punkt[sum]</th>
          <th scope='col'>$punkt[semestr]</th>
        </tr>";

          $i+=1;
          
      }
      $mysql->close();
  }

  function teacher_faculty($u_id , $u_name){
    $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if($mysql->connect_errno)exit('DataBase connection error');
    $mysql->set_charset('utf-8');
    $question = "SELECT `teachers`.`name` , `chairs`.`name` FROM `teachers` JOIN `chairs` ON `teachers`.`chair_id` = `chairs`.`id` WHERE `teachers`.`id` = '$u_id'";
    $result = mysqli_query($mysql,$question);
    $chair = mysqli_fetch_assoc($result);
    $question = "SELECT `chairs`.`name` , `faculties`.`name` FROM `chairs` JOIN `faculties` ON `chairs`.`f_id` = `faculties`.`id` WHERE `chairs`.`name` = '$chair[name]'";
    $result = mysqli_query($mysql,$question);
    $faculty = mysqli_fetch_assoc($result);
    echo "<h3>$u_name</h3>
    <h5>$chair[name]</h5>
    <p>$faculty[name]</p>";
    //
    $mysql->close();
  }

    //setcookie('user' , $user[name] , time()+ 3600,"/");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <div class="container">
                <form action="auth.php" method="post">
                    <input type="text" name="search" id="search" class="searchPlace form-controll" placeholder="Укажіть ім'я для пошуку">
                    <button class="btn btn-primary" type="submit">Знайти</button>
                </form>
                <?php if($_COOKIE[userid] == ''): ?>
                <a href="login.html">Увійти для редагування</a>
                <?php else: ?>
                <a href="loged.php"><?= $_COOKIE[user]?></a>
                <?php endif;?>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="teacher_faculty">
                  <?php teacher_faculty($u_id,$u_name); ?>
                
            </div>
        </div>
    </section>
    <section>

        <div class="nplan">
            <table class="table">
            <p style="float:left;">Передбачено навчальним планом</p>

                <thead>
                  <tr>
                    <th scope="col">N</th>
                    <th scope="col">Дисципліна</th>
                    <th scope="col">Курс</th>
                    <th scope="col">Студ.</th>
                    <th scope="col">Шифр</th>
                    <th scope="col">Груп</th>
                    <th scope="col">Лк</th>
                    <th scope="col">Пр</th>
                    <th scope="col">Лб</th>
                    <th scope="col">Курс.Роб.</th>
                    <th scope="col">Практ.</th>
                    <th scope="col">Розрах</th>
                    <th scope="col">Зал.</th>
                    <th scope="col">Екз.</th>
                    <th scope="col">Аспірант</th>
                    <th scope="col">Інше</th>
                    <th scope="col">Усього</th>
                    <th scope="col">Семестр</th>
                  </tr>
                </thead>
                <tbody>
                <?php get_nplan($u_id)?>
                </tbody>
              </table>
        </div>
          
        <div class="nteach">
            <p style="float:left;">Обсяг навантаження викладачів</p>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">N</th>
                    <th scope="col">Дисципліна</th>
                    <th scope="col">Курс</th>
                    <th scope="col">Студ.</th>
                    <th scope="col">Шифр</th>
                    <th scope="col">Груп</th>
                    <th scope="col">Лк</th>
                    <th scope="col">Пр</th>
                    <th scope="col">Лб</th>
                    <th scope="col">Конс.Сем.</th>
                    <th scope="col">Конс.Екз.</th>
                    <th scope="col">Розр.Роб.</th>
                    <th scope="col">Курс.Роб.</th>
                    <th scope="col">Залік</th>
                    <th scope="col">Екз.</th>
                    <th scope="col">Практ.</th>
                    <th scope="col">Дипл. Зах.</th>
                    <th scope="col">Аспірант</th>
                    <th scope="col">Інше</th>
                    <th scope="col">Усього</th>
                    <th scope="col">Семестр</th>
                    
                  </tr>
                </thead>
                <tbody>
                    <?php get_tplan($u_id)?>
                </tbody>
              </table>
        </div>
    </section>

    <footer>
      <form action="print.php" method="post">
        
      </form>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>




<?php
    exit();
    $mysql->close();
    //header('Location: /info.php');
    // while($group = mysqli_fetch_assoc($groups)){
        //     print_r($group);
        // }
?>
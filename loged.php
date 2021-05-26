<?php 
    define('DB_HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'cw');
    

     $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
     if($mysql->connect_errno)exit('DataBase connection error');
     $mysql->set_charset('utf-8');

    $login = $_COOKIE[user];
     
    $result = mysqli_query($mysql,"SELECT * FROM `teachers` WHERE `name` = '$login'");



    $user = mysqli_fetch_assoc($result);
    if(count($user)==0){
        echo "No users";
        exit();
    }

   
    $u_id = $user[id];


    function set_dis($u_id){
        $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if($mysql->connect_errno)exit('DataBase connection error');
        $mysql->set_charset('utf-8');
   
        $result = mysqli_query($mysql,"SELECT DISTINCT `plan`.`d_id` FROM `plan` WHERE `t_id` = '$u_id'");
        while($punkt = mysqli_fetch_assoc($result)){
            $d_id = $punkt[d_id];
            $d_temp = mysqli_fetch_assoc(mysqli_query($mysql,"SELECT * FROM `disciplines` WHERE `id` = '$d_id'"));

            echo "<option value='$punkt[d_id]'>$d_temp[name]</option>";
        }
    }

    function set_groups($u_id){
        $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if($mysql->connect_errno)exit('DataBase connection error');
        $mysql->set_charset('utf-8');

        $result = mysqli_query($mysql,"SELECT * FROM `plan` WHERE `t_id` = '$u_id'");
        while($punkt = mysqli_fetch_assoc($result)){
            $g_id = $punkt[g_id];
            $g_temp = mysqli_fetch_assoc(mysqli_query($mysql,"SELECT * FROM `groups` WHERE `id` = '$g_id'"));

            echo "<option value='$punkt[g_id]'>$g_temp[name]</option>";
        }
    }

    function set_all_dis($type){
        
        $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if($mysql->connect_errno)exit('DataBase connection error');
        $mysql->set_charset('utf-8');

        $result = mysqli_query($mysql,"SELECT * FROM `disciplines`");
        if($type == 0){
            while($punkt = mysqli_fetch_assoc($result)){


                echo "<option value='$punkt[id]'>$punkt[name]</option>";
            }    
        }else if($type == 1){
            while($punkt = mysqli_fetch_assoc($result)){


                echo "<li class='teacher'>
                        <p>$punkt[id]</p>
                        <p>$punkt[name]</p>
                    </li>";
            }
        }
        
    }

    function set_all_groups($type){
        $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if($mysql->connect_errno)exit('DataBase connection error');
        $mysql->set_charset('utf-8');

        $result = mysqli_query($mysql,"SELECT * FROM `groups`");
        if($type == 0){
            while($punkt = mysqli_fetch_assoc($result)){


                echo "<option value='$punkt[id]'>$punkt[name]</option>";
            }
        }else if($type == 1){
            while($punkt = mysqli_fetch_assoc($result)){


                echo "<li class='teacher'>
                            <p>$punkt[id]</p>
                            <p>$punkt[name]</p>
                            <p>$punkt[size]</p>
                            <p>$punkt[course]</p>
                    </li>";
            }
        }
        

    }

    function set_all_teachers($type){
        $mysql = @new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if($mysql->connect_errno)exit('DataBase connection error');
        $mysql->set_charset('utf-8');

        $result = mysqli_query($mysql,"SELECT * FROM `teachers`");
        if($type == 0){
            while($punkt = mysqli_fetch_assoc($result)){

                if($punkt[id] != 1){
                    echo "<option value='$punkt[id]'>$punkt[name]</option>";
                }
                
            }
        }else if($type == 1){
            while($punkt = mysqli_fetch_assoc($result)){
                if($punkt[id]!= 1){
                    

                    echo "<li class='teacher'>

                    <p>$punkt[id]</p>
                    <p>$punkt[name]</p>
                    <p>$punkt[phone]</p>


            </li>";
                }
            }
        }
        

    }

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
                <a href="loged.php"><?= $_COOKIE[user]?></a>
                <a href="index.php" style="margin-left:40px; color:#ec0000; text-decoration:underline;">Повернутись</a>
        </div>
    </div>

    <?php
        if($user[can_mod_all] == 0):
    ?>
    <section>





          
        <div class="nteach" style="margin-top:30px;margin-top: 10vh;">
            <h4>Оновлення обсягу навантаження викладача</h4>
                <form action="setlogged.php" method="post">
                    <select name="disid" class="custom-select" style="width: 400px;">
                                        <option selected>Оберіть дисципліну</option>
                                        <?php set_dis($u_id) ?>
                    </select>
                    <br>
                    <select name="groupid" class="custom-select" style="margin-top: 10px; width: 400px;">
                                        <option selected>Оберіть групу</option>
                                        <?php set_groups($u_id); ?>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary" style="margin-top: 20px; margin-bottom:20px;" onclick="tableview()">Далі</button>
                </form>
              <form action="update.php" method="post" id="tbl" style="display:none;" >

              <p>Передбачено навчальним планом</p>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Лк</th>
                        <th scope="col">Пр</th>
                        <th scope="col">Лб</th>
                        <th scope="col">Курс. Роб.</th>
                        <th scope="col">Практ.</th>
                        <th scope="col">Розр.Роб.</th>
                        <th scope="col">Залік</th>
                        <th scope="col">Екз.</th>
                        <th scope="col">Аспірант</th>
                        <th scope="col">Інше</th>
                        <th scope="col">Семестр</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col" style="display:none;">
                                <input type="text" value="<?= $_COOKIE[did]?>" class="mod-input-sm" name="dis_id">
                            </th>
                            <th scope="col" style="display:none;">
                                <input type="text" value="<?= $_COOKIE[gid]?>" class="mod-input-sm" name="gr_id">
                            </th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[i_lc]?>" class="mod-input-sm" name="i_lections">
                            </th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[i_pr]?>" class="mod-input-sm" name="i_practics">
                            </th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[i_lb]?>" class="mod-input-sm" name="i_labs">
                            </th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[i_cw]?>" class="mod-input-sm" name="i_cw">
                            </th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[i_prak]?>" class="mod-input-sm" name="i_prak"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[i_rr]?>" class="mod-input-sm" name="i_rozrob"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[i_zal]?>" class="mod-input-sm" name="i_zalik"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[i_exam]?>" class="mod-input-sm" name="i_exam"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[asp]?>" class="mod-input-sm" name="aspirant"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[other]?>" class="mod-input-sm" name="other"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[sem]?>" class="mod-input-sm" name="semestr"></th>
                            <th scope="col">
                                <button type="submit" class="btn btn-danger u_del"  name="action" value="Delete">X</button>
                            </th>
                        </tr>


                    </tbody>
                  </table>


                <p>Обсяг навантаження викладача</p>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Лк</th>
                        <th scope="col">Пр</th>
                        <th scope="col">Лб</th>
                        <th scope="col">Конс.Сем.</th>
                        <th scope="col">Конс.Екз.</th>
                        <th scope="col">Розр.Роб.</th>
                        <th scope="col">Залік</th>
                        <th scope="col">Екз.</th>
                        <th scope="col">Практ.</th>
                        <th scope="col">Дипл. Зах.</th>
                        <th scope="col">Аспірант</th>
                        <th scope="col">Інше</th>
                        <th scope="col">Семестр</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col" style="display:none;">
                                <input type="text" value="<?= $_COOKIE[did]?>" class="mod-input-sm" name="dis_id">
                            </th>
                            <th scope="col" style="display:none;">
                                <input type="text" value="<?= $_COOKIE[gid]?>" class="mod-input-sm" name="gr_id">
                            </th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[lc]?>" class="mod-input-sm" name="lections">
                            </th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[pr]?>" class="mod-input-sm" name="practics">
                            </th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[lb]?>" class="mod-input-sm" name="labs">
                            </th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[ks]?>" class="mod-input-sm" name="ksem">
                            </th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[ke]?>" class="mod-input-sm" name="kexam"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[rr]?>" class="mod-input-sm" name="rozrob"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[zal]?>" class="mod-input-sm" name="zalik"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[exam]?>" class="mod-input-sm" name="exam"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[prac]?>" class="mod-input-sm" name="_pract"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[dz]?>" class="mod-input-sm" name="dzah"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[asp]?>" class="mod-input-sm" name="aspirant"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[other]?>" class="mod-input-sm" name="other"></th>
                            <th scope="col">
                                <input type="text" value="<?= $_COOKIE[sem]?>" class="mod-input-sm" name="semestr"></th>
                            <th scope="col">
                                <button type="submit" class="btn btn-danger u_del"  name="action" value="Delete">X</button>
                            </th>
                        </tr>


                    </tbody>
                  </table>

                    
                  <button type="submit" class="btn btn-primary" style="" name="action" value="Update">Оновити</button>
              </form>
        </div>


        <div class="addform" >
                <h4 style="display: block;">Додати нові дані</h4>
                <br>
                <form action="addPersonalInfo.php" method="post" style="text-align: center;">
                    <select class="custom-select custom-select" name="d_id" style="width: 400px;">
                        <option selected>Оберіть дисципліну , що потрібно внести</option>
                        <?php set_all_dis(0) ?>
                    </select>
                    <br>
                    <select class="custom-select custom-select" name="g_id" style="margin-top: 10px; width: 400px;">
                        <option selected>Оберіть групу для якої потрібно ввести дані</option>
                        <?php set_all_groups(0) ?>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Додати</button>
                </form>
        </div>
    </section>
    <?php
        else: 
    ?>
    <section>
        <section>
            <div class="container">
                <div class="card">
                    <ul class="teachers_list">
                        <h4>
                            Список дисциплін:
                        </h4>
                        <?php set_all_dis(1); ?>
                    </ul>
                </div>
                
                <div class="card" style="margin-top: 10px;">
                    <div class="new_teach">
                        <form action="add.php" method="post">
                            <input name="added_disc" type="text" placeholder="Назва" style="width: 60%;">
                            <button type="submit" class="btn btn-outline-primary">Додати дисципліну</button>
                        </form>


                        <form action="delete.php" method="post" style="margin-top: 20px;">
                            <select name="d_id" class="custom-select custom-select-sm" style="width: 60%;">
                                <option selected>Оберіть дисципліну</option>
                                <?php set_all_dis(0);?>
                            </select>
                            <button type="submit" class="btn btn-danger" style="margin-left:10px;">Видалити</button>
                        </form>
                    </div>
                </div>
            
            
            </div>
        </section>

        <section style="margin-top: 40px;">
            <div class="container">
                <div class="card">
                    <ul class="teachers_list">
                        <h4>
                            Список груп:
                        </h4>
                        <li class='teacher'>
                            <p>id</p>
                            <p>name</p>
                            <p>size</p>
                            <p>course</p>
                    </li>
                        <?php set_all_groups(1); ?>
                        
                    </ul>
                </div>
                
                <div class="card" style="margin-top: 10px;">
                    <div class="new_teach">
                        <form action="add.php" method="post">
                            <input name="added_gName" type="text" placeholder="Шифр">
                            <input name="added_gCourse" type="text" placeholder="Курс">
                            <input name="added_gSize" type="text" placeholder="Розмір групи">
                            <button type="submit" class="btn btn-outline-primary" style="margin-left: 25px; padding-left: 6px; padding-right: 6px;">Додати групу</button>
                        </form>


                        <form action="delete.php" method="post" style="margin-top: 20px;">
                            <select name="g_id" class="custom-select custom-select-sm" style="width: 60%;">
                                <option selected>Оберіть групу</option>
                                <?php set_all_groups(0);?>
                            </select>
                            <button type="submit" class="btn btn-danger" style="margin-left:10px;">Видалити</button>
                        </form>
                    </div>
                </div>
            </div>

        </section>

        <section style="margin-top: 40px;">
            <div class="container">
                <div class="card">
                    <ul class="teachers_list">
                        <h4>
                            Дані викладачів:
                        </h4>
                        <?php set_all_teachers(1);?>
                        
                    </ul>
                </div>
                
                <div class="card" style="margin-top: 10px;">
                    <div class="new_teach">
                        <form action="add.php" method="post">
                            <input name="added_tName" type="text" placeholder="Ім'я">
                            <input name="added_tContact" type="text" placeholder="Контактні дані" style="width: 140px;">
                            <input name="added_tPass" type="text" placeholder="Пароль">
                            <button type="submit" class="btn btn-outline-primary">Додати викладача</button>
                        </form>

                        <form action="delete.php" method="post" style="margin-top: 20px;">
                            <select name="t_id" class="custom-select custom-select-sm" style="width: 60%;">
                                <option selected>Оберіть викладача</option>
                                <?php set_all_teachers(0); ?>
                            </select>
                            <button type="submit" class="btn btn-danger" style="margin-left:10px;">Видалити</button>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </section>
    <?php 
        endif;
   ?>
    <script>
        if(<?= $_COOKIE[tbv] ?>==1){
            document.getElementById("tbl").style.display = "block";
        }
        function showform(){
            let f = document.getElementById("upd_fm");
            f.style.display = "block";
        }


    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>

<?php 
    $mysql->close();
?>


        <!-- <div class="nplan">
            <h4 style="float: left;">Передбачено навчальним планом</h4>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Дисципліна</th>
                    <th scope="col">Шифр</th>
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
                    <th scope="col">Семестр</th>
                  </tr>
                </thead>
                <tbody>
    
                </tbody>
              </table>
        </div> -->
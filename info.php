

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    INFO
    <?php if($_COOKIE['user'] == ''):?>
        <div>no us</div>
        <?php else:?>
        <div>Hi , <?=$_COOKIE['user']?></div>
        <?php endif;?>    
</body>
</html>
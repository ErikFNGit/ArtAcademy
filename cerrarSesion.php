<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    <?php
        if($_SESSION){
            session_destroy();
        ?>
        <meta http-equiv="REFRESH" content="0;url=index.php">
        <?php
        }else{
            echo"Debe esta validado primero";
        ?>
        <meta http-equiv="REFRESH" content="0;url=loginUsuario.php">
        <?php
        }
    ?>
</body>
</html>
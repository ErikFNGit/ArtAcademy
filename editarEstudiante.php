<!DOCTYPE html>
<?php
    session_start();
    include("Funciones.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
if ($_GET){
        fillInfoStudent($_GET['id']);
    }
    else if ($_POST){
        $_SESSION['dni']=$_POST['dni'];
        updateStudent();
        ?>
        <meta http-equiv="refresh" content="0; url=perfilAlumno.php">;
        <?php
    }
?>
</body>
</html>
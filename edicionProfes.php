<!DOCTYPE html>
<html lang="en">
    <?php 
    include("Funciones.php");
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Profesores</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    <?php
    if ($_GET){
        fillInfoTeacher($_GET['id']);
    }
    else if ($_POST){
        updateTeacher();
        ?>
        <meta http-equiv="refresh" content="0; url=listarProfes.php">
        <?php
    }
    ?>
</body>
</html>
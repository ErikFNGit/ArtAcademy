<?php
    include("Funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if($_GET){    
    fillInfoCursos($_GET['id']);
    }else if ($_POST){
        updateCurso();
        echo "<meta http-equiv='refresh' content ='0; url=listarCursos.php'>";
    }
    ?>
</body>
</html>
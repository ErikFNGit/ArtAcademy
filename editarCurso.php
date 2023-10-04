<?php
    session_start();
    include("Funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    <?php
        if(isset($_SESSION["userType"]) and $_SESSION["userType"] == "admin"){
            if(isset($_GET["id"])){ 
                fillInfoCursos($_GET['id']);
            }else if ($_POST){
                updateCurso();
                echo "<meta http-equiv='refresh' content ='0; url=listarCursos.php'>";
            }
        }else{
            echo "<h1>No tienes acceso a esta pagina</h1>";
            echo "<meta http-equiv='refresh' content ='2; url=index.php'>";
        }
        ?>
</body>
</html>
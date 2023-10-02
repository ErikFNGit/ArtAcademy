<?php
    session_start();
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
    <div class="listado">
        <?php
            include("Funciones.php");
            if(isset($_SESSION["userType"])){
        ?>
    </div>
    <form action="listarCursos.php" method="POST">
        <label for="codigo">Buscador:</label>
        <input type="text" name="busqueda">
        <input type="submit" value="Aceptar">
    </form>
    <h1>CURSOS</h1>

    </br>
        <?php
            if(isset($_POST["busqueda"])){
                listaCursos(conexion(),$_POST["busqueda"],$_SESSION["userType"]);
            }else{
                listaCursos(conexion(),"",$_SESSION["userType"]);
            }
        }else{
            echo "<h1>No tienes acceso a esta pagina</h1>";
            echo "<meta http-equiv='refresh' content ='2; url=index.php'>";
        }
    ?>
</body>
</html>
<?php
    session_start();
    $_SESSION["userType"] = "teacher";
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
        if(isset($_SESSION["start"])){
    ?>
    <header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div>
            <a href="cerrarSesion.php"> Cerrar Sesion </a>
        </div>
    </header>
    <?php
    listarAlumnosMatriculados(conexion(),$_GET['id']);
    }else{
        echo "<h1>NO TIENES ACCESO A ESTA PAGINA</h1>";
    }
    ?>
</body>
</html>
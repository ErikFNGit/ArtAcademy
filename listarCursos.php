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
<header>
    <?php
    if (isset($_SESSION)){
    ?>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="200px" height="100px">
        </div>
        <div></div>
        <div></div>
        <div>
            <a href="index.php"> Iniciar Sesion </a>
        </div>
        <div>
            <a href="cerrarSesion.php"> Registrarse </a>
        </div>
    <?php
    }else{
    ?>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="200px" height="100px">
        </div>
        <div>
            <a href="index.php"> Mi perfil </a>
        </div>
        <div>
            <a href="registrarAlumno.php"> Cerrar Sesion</a>
        </div>
    <?php
    }
    ?>
    </header>
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
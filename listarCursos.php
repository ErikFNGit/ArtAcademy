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
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="200px" height="100px">
        </div>
        <div>
            <a href="index.php"> Mi perfil </a>
        </div>
        <div>
            <a href="cerrarSesion.php"> Cerrar Sesion</a>
        </div>
    </header>
    <div class="listado">
        <?php
            include("Funciones.php");
            if(isset($_SESSION["userType"])){
        ?>
        <form action="listarCursos.php" method="POST">
            <label for="codigo">Buscador:</label>
            <input type="text" name="busqueda">
            <input type="submit" value="Aceptar">
        </form>
        <div class="tabla">
            <h1>CURSOS</h1>
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
        </div>
    </div>
    <footer>
        <img src="logoBlanco.png" alt="Logo de la academia con la letra en blanco" width="200px" height="100px">
        <div>
            Calle Invent, 69 08917 Badalona <br>
            +34 677 424 950 <br>
        </div>
        <div>
            <ul>   
                <li><a href="">Instagram</a></li>
                <li><a href="">Facebook</a></li>
                <li><a href="">Twitter</a></li>
            </ul>  
        </div>
    </footer>
</body>
</html>
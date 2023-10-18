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
    <title>Profesor</title>
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
    <div class="listado">
        <h1>Mis cursos:</h1>
        <div class="tabla">
            <?php
                listaCursos(conexion(),"",$_SESSION["userType"]);
            ?>
        </div>
    </div>


    <footer>
        <img src="logoBlanco.png" alt="Logo de la academia con la letra en blanco" width="100px" height="50px">
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
    <?php
    }else{
        echo "<h1>NO TIENES ACCESO A ESTA PAGINA</h1>";
    }
    ?>
</body>
</html>
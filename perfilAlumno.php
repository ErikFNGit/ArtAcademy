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
<?php
    if($_SESSION['userType']!="student"){
        echo "<h1>No tienes acceso a esta pagina</h1>";
        echo "<meta http-equiv='refresh' content ='2; url=index.php'>";
    }else{
        include("Funciones.php");
        ?>
    <header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div>
            <a href="inicioAlumno.php">Inicio</a>
        </div>
        <div>
            <a href="perfilAlumno.php"> Mi perfil </a>
        </div>
        <div>
            <a href="cerrarSesion.php"> Cerrar Sesion </a>
        </div>
    </header>
        <div class="containerPerfilAlumno">
        <?php
            perfilStudent($_SESSION["dni"]);
        echo"<a class='button' href='inicioAlumno.php'>Atras</a>";
        echo"</div>";
    }
?>        
</body>
</html>
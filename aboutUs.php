<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
<?php
    if (!isset($_SESSION['userType'])){
    ?>
    <header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div>
            <a href="paginaPrincipal.php">Inicio</a>
        </div>
        <div>
            <a href="index.php"> Iniciar Sesion </a>
        </div>
        <div>
            <a href="registrarAlumno.php"> Registrarse </a>
        </div>
    </header>
    <?php
    }else{
    ?>
    <header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div>
            <a href="paginaPrincipal.php">Inicio</a>
        </div>
        <div>
            <a href="perfilAlumno.php"> Mi perfil </a>
        </div>
        <div>
            <a href="cerrarSesion.php"> Cerrar Sesion</a>
        </div>
    </header>
    <?php
    }
    ?>


<h1 id="usAbout">¿QUIENES SOMOS?</h1>
<div class="aboutUsContainer">
        <div>
            <h3>Bienvenidos a Art Academy</h3>
            <p>Somos una academia que reune todos los niveles de artistas, desde aspirantes a maestros, de todas als disciplinas imaginables. Aqui encontraras cuross de iniciacion
            , de perfeccionamiento o de ampliacion de todo lo que siempre has soñado. Si puedes imaginarlo, puedes plasmarlo, ese es nuestro lema.
            </p>
        </div>
        <div>   
            <h3>¿Cuales son nuestros objetivos?</h3>
            <p>En Art Academy buscamos que todos desde pequeños3a mayores desarrollen su lado artistico </p>
            <p>Una depuracion de la tencnica de nuestros estudiantes</p>
            <p>Y el desarrollo de cualquier tipo de disciplina artistica</p>
        </div>
    </div>

    <footer class="footerAbs">
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
</body>
</html>
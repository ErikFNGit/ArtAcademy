<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtAcademy</title>
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
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
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
    <div class="container">
        <div>
            <h1>CURSOS</h1>
            <p>Si quieres informacion <br> de los cursos que <br> impartimos, clic aqui</p>
            <img src="clasearte.jpg" alt="Gente pintando" width="150px" height="100px"> <br>
            <a href=""> Cursos </a>
        </div>
        <div>
            <h1>QUIENES SOMOS</h1>
            <p>Aqui tienes toda la <br> informacion sobre <br> nuestros profesionales</p>
            <img src="arteprofe.jpg" alt="Profesor pintando" width="150px" height="100px"> <br>
            <a href=""> About us </a>
        </div>
        <div>
            <h1>CONTACTANOS</h1>
            <p>Necesitas mas informacion? <br> Contactanos!</p>
            <img src="logoGmail.png" alt="el logo de gmail" width="150px" height="100px"> <br>
            <a href=""> Contactanos </a>
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
</body>
</html>
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
    <?php
    if (!isset($_SESSION['userType'])){
    ?>
    <header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div>
            <a href="index.php">Inicio</a>
        </div>
        <div>
            <a href="loginUsuario.php"> Iniciar Sesion </a>
        </div>
        <div>
            <a href="registrarAlumno.php"> Registrarse </a>
        </div>
    </header>
    <div class="mainMenu">
        <div>
            <h1>CURSOS</h1>
            <p>Si quieres informacion <br> de los cursos que <br> impartimos, clic aqui</p>
            <img src="clasearte.jpg" alt="Gente pintando" width="150px" height="100px"> <br>
            <a class="button" href="cursosPublicos.php"> Cursos </a>
        </div>
        <div>
            <h1>QUIENES SOMOS</h1>
            <p>Aqui tienes toda la <br> informacion sobre <br> nuestros profesionales</p>
            <img src="arteprofe.jpg" alt="Profesor pintando" width="150px" height="100px"> <br>
            <a class="button" href="aboutUs.php"> About us </a>
        </div>
        <div>
            <h1>CONTACTANOS</h1>
            <p>¿Necesitas mas <br> informacion? <br> Contactanos!</p>
            <img src="logoGmail.png" alt="el logo de gmail" width="150px" height="100px"> <br>
            <a class="button" href="contactanos.php"> Contactanos </a>
        </div>
    </div>
    <?php
    }else{
    ?>
    <header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div>
            <a href="index.php">Inicio</a>
        </div>
        <div>
            <a href="perfilAlumno.php"> Mi perfil </a>
        </div>
        <div>
            <a href="cerrarSesion.php"> Cerrar Sesion</a>
        </div>
    </header>
    <div class="mainMenu">
        <div>
            <h1>CURSOS</h1>
            <p>Si quieres informacion <br> de los cursos que <br> impartimos, clic aqui</p>
            <img src="clasearte.jpg" alt="Gente pintando" width="150px" height="100px"> <br>
            <a class="button" href="cursosPublicos.php"> Cursos </a>
        </div>
        <div>
            <h1>QUIENES SOMOS</h1>
            <p>Aqui tienes toda la <br> informacion sobre <br> nuestros profesionales</p>
            <img src="arteprofe.jpg" alt="Profesor pintando" width="150px" height="100px"> <br>
            <a class="button" href="aboutUs.php"> About us </a>
        </div>
        <div>
            <h1>CONTACTANOS</h1>
            <p>¿Necesitas mas <br> informacion? <br> Contactanos!</p>
            <img src="logoGmail.png" alt="el logo de gmail" width="150px" height="100px"> <br>
            <a class="button" href="contactanos.php"> Contactanos </a>
        </div>
    </div>
    <?php
    }
    ?>
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
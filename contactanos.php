<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactanos</title>
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
    <div class="formulario">
        <h1>CONTACTANOS</h1>
        <div class="formularioContacto">
        <table>
            <form action="paginaPrncipal.php">
            <tr>
                <td>Nombre *</td>
            </tr>
            <tr>
                <td><input type="text" size="75"></td>
            </tr>
            <tr>
                <td>Apellido *</td>
            </tr>
            <tr>
                <td><input type="text" size="75"></td>
            </tr>
            <tr>
                <td>Asunto *</td>
            </tr>
            <tr>
                <td><input type="text" size="75"></td>
            </tr>
            <tr>
                <td>Mensaje *</td>
            </tr>
            <tr>
                <td><input type="text" size="75" style="height:100px;"></td>
            </tr>
            </form>
        </table>
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
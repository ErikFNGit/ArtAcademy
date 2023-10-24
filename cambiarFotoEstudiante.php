<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    include("Funciones.php");
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    <?php
    if($_SESSION['userType']!="student"){
        echo "<h1>No tienes acceso a esta pagina</h1>";
        echo "<meta http-equiv='refresh' content ='2; url=index.php'>";
    }else{
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
        <?php
        if(!isset($_FILES['photo'])){
        ?>
            <div class="test">
                <div class="listado">
                    <div class="tabla">
                        <table>
                            <form action="cambiarFotoEstudiante.php" method="POST" enctype="multipart/form-data">
                            <tr>
                                <td><label for='passActual'>Nueva foto: </label></td>
                                <td><input type="file" name="photo" required></td>
                            <tr>
                                <td><input class="button" type="submit" value="Cambiar"></td>
                                <td><a class="button" href='perfilAlumno.php'>Atras</td>
                            </tr>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        <?php
        }else{
            cambiarFotoAlumno($_SESSION['dni']);
        }
    }
    ?>
</body>
</html>
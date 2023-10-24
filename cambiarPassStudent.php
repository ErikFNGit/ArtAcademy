<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    include("Funciones.php");
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
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
            if(!isset($_POST['pass'])){
            ?>
            <div class="test">
                <div class="listado">
                    <div class="tabla">
                        <table>
                            <form action='cambiarPassStudent.php' method='post'>
                            <tr>
                            <td><label for='passActual'>Introduzca su contraseña actual: </label></td>
                                <td><input type='password' name='passActual' required></td>
                            </tr>
                            <tr>
                                <td><label for='pass'>Nueva contraseña: </label></td>
                                <td><input type='password' name='pass' required></td>
                            </tr>
                            <tr>
                                <td><label for='passComprobar'>Introduzca de nuevo la contraseña:</label></td>
                                <td><input type='password' name='passComprobar' required></td>
                            </tr>
                            <tr>
                                <td><input class="button" type="submit" value="Cambiar"></td>
                            </tr>
                            <tr>
                                <td><a class="button" href='perfilAlumno.php'>Atras</td>
                            </tr>
                            
                        </form>
                        </table>
                    </div>
                </div>
            </div>
            <?php
            }else{
                cambiarPass($_SESSION['dni'],$_POST['passActual'],$_POST['pass'],$_POST['passComprobar']);
            }
    }
    ?>

</body>
</html>
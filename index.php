<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body class="paginaIndex">

    <?php
        include("Funciones.php");
        if(!isset($_POST["dni"])){
            if(isset($_SESSION["error"])){
                echo $_SESSION["error"];
                unset($_SESSION["error"]);
            }
    ?>
<div class="test">
<div class="listado">
    <div class="tabla">
        <h1>Login alumnado</h1>
        <table>
            <form action="index.php" method="post">
                <tr>
                    <td><label for="dni">DNI:</label></td>
                    <td><input type="text" name="dni"></td>
                </tr>
                <tr>
                    <td><label for="passwd">Contraseña:</label></td>
                    <td><input type="password" name="passwd"></td>
                </tr>   
            </table>
            <input type="submit" value="Acceder">
        </form>
        <p>Aun no te has registrado? <a  href = 'registrarAlumno.php'>Clic aqui </a></p>
        <p>Si has olidado tu contraseña <a href="passOlvidada.php"> Clic aqui </a></p>
    </div>
</div>
</div>
    <?php 
        }else{
            if(!studentLogin(conexion())){
                unset($_POST["dni"]);
                unset($_POST["passwd"]);
                $_SESSION["error"]="<p>Contraseña o usuario incorrecto(s) pruebe de nuevo</p>";
                echo "<meta http-equiv='refresh' content ='0; url=index.php'>";        
            }else{
                $_SESSION["dni"] = $_POST["dni"];
                $_SESSION["userType"] = "student";
                echo "<meta http-equiv='refresh' content ='0; url=inicioAlumno.php'>";           

            }
        }
    ?>
</body>
</html>
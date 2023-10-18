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
        include("Funciones.php");
        if(!isset($_POST["dni"])){
            if(isset($_SESSION["error"]))
            {
                echo $_SESSION["error"];
                unset($_SESSION["error"]);
            }
    ?>
    <table>
        <form action="loginUser.php" method="post">
            <tr>
                <td><label for="dni">DNI:</label></td>
                <td><input type="text" name="dni"></td>
            </tr>
            <tr>
                <td><label for="passwd">Contraseña:</label></td>
                <td><input type="text" name="passwd"></td>
            </tr>
            <tr><td><input type="submit" value="Acceder"></td></tr>
        </form>
    </table>
    <?php 
        }else{
            if(!studentLogin(conexion())){
                unset($_POST["dni"]);
                unset($_POST["passwd"]);
                $_SESSION["error"]="<p>Contraseña o usuario incorrecto(s) pruebe de nuevo</p>";
                echo "<meta http-equiv='refresh' content ='0; url=loginUser.php'>";               
            }else{
                echo "<meta http-equiv='refresh' content ='0; url=index.php'>";               
            }
        }
    ?>
</body>
</html>
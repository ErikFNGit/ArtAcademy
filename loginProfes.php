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
            
    ?>
<div class="test">
<div class="listado">
    <div class="tabla">
        <h1>Login pofesorado</h1>
        <table>
            <form action="loginProfes.php" method="post">
                <tr>
                    <td><label for="dni">ID:</label></td>
                    <td><input type="text" name="dni"></td>
                </tr>
                <tr>
                    <td><label for="passwd">Contraseña:</label></td>
                    <td><input type="password" name="passwd"></td>
                </tr>   
            </table>
            <?php
                if(isset($_SESSION["error"])){
                    echo $_SESSION["error"];
                    unset($_SESSION["error"]);
                }
            ?>
            <input type="submit" value="Acceder">
        </form>
    </div>
</div>
</div>
    <?php 
        }else{
            if(!teacherLogin(conexion())){
                unset($_POST["dni"]);
                unset($_POST["passwd"]);
                $_SESSION["error"]="<p>Contraseña o usuario incorrecto(s) pruebe de nuevo</p>";
                echo "<meta http-equiv='refresh' content ='0; url=loginProfes.php'>";        
            }else{
                $_SESSION["dni"] = $_POST["dni"];
                $_SESSION["userType"] = "teacher";
                $_SESSION["start"] = true;
                echo "<meta http-equiv='refresh' content ='0; url=inicioProfe.php'>";           
            }
        }
    ?>
</body>
</html>
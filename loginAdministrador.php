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
        if(!isset($_POST["ID"])){
            if(isset($_SESSION["error"]))
            {
                echo $_SESSION["error"];
                unset($_SESSION["error"]);
            }
    ?>
    <div class="test">
        <div class="listado">
            <div class="tabla">
            <h1>Login administrador</h1>
                <table>
                    <form action="loginAdministrador.php" method="post">
                        <tr>
                            <td><label for="ID">ID:</label></td>
                            <td><input type="text" name="ID"></td>
                        </tr>
                        <tr>
                            <td><label for="passwd">Contraseña:</label></td>
                            <td><input type="password" name="passwd"></td>
                        </tr>
                    </table>
                    <input type="submit" value="Acceder">
                </form>
            </div>
        </div>
    </div>
    <?php 
        }else{
            if(!adminLogin(conexion())){
                unset($_POST["ID"]);
                unset($_POST["passwd"]);
                $_SESSION["error"]="<p>Contraseña o usuario incorrecto(s) pruebe de nuevo</p>";
                echo "<meta http-equiv='refresh' content ='0; url=loginAdministrador.php'>";               
            }else{
                $_SESSION["userType"] = "admin";
                $_SESSION["start"] = true;
                echo "<meta http-equiv='refresh' content ='0; url=controlAdmin.php'>";               

            }
        }
    ?>
    
</body>
</html>
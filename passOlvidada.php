<!DOCTYPE html>
<?php
session_start();
include("Funciones.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    <?php
    if(!$_POST){
        
    ?>
    <div class="test">
        <div class="listado">
            <div class="tabla">
                <table>
                    <h3>Indique su DNI y su mail</h3>
                    <h3> para poder cambiar la contraseña</h3>
                    <form action="passOlvidada.php" method="post">
                        <tr>
                            <td><label for="dni">DNI:</label></td>
                            <td><input type="text" name="dni"></td>
                        </tr>
                        <tr>
                            <td><label for="mail">Correo:</label></td>
                            <td><input type="text" name="mail"></td>
                        </tr>
                        <tr>
                            <td><input class="button" type="submit" value="Cambiar"></td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </div>
    
    <?php
    }else{
        $_SESSION['dni']=$_POST['dni'];
        $_SESSION['mail']=$_POST['mail'];
    ?>
        <meta http-equiv='refresh' content ='0; url=cambiarPassOlvidada.php'>
    <?php 

    }
    ?>
</body>
</html>
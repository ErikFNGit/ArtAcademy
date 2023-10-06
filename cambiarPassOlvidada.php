<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    include("Funciones.php");
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    <?php
    if(!$_POST){
    ?>
    <table>
        <form action='cambiarPassOlvidada.php' method='post'>
            <tr>
                <td><label for='pass'>Nueva contraseña: </label></td>
                <td><input type='password' name='pass' required></td>
            </tr>
            <tr>
                <td><label for='passComprobar'>Introduzca de nuevo la contraseña:</label></td>
                <td><input type='password' name='passComprobar' required></td>
            </tr>
    </table>
        <input type="submit" value="Cambiar">
        </form>
    <?php
    }else{
        passOlvidada($_SESSION['dni'],$_SESSION['mail'],$_POST['pass'],$_POST['passComprobar']);
    }
    ?>

</body>
</html>
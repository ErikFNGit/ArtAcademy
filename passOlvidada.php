<!DOCTYPE html>
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
    <table>
        <form action="passOlvidada.php" method="post">
            <tr>
                <td><label for="dni">DNI:</label></td>
                <td><input type="text" name="dni"></td>
            </tr>
            <tr>
                <td><label for="mail">Correo:</label></td>
                <td><input type="text" name="mail"></td>
            </tr>
        </form>
    </table>
    <?php
    }else{
        
    }
    ?>
</body>
</html>
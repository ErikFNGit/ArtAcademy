<!DOCTYPE html>
<html lang="en">
    <?php
    include ("Funciones.php");
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_POST['find'])){
        fillInfoTeacher();
    }elseif($_GET){
        updateTeacher();
    }else{
    ?>
<form action="EditarProfes.php" method="POST">
    <table>
        <tr>
            <td><label>Introduzca la ID del profesor: </label></td>
            <td><input type="text" name="find" required></td>
        </tr>
        </tr>
            <td><input type="submit" value="Buscar"></td>
            <td><a href='EditarProfes.php'>Atras</a></td>
        </tr>
    </table>
</form>
    <?php
    }
    ?>  
</body>
</html>
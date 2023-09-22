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
            <td><input type="submit" value="Atras"/></td>
        </tr>
    </table>
    <?php
    listaTeachers();
    }
    ?>  
</body>
</html>
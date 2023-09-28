<!DOCTYPE html>
<html lang="en">
    <?php
    include ("Funciones.php");
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Profesores</title>
</head>
<body>
    <?php
    $name= "";
    if (isset($_POST["name"]) && $_POST["name"]!=""){
        //Relleno todos los campos de la busquedA
        $name= $_POST['name'];
    }
    ?>
    <form action="listarProfes.php" method="POST">
        <table>
            <tr>
                <td><label>Introduzca el nombre del profesor: </label></td>
                <td><input type="text" name="name" required></td>
                <td><input type="submit" value="Buscar"></td>
            </tr>
        </table>
    </form>
    <?php
        listaTeachers($name);
    ?>
    <a href = 'controlAdmin.php'> Atras </a>  
</body>
</html>
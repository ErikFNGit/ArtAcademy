<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include("Funciones.php");
    ?>
    <form action="listadoAlumnos.php" method="POST">
        <label for="codigo">Buscador:</label>
        <input type="text" name="busqueda">
        <input type="submit" value="Aceptar">
    </form>
    </br>
        <?php
            if(isset($_POST["busqueda"]))
            {
                listarAlumnos(conexion(),$_POST["busqueda"]);


            }else{
                listarAlumnos(conexion(),"");

            }
        ?>
    <a href='controlAdmin.php'>Atras</a>

    
</body>
</html>
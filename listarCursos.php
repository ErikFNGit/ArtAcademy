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
    <form action="listarCursos.php" method="POST">
        <label for="codigo">Buscador:</label>
        <input type="text" name="busqueda">
        <input type="submit" value="Aceptar">
    </form>
    0</br>
        <?php
            if(isset($_POST["busqueda"]))
            {
                listaCursos(conexion(),$_POST["busqueda"]);

            }else{
                listaCursos(conexion(),"");
            }
        ?>
    <a href='index.html'>Atras</a>
    
</body>
</html>
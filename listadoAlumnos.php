<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista del alumnado</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    <?php
        include("Funciones.php");
    ?>
    <header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div>
            <a href="cerrarSesion.php"> Cerrar Sesion</a>
        </div>
    </header>
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
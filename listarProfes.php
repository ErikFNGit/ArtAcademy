<!DOCTYPE html>
<html lang="en">
    <?php
    include ("Funciones.php");
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Profesores</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    <?php
    $name= "";
    if (isset($_POST["name"]) && $_POST["name"]!=""){
        //Relleno todos los campos de la busquedA
        $name= $_POST['name'];
    }
    ?>
    <header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div>
            <a href="cerrarSesion.php"> Cerrar Sesion</a>
        </div>
    </header>
    <div class="listado">
        <div class="buscador">
            <form action="listarProfes.php" method="POST">
                <label>Introduzca el nombre del profesor: </label>
                <input type="text" name="name" required>
                <input type="submit" value="Buscar">
            </form>
        </div>
        <div class="tabla">
            <h1>PROFESORADO</h1>
            <?php listaTeachers($name); ?>
            <a class="button" href = 'controlAdmin.php'> Atras </a>
        </div>
    </div>  
</body>
</html>
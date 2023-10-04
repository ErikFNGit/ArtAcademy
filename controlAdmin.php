<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administracion</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    <?php
        if(isset($_SESSION["userType"]) and $_SESSION["userType"] == "admin"){
    ?>
    <header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div>
            <a href="cerrarSesion.php"> Cerrar Sesion</a>
        </div>
    </header>
    <div class="container">
        <div class="menu">
            <a href="AltaProfes.php">Añadir profesores</a> <br>
            <a href="crearCurso.php">Añadir cursos</a> <br>
            <a href="listarProfes.php">Editar profesores</a> <br>
            <a href="listarCursos.php?id=admin">Listado de cursos</a> <br>
            <a href="registrarAlumno.php">Registrar alumno</a> <br>
            <a href="listadoAlumnos.php">Listado alumno</a> <br>
            <a href="loginAdministrador.php">Atras</a> 

        </div>
    </div>

    <?php
        }else{
            echo "<h1>No tienes acceso a esta pagina</h1>";
            echo "<meta http-equiv='refresh' content ='2; url=index.php'>";
        }
    ?>
</body>
</html>
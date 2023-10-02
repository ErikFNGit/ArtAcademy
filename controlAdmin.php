<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_SESSION["userType"]) and $_SESSION["userType"] == "admin"){
    ?>
    <div class="header">
        <!-- <img src="logoBlanco.png" alt="aqui va el logo"> -->
        <a href="index.php">Inicio</a>    
        <a href="">Cerrar Sesion</a>
    </div>
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
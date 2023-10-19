<!DOCTYPE html>
<?php
    session_start();   
    include("Funciones.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
<header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div>
            <a href="inicioAlumno.php">Inicio</a>
        </div>
        <div>
            <a href="perfilAlumno.php"> Mi perfil </a>
        </div>
        <div>
            <a href="cerrarSesion.php"> Cerrar Sesion </a>
        </div>
    </header>
<?php
    if($_SESSION["userType"]!="student"){
        echo "<h1>No tienes acceso a esta pagina</h1>";
        echo "<meta http-equiv='refresh' content ='2; url=index.php'>";
    }else{
        if ($_GET){
            fillInfoStudent($_GET['id']);
        }else if ($_POST){
            $_SESSION['dni']=$_POST['dni'];
            updateStudent();
?>
<meta http-equiv="refresh" content="0; url=perfilAlumno.php">;
<?php
        }
    }
?>
</body>
</html>
<?php
    session_start();
    $_SESSION["screen"] = "listadoCursos";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cursos</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    <?php 
        if(isset($_SESSION["start"])){
    ?>
    <header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div>
            <a href="perfilAlumno.php"> Mi perfil </a>
        </div>
        <div>
            <a href="cerrarSesion.php"> Cerrar Sesion</a>
        </div>
    </header>
    <div class="listado">
        <?php
            include("Funciones.php");
            if(isset($_SESSION["userType"])){
        ?>
        <div class="buscador">
            <form action="listarCursos.php" method="POST">
                <label for="codigo">Buscador:</label>
                <input type="text" name="busqueda">
                <input type="submit" value="Aceptar">
            </form>
        </div>
        <div class="tabla">
            <h1>CURSOS</h1>
            <?php
                if(isset($_POST["busqueda"])){
                    listaCursos(conexion(),$_POST["busqueda"],$_SESSION["userType"]);
                }else{
                    listaCursos(conexion(),"",$_SESSION["userType"]);
                }
                }else{
                    echo "<h1>No tienes acceso a esta pagina</h1>";
                    echo "<meta http-equiv='refresh' content ='2; url=index.php'>";
                }
                
                if($_SESSION["userType"]=="admin"){
                    echo "<a class='button' href='controlAdmin.php?id='admin''>Atras</a>";
                }elseif($_SESSION["userType"]=="student"){
                    echo "<a class='button' href='inicioAlumno.php?id='student'>Atras</a>";
                } 
            ?>
        </div>
    </div>
    <footer>
        <img src="logoBlanco.png" alt="Logo de la academia con la letra en blanco" width="100px" height="50px">
        <div>
            Calle Invent, 69 08917 Badalona <br>
            +34 677 424 950 <br>
        </div>
        <div>
            <ul>   
                <li><a href="">Instagram</a></li>
                <li><a href="">Facebook</a></li>
                <li><a href="">Twitter</a></li>
            </ul>  
        </div>
    </footer>
    <?php
        }else{
            echo "<h1>NO TIENES ACCESO A ESTA PAGINA</h1>";
            echo "<meta http-equiv='refresh' content ='2; url=index.php'>";
        }
    ?>
   
</body>
</html>
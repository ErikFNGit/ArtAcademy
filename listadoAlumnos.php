<?php
    session_start();
    include("Funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista del alumnado</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    
    <header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div>
            <a href="cerrarSesion.php"> Cerrar Sesion</a>
        </div>
    </header>
    <?php
        if($_SESSION["userType"] != "admin"){
            echo "<h1>No tienes acceso a esta pagina</h1>";
            echo "<meta http-equiv='refresh' content ='2; url=index.php'>";
        }else{
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
    <label for="arhivo">Ingresar alumnos con archivo local: </label>
    <input type="file" id="archivo">
    <?php
  
        if(isset($_POST["alumnos"])){
            $alumnos = $_POST["alumnos"];
            $alumnos = explode("/,",$alumnos);
            echo "Primer explode"; 
            print_r($alumnos);
            $_SESSION["alumnos"] = $alumnos;
            unset($_POST["alumnos"]);
        }
        echo "<div> <a href='listadoAlumnos.php?id=1' class='button'>Subir archivos</a> </div>";


        if(isset($_GET["id"]) and $_GET["id"] == 1){
            $alumnos = $_SESSION["alumnos"];
            foreach($alumnos as $alumno){
                $alumno = explode(",",$alumno);
                $dni = $alumno[0];
                $nombre = $alumno[1];
                $apellido = $alumno[2];
                $mail = $alumno[3];
                $passwd = $alumno[4];
                $edad = $alumno[5];
                addStudent(conexion(),$dni,$nombre,$apellido,$mail,$passwd,$edad,"img/sinFoto.jpg");
            }
            unset($_SESSION["alumnos"]);
            unset($_GET["id"]);
            echo "<meta http-equiv='refresh' content ='0; url=listadoAlumnos.php'>";

        }
    ?>      
    <div id="resultado"></div> 
    <script src="cargarAlumnos.js"></script>
    <a href='controlAdmin.php'>Atras</a>
    <?php
        }
    ?>
</body>
</html>
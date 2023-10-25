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
            <a href="paginaPrincipal.php">Inicio</a>
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
  
    
    <div class="listado"> 
        <div class="buscador">
            <form action="listadoAlumnos.php" method="POST">
                <label for="codigo">Buscador:</label>
                <input type="text" name="busqueda">
                <input type="submit" value="Aceptar">
            </form>
        </div>  
        <?php
        if(isset($_POST["busqueda"]))
        {
            listarAlumnos(conexion(),$_POST["busqueda"]);
        }else{
            listarAlumnos(conexion(),"");

        }
        ?>
        <div class="lbl">
            <label for="archivo">Ingresar alumnos con archivo local:</label>
            <input type="file" id="archivo">
            <div> <a href='listadoAlumnos.php?id=1' class='button'>Subir archivos</a> </div>
        </div>
    </div>
   
    <?php
  
        if(isset($_POST["alumnos"])){
            $alumnos = $_POST["alumnos"];
            $alumnos = explode("/,",$alumnos);
            $_SESSION["alumnos"] = $alumnos;
            unset($_POST["alumnos"]);
        }


        if(isset($_GET["id"]) and $_GET["id"] == 1){
            $matriculas = [];
            $alumnos = $_SESSION["alumnos"];
            foreach($alumnos as $alumno){
                $datos = explode(",",$alumno);
                $dni = $datos[0];
                $nombre = $datos[1];
                $apellido = $datos[2];
                $mail = $datos[3];
                $passwd = $datos[4];
                $edad = $datos[5];
                addStudent(conexion(),$dni,$nombre,$apellido,$mail,$passwd,$edad,"img/sinFoto.jpg");
                $cursos = str_replace(["(",")","/"],"",$datos[7]);
                $cursos = explode("-",$cursos);
                unset($cursos[0]);
                $matriculas[$dni] = $cursos;
            }
            foreach($matriculas as $dni=>$cursos){
                foreach($cursos as $curso){
                    echo trim($dni);
                    insertMatricula(conexion(),trim($dni),$curso);
                }
            }
            unset($_SESSION["alumnos"]);
            unset($_GET["id"]);
            echo "<meta http-equiv='refresh' content ='0; url=listadoAlumnos.php'>";
        }
    ?>      
    <script src="cargarAlumnos.js"></script>
    <?php
        }
    ?>
</body>
</html>
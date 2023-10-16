<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dar curso de alta</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    <?php
        include("Funciones.php");
        if(!isset($_POST["nuevocurso"]))
        {
            
    ?>
    <header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div>
            <a href="cerrarSesion.php"> Cerrar Sesion</a>
        </div>
    </header>
            <div class="formulario">
                <h1>Añadir curso</h1>

                <form action="crearCurso.php" method="POST">
                    <table>
                        <tr>
                            <td><label for="name">Nombre del curso:</label></td>
                            <td><input type="text" name="nuevocurso[]" id="" required></td>
                        </tr>
                        <tr>
                            <td><label for="descp">Descripcion del curso:</label></td>
                            <td><input type="text" name="nuevocurso[]" id="" required></td>
                        </tr>
                        <tr>
                            <td><label for="horas">Horas del curso:</label></td>
                            <td><input type="number" name="nuevocurso[]" id="" required></td>
                        </tr>
                        <tr>
                            <td><label for="inicio">Inicio del curso:</label></td>
                            <td><input type="date" name="nuevocurso[]" id=""  min="<?php echo date('Y-m-d'); ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="fin">Fin del curso:</label></td>
                            <td><input type="date" name="nuevocurso[]" id="" required></td>
                        </tr>
                        <tr>
                            <td><label for="profe">Profesor asignado:</label></td>
                            <td><?php  selectTeachers("","0"); ?> </td>
                        </tr>
                        <tr>
                            <td><label for="activo">Curso activo:</label></td>
                            <td>
                                <input type="radio" name="activo" value="si">Si</input>
                                <input type="radio" name="activo" value="no">No</input>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Aceptar"></td>
                        </tr>
                    </table>
                </form>
            </div>
            <a href = 'controlAdmin.php'> Atras </a>  
        <?php
        }
        else
        {
            addCurso(conexion());
            
            echo "<meta http-equiv='refresh' content ='0; url=listarCursos.php'>";
        }   
        ?>
</body>
</html>
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
        if(!isset($_POST["name"]))
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
                            <td class="lbl"><label for="name">Nombre del curso:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="name" id="" required></td>
                        </tr>
                        <tr>
                            <td class="lbl"><label for="horas">Horas del curso:</label></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="hours" id="" required></td>
                        </tr>
                        <tr>
                            <td class="lbl"><label for="inicio">Inicio del curso:</label></td>
                            <td class="lbl"><label for="fin">Fin del curso:</label></td>
                        </tr>
                        <tr>
                            <td><input type="date" name="start" id=""  min="<?php echo date('Y-m-d'); ?>" required></td>
                            <td><input type="date" name="end" id="" min="<?php echo date('Y-m-d'); ?>" required></td>
                        </tr>
                        <tr>
                            <td class="lbl"><label for="profe">Profesor asignado:</label></td>
                        </tr>
                        <tr>
                            <td><?php  selectTeachers("","0"); ?> </td>
                        </tr>
                        <tr>
                            <td class="lbl"><label for="activo">Curso activo:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="activo" value="si">Si</input>
                                <input type="radio" name="activo" value="no">No</input>
                            </td>
                        </tr>
                        <tr>
                            <td class="lbl"><label for="desc">Descripcion del curso:</label></td>
                        </tr>
                        <tr>
                            <td colspan=2><textarea name="descripcion" maxlength=254 required></textarea></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Aceptar"></td>
                        </tr>
                    </table>
                    <a href = 'controlAdmin.php' class="button"> Atras </a>  
                </form>
            </div>
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
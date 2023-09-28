<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include("Funciones.php");
        if(!isset($_POST["nuevocurso"]))
        {
            
    ?>
    
    <p>Art Academy</p>
            <form action="crearCurso.php" method="POST">
                <table>
                    <tr>
                        <td>
                            <label for="name">Nombre del curso:</label>
                        </td>
                        <td>
                            <input type="text" name="nuevocurso[]" id="" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="descp">Descripcion del curso:</label>
                        </td>
                        <td>
                            <input type="text" name="nuevocurso[]" id="" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="horas">Horas del curso:</label>
                        </td>
                        <td>
                            <input type="number" name="nuevocurso[]" id="" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="inicio">Inicio del curso:</label>
                        </td>
                        <td>
                            <input type="date" name="nuevocurso[]" id="" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="fin">Fin del curso:</label>
                        </td>
                        <td>
                            <input type="date" name="nuevocurso[]" id="" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="profe">Profesor asignado:</label>
                        </td>
                        <td>
                            <?php
                                selectTeachers("","0");
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="activo">Curso activo:</label>
                        </td>
                        <td>
                           <input type="radio" name="activo" value="si">Si</input>
                        </td>
                        <td>
                           <input type="radio" name="activo" value="no">No</input>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Aceptar">
                        </td>
                    </tr>
                </table>
            </form>
            <form action="index.php" method="GET">
                <input type="submit" value="Atras"/>
            </form>
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
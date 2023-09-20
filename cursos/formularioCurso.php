<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Curso</title>
</head>
<body>
<?php 
        include("funcionesCurso.php");
        if(isset($_POST["nuevocurso"]))
        {
            addCurso(connectDB());
        }
        else
        {
    ?>
            <p>Art Academy</p>
            <form action="formularioCurso.php" method="POST">
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
                            <input type="text" name="nuevocurso[]" id="" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Aceptar">
                        </td>
                    </tr>
                </table>
            </form>
    <?php 
        }
    ?>
</body>
</html>
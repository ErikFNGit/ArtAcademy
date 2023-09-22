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
        if(isset($_POST["codigo"]) && !isset($_POST["cursoEdit"]))
        {
            buscarCurso(conexion(),$_POST["codigo"]);
    ?>
            <form action="editorCurso.php" method="POST">
                <input type="hidden" name="clave" value=
                <?php
                    echo $_POST["codigo"];
                ?>>
                <table>
                    <tr>
                        <td>
                            <label for="name">Nombre del curso:</label>
                        </td>
                        <td>
                            <input type="text" name="cursoEdit[]" id="" value= 
                            <?php
                                echo $_POST["name"];
                            ?>
                            required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="descp">Descripcion del curso:</label>
                        </td>
                        <td>
                            <input type="text" name="cursoEdit[]" id="" value= 
                            <?php
                                echo $_POST["description"];
                            ?>
                            required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="horas">Horas del curso:</label>
                        </td>
                        <td>
                            <input type="number" name="cursoEdit[]" id="" 
                            value= 
                            <?php
                                echo $_POST["hours"];
                            ?>
                            required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="inicio">Inicio del curso:</label>
                        </td>
                        <td>
                            <input type="date" name="cursoEdit[]" id="" value= 
                            <?php
                                echo $_POST["sDate"];
                            ?>
                            required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="fin">Fin del curso:</label>
                        </td>
                        <td>
                            <input type="date" name="cursoEdit[]" id="" 
                            value= 
                            <?php
                                echo $_POST["eDate"];
                            ?>
                            required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="profe">Profesor asignado:</label>
                        </td>
                        <td>
                            <input type="text" name="cursoEdit[]" id="" 
                            value= 
                            <?php
                                echo $_POST["teacher_id"];
                            ?>
                            required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Aceptar">
                        </td>
                    </tr>
                </table>
            </form>
            <form action="index.html">
                <input type="submit" value="Atras"/>
            </form>
    <?php
        }
        elseif(isset($_POST["cursoEdit"]))
        {
            editCurso(conexion(), $_POST["clave"]);
        }
        else
        {
    ?>
    <p>Editor de cursos:</p>
    <form action="editorCurso.php" method="POST">
        <label for="codigo">Buscador:</label>
        <input type="text" name="codigo">
        <input type="submit" value="Aceptar">
    </form>
    
  

    <?php
        listarCursos(conexion());
        

        }
    ?>
    <form action="index.html">
        <input type="submit" value="Atras"/>
    </form>
</body>
</html>
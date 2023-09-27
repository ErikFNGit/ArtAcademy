<?php
    include("Funciones.php");
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
    if(!isset($_POST["editCurso"]))
    {
    ?>
    <form action="editarCurso.php" method="POST">
        <table>
        <p>Art Academy</p>
            <form action="crearCurso.php" method="POST">
                <input type="hidden" name="codigo" value=<?php echo $_POST["codigo"] ?>>
                <table>
                    <tr>
                        <td><label for="name">Nombre del curso:</label></td>
                        <td><input type="text" name="editCurso[]" id=""  value='<?php echo $_POST["name"]?>'required></td>
                    </tr>
                    <tr>
                        <td><label for="descp">Descripción del curso:</label></td>
                        <td><input type="text" name="editCurso[]" id=""  value='<?php echo $_POST["description"]?>'required></td>
                    </tr>
                    <tr>
                        <td><label for="horas">Duración (horas) del curso:</label></td>
                        <td><input type="text" name="editCurso[]" id=""  value='<?php echo $_POST["hours"]?>'required></td>
                    </tr>
                    <tr>
                        <td><label for="sDate">Fecha de inicio del curso:</label></td>
                        <td><input type="date" name="editCurso[]" id=""  value='<?php echo $_POST["sDate"]?>'required></td>
                    </tr>
                    <tr>
                        <td><label for="sDate">Fecha de finalización del curso:</label></td>
                        <td><input type="date" name="editCurso[]" id=""  value='<?php echo $_POST["eDate"]?>'required></td>
                    </tr>
                    <tr>
                        <?php if($_POST["active"]=="0"){ ?>
                        <td>
                            <label for="radio">Activo:</label>
                            <input type="radio" name="active" value="si">Si</input>
                            <input type="radio" name="active" value="no" checked="checked">No</input>
                        </td>
                        <?php }else{ ?>
                        <td>
                            <label for="radio">Activo:</label>
                            <input type="radio" name="active" namevalue="si" checked="checked">Si</input>
                            <input type="radio" name="active" value="no">No</input>
                        </td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><label for="profe">Profesor asignado:</label></td>
                        <td><?php selectTeachers(conexion(),"editCurso[]",$_POST["teacher_id"],$_POST["codigo"])?></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Aceptar">
                        </td>
                    </tr>
                </table>
            </form>
        </table>
    </form>
    <?php 
    }else{
        updateCurso(conexion(),$_POST["codigo"]);
        echo "<meta http-equiv='refresh' content ='0; url=listarCursos.php'>";
    }
    ?>
    <form action="listarCursos.php" method="GET">
        <input type="submit" value="Atras"/>
    </form>
</body>
</html>
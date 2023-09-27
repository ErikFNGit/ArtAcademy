<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include("Funciones.php"); if(!isset($_POST["dni"])){?>
    <form action="registrarAlumno.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label>Dni: </label></td>
                <td><input type="text" name="dni" required></td>
            </tr>
            <tr>
                <td><label>Nombre: </label></td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td><label>Apellido: </label></td>
                <td><input type="text" name="surname" required></td>
            </tr>
            <tr>
                <td><label>Contraseña: </label></td>
                <td><input type="password" name="passwd" required></td>
            </tr>
            <tr>
                <td><label>Edad: </label></td>
                <td><input type="number" name="age" required></td>
            </tr>
            <tr>
                <td><label>Foto: </label></td>
                <td><input type="file" name="photo" required></td>
            </tr>       
            </tr>
                <td><input type="submit" value="Registrarse"></td>
            </tr>
                </tr>
            </table>
    </form>
    <?php }else{
        addStudent(conexion());
        echo "<meta http-equiv='refresh' content ='0; url=index.html'>";

    }
    ?>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
    <?php
    include("Funciones.php");
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de profesores</title>
</head>
<body>
    <?php
    if($_POST){
        if(DNIExistente()==false && IDExistente()==false){
            nuevoTeacher();
            echo"<h2>Profesor@ registrado con exito</h2>";
        }else{
            echo"<p>Error, este DNI o est ID ya están en uso</p>";
        }
    
    ?>
    <meta http-equiv="REFRESH" content="2;url=AltaProfes.php">
    <?php
    }else{
    ?>
<form action="AltaProfes.php" method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <td><label>Id: </label></td>
            <td><input type="text" name="id" required></td>
        </tr>
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
            <td><input type="password" name="pass" required></td>
        </tr>
        <tr>
            <td><label>Titulo: </label></td>
            <td><input type="text" name="title" required></td>
        </tr>
        <tr>
            <td><label>Foto: </label></td>
            <td><input type="file" name="photo" required></td>
        </tr>
        <tr>
            <td><label>Activo: </label></td>
            <td><input type="radio" id="yes" name="active" value ="yes" required></td>
            <td><label for="yes">Si</label></td>
            <td><input type="radio" id="no" name="active" value = "no" required></td>
            <td><label for="no">No</label></td>
        </tr>       
        </tr>
            <td><input type="submit" value="Registrarse"></td>
        </tr>
    </table>
</form>
    <a href = 'index.php'> Atras </a>  
    <?php
    }
    ?>    
</body>
</html>
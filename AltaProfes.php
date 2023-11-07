<!DOCTYPE html>
<html lang="en">
    <?php
        session_start();
        include("Funciones.php");
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de profesores</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    <?php
    if($_SESSION["userType"]!="admin"){
        echo "<h1>No tienes acceso a esta pagina</h1>";
        echo "<meta http-equiv='refresh' content ='2; url=loginUsuario.php'>";
    }else{
        if($_POST){
            if(DNIExistente()==false && IDExistente()==false){
                if(comprobarDNI($_POST["dni"])==true){
                    nuevoTeacher();
                    echo"<h2>Profesor@ registrado con exito</h2>";
                }else{
                    echo"<p>Este DNI no es correcto </p>";
                }
            }else{
                echo"<p>Error, este DNI o est ID ya están en uso</p>";
            }
    
    ?>
    <meta http-equiv="REFRESH" content="2;url=AltaProfes.php">
    <?php
    }else{
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
                    <td><input type="radio" id="yes" name="active" value ="yes" required>Si</input></td>
                    <td><input type="radio" id="no" name="active" value = "no" required>No</input></td>
                </tr>       
                <tr>
                    <td><input type="submit" value="Registrarse" class="button"></td>
                    <td><a href = 'controlAdmin.php' class="button"> Atras </a>  </td>
                </tr>
            </table>
    </form>
</div>

    
    <?php
        }
    }
    ?>    
</body>
</html>
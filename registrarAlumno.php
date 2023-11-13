<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
    <?php include("Funciones.php"); 
    if(!isset($_POST["dni"])){
    ?>
    <header>
        <div>
            <img src="logoNegro.png" alt="Logo de la academia con la letra en negro" width="100px" height="50px">
        </div>
        <div></div>
        <div>
            <a href="index.php">Inicio</a>
        </div>
        <div>
            <a href="loginUsuario.php"> Iniciar Sesion </a>
        </div>
    </header>
    <div class="formulario">
        <form action="registrarAlumno.php" method="post" enctype="multipart/form-data">
            <h2>Introduzca sus datos a continuacion: </h2>
            <table>
                <tr>
                    <td><label class="lbl">Dni: </label></td>
                    <td><input type="text" name="dni" required></td>
                </tr>
                <tr>
                    <td><label class="lbl">Nombre: </label></td>
                    <td><input type="text" name="name" required></td>
                </tr>
                <tr>
                    <td><label class="lbl">Apellido: </label></td>
                    <td><input type="text" name="surname" required></td>
                </tr>
                <tr>
                    <td><label class="lbl">Correo electronico: </label></td>
                    <td><input type="text" name="mail" required></td>
                </tr>
                <tr>
                    <td><label class="lbl">Contraseña: </label></td>
                    <td><input type="password" name="passwd" required></td>
                </tr>
                <tr>
                    <td><label class="lbl">Edad: </label></td>
                    <td><input type="date" name="age" required></td>
                </tr>
                <tr>
                    <td><label class="lbl">Foto: </label></td>
                    <td><input type="file" name="photo" required></td>
                </tr>       
                </tr>
                    <td><input type="submit" value="Registrarse" class="button"></td>
                    <td><a class="button" href = 'loginUsuario.php'> Atras </a></td>
                </tr>
                    </tr>
                </table>
        </form>
    </div>
    <footer class="footerAbs">
        <img src="logoBlanco.png" alt="Logo de la academia con la letra en blanco" width="100px" height="50px">
        <div>
            Calle Invent, 69 08917 Badalona <br>
            +34 677 424 950 <br>
        </div>
        <div>
            <ul>   
                <li><a href="">Instagram</a></li>
                <li><a href="">Facebook</a></li>
                <li><a href="">Twitter</a></li>
            </ul>  
        </div>
    </footer>
  
    <?php 
    }else if (comprobarDNI($_POST["dni"])==true){
        if(!checkID(conexion(),$_POST["dni"]))
        {
            $_SESSION["userType"]="student";
            $_SESSION["dni"]=$_POST["dni"];
            addStudent(conexion(),$_POST["dni"],$_POST["name"],$_POST["surname"],$_POST["mail"]
            ,$_POST["passwd"],$_POST["age"],$_FILES["photo"]["tmp_name"], $_FILES["photo"]["name"]);
            echo "<meta http-equiv='refresh' content ='0; url=inicioAlumno.php'>";
        }else{
            unset($_POST["dni"]);
            unset($_POST["name"]);
            unset($_POST["surname"]);
            unset($_POST["mail"]);
            unset($_POST["passwd"]);
            unset($_POST["age"]);
            unset($_POST["photo"]);
            session_destroy();
            echo "<h1>Este DNI ya se ha registrado</h1>";
            echo "<meta http-equiv='refresh' content ='5; url=loginUsuario.php'>";
        }
    }else{
        echo"<p>Dni invalido, porfavor, asegurese de introducir un DNI correcto</p>";
        unset($_POST["dni"]);
        unset($_POST["name"]);
        unset($_POST["surname"]);
        unset($_POST["mail"]);
        unset($_POST["passwd"]);
        unset($_POST["age"]);
        unset($_POST["photo"]);
        session_destroy();
        echo "<meta http-equiv='refresh' content ='15; url=registrarAlumno.php'>";
    }
    ?>
</body>
</html>
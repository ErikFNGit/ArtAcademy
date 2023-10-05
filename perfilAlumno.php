<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mainSCSS.css">
</head>
<body>
<?php
    if($_SESSION['userType']!="student"){
        echo "<h1>No tienes acceso a esta pagina</h1>";
        echo "<meta http-equiv='refresh' content ='2; url=index.php'>";
    }else{
        include("Funciones.php");
        perfilStudent($_SESSION["dni"]);
        echo"<a href='inicioAlumno.php'>Atras</a>";
    }
?>        
</body>
</html>
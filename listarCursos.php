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
    ?>
    <form action="listarCursos.php" method="POST">
        <label for="codigo">Buscador:</label>
        <input type="text" name="busqueda">
        <input type="submit" value="Aceptar">
    </form>
    <table>
        <tr>
            <td style="border:solid">
                ID 
            </td>
            <td style="border:solid">
                Nombre 
            </td>
            <td style="border:solid">
                Descripcion 
            </td>
            <td style="border:solid">
                Duracion (horas) 
            </td>
            <td style="border:solid">
                Fecha inicio 
            </td>
            <td style="border:solid">
                Fecha Fin 
            </td>
            <td style="border:solid">
                Profesor Asignado 
            </td>
            <td style="border:solid">
                Activo
            </td>
        </tr>
        <?php
            if(isset($_POST["busqueda"]))
            {
                listaCursos(conexion(),$_POST["busqueda"]);

            }else{
                listaCursos(conexion(),"");
            }
        ?>
    </table>
    <form action="index.html" method="GET">
        <input type="submit" value="Atras"/>
    </form>
    
</body>
</html>
<?php
    function addCurso($connection)
    {
        $datos = "";
       foreach($_POST["nuevocurso"] as $dato)
       {
            $datos = $datos."'$dato',"; 
       }
       $datos = substr($datos,0,-1);
       $insertNewCourse = "INSERT INTO `curso`(`name`, `description`, `hours`, `sDate`, `eDate`, `teacher_id`) 
       VALUES ($datos);";
       mysqli_query($connection,$insertNewCourse);
    }
    function buscarCurso($connection,$code)
    {

        $cursoE = "SELECT * FROM curso 
        WHERE code = $code";

        $curso = mysqli_query($connection,$cursoE);
        $curso = mysqli_fetch_array($curso,MYSQLI_ASSOC);
        foreach($curso as $clave => $dato)
        {
            $_POST[$clave] = $dato;
        }
    }
    function editCurso($connection, $code)
    {
        $set = "name='".$_POST["cursoEdit"][0]."', description='".$_POST["cursoEdit"][1].
        "',hours='".$_POST["cursoEdit"][2]."',sDate='".$_POST["cursoEdit"][3].
        "',eDate='".$_POST["cursoEdit"][4]."',teacher_id='".$_POST["cursoEdit"][5]."'";
        

        $query="UPDATE curso
        SET ".$set." WHERE code=".$code; 
        

        mysqli_query($connection,$query);
    }


    function listarCursos($connection)
    {
        $query = "SELECT * FROM curso";
        $cursos = mysqli_query($connection, $query);
        echo "<table>";
        echo "<tr>";
        echo 
            "<td>
                ID |
            </td>
            <td>
                Nombre |
            </td>
            <td>
                Descripcion |
            </td>
            <td>
                Duracion (horas) |
            </td>
            <td>
                Fecha inicio |
            </td>
            <td>
                Fecha Fin |
            </td>
            <td>
                Profesor Asignado |
            </td>";
        echo "</tr>";
        for($i=0; $i<mysqli_num_rows($cursos);$i++)
        {
            $curso = mysqli_fetch_array($cursos, MYSQLI_ASSOC);
            echo "<tr>";

            foreach($curso as $clave=>$dato)
            {

                echo "<td>";
                    echo $dato." |";
                echo "</td>";
                
            }
            echo "</tr>";

            
        }
        echo "</table>";


    }









    function conexion(){
            $conexion = mysqli_connect("localhost","root","","ArtAcademy");
            return $conexion;
        }
    function DNIExistente(){
        //Comprobamos la conexion
        $conexion=conexion();
        if($conexion == FALSE){
            echo"Error en la base de datos";
            mysqli_connect_error();
            exit();
        }
        $comprobarDNI=$_POST['dni'];
        $query="SELECT dni FROM teachers WHERE dni = ?";
        $consulta = $conexion->prepare($query);
        //Una vez la query preparada, usamos blind_param para indicar que el valor de comprobarDNI es de tipo string
        $consulta->bind_param("s",$comprobarDNI);
        if($consulta->execute() === true){
            //Si la consulta puede ser ejecutada, obtenemos su resultado y a continuacion contrastamos con lo que hay en la base de datos. Devuelve true si ya existe, false si no
            $answer=$consulta->get_result();
            if ($answer->num_rows>0){
                return true;
            }else{
                return false;
            }
            }else{
                echo"Error en la consulta";
            }
        }
        function IDExistente(){
            //Comprobamos la conexion
            $conexion=conexion();
            if($conexion == FALSE){
                echo"Error en la base de datos";
                mysqli_connect_error();
                exit();
            }
            $comprobarID=$_POST['id'];
            $query="SELECT dni FROM teachers WHERE id= ?";
            $consulta = $conexion->prepare($query);
            //Una vez la query preparada, usamos blind_param para indicar que el valor de comprobarDNI es de tipo string
            $consulta->bind_param("s",$comprobarID);
            if($consulta->execute() === true){
                //Si la consulta puede ser ejecutada, obtenemos su resultado y a continuacion contrastamos con lo que hay en la base de datos. Devuelve true si ya existe, false si no
                $answer=$consulta->get_result();
                if ($answer->num_rows>0){
                    return true;
                }else{
                    return false;
                }
                }else{
                    echo"Error en la consulta";
                }
            }
    function nuevoTeacher(){
        $conexion = conexion();
        //Comprobamos que se ha hecho la conexion. Si da error, detiene la ejecucion del codigo
        if($conexion == FALSE){
            echo"Error en la base de datos";
            mysqli_connect_error();
            exit();
        }
        //Preparamos la query para insertar el usuario
        $query="INSERT INTO teachers (id, dni, name, surname, password, title, picture, active) VALUES (?,?,?,?,?,?,?,?)";
        $consulta = $conexion->prepare($query);
        $id=$_POST['id'];
        $dni=$_POST['dni'];
        $name=$_POST['name'];
        $surname=$_POST['surname'];
        $password=md5($_POST['pass']);
        $title=$_POST['title'];
        $picture=$_POST['photo'];
        $active=($_POST['active']==='yes')?1:0;
        //Usmoas bind_param para asginarle los valores a la query y ejecutarla
        $consulta->bind_param("ssssssbi",$id,$dni,$name,$surname,$password, $title,$picture,$active );
        $consulta->execute();
        $consulta->close();
        $conexion->close();
    }
    function fillInfoTeacher(){
        $conexion = conexion();
        //Comprobamos que se ha hecho la conexion. Si da error, detiene la ejecucion del codigo
        if($conexion == FALSE){
            echo"Error en la base de datos";
            mysqli_connect_error();
            exit();
        }
        $query="SELECT id, dni, name, surname, title, active FROM teachers WHERE id = ?";
        $id=$_POST['find'];
        $consulta = $conexion->prepare($query);
        $consulta->bind_param("i",$id);
        if($consulta->execute()){
            $datos=$consulta->get_result();
            if($datos->num_rows>0){
            $row= $datos->fetch_assoc();
            ?>
        <form action="Edicion.php" method="POST">
        <table>
            <tr>
                <input type="hidden" name="id" value=<?php echo $row['id']; ?>>
                <td><label>Dni: </label></td>
                <td><input type="text" name="dni" value=<?php echo $row['dni'];?> required></td>
            </tr>
            <tr>
                <td><label>Nombre: </label></td>
                <td><input type="text" name="name" value=<?php echo $row['name'];?> required></td>
            </tr>
            <tr>
                <td><label>Apellido: </label></td>
                <td><input type="text" name="surname" value=<?php echo $row['surname'];?> required></td>
            </tr>
            <tr>
                <td><label>Titulo: </label></td> 
                <td><input type="text" name="title" value=<?php echo $row['title'];?> required></td>
            </tr>
            <tr>
                <td><label>Activo: </label></td>
                <td><input type="radio" id="yes" name="active" value ="yes" value=<?php echo $row['active']==1 ?'cheked':'';?> required></td>
                <td><label for="yes">Si</label></td>
                <td><input type="radio" id="no" name="active" value = "no" value=<?php echo $row['active']==0  ?'cheked':'';?> ></td>
                <td><label for="no">No</label></td>
            </tr>       
            </tr>            <td><input type="submit" value="Editar"></td>
                <td><a href='EditarProfes.php'>Atras</a></td>
            </tr>
        </table>
    </form>
            <?php
            }else{
            echo"<h2>Este id no correspone a ningun profesor</h2>";
            }
        $consulta->close(); 
    }
    
    }
    function updateTeacher(){
        $conexion = conexion();
        //Comprobamos que se ha hecho la conexion. Si da error, detiene la ejecucion del codigo
        if($conexion == FALSE){
            echo"Error en la base de datos";
            mysqli_connect_error();
            exit();
        }
        //Preparamos la query para insertar el usuario
        $query="UPDATE teachers SET name=?, surname=?, title=?, active=? WHERE id=?";
        $consulta = $conexion->prepare($query);
        $id=$_POST['id'];
        $name=$_POST['name'];
        $surname=$_POST['surname'];
        $title=$_POST['title'];
        $active=($_POST['active']==='yes')?1:0;
        $consulta = $conexion->prepare($query);
        //Usmoas bind_param para asginarle los valores a la query y ejecutarla
        $consulta->bind_param("sssii",$name,$surname, $title,$active,$id );
        $consulta->execute();
        $consulta->close();
        $conexion->close();
    }
?>

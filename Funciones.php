<?php
   function conexion(){
            $conexion = mysqli_connect("localhost","root","","ArtAcademy");
            return $conexion;
        } 



function addCurso($conexion)
{
    $datos="";
    foreach($_POST["nuevocurso"] as $dato){
        $datos = $datos."'$dato',"; 
    }
    if($_POST["activo"] == "si"){
        $datos = $datos."'1'";
    }else{
        $datos = $datos."'0'";
    }
    $insertNewCourse = "INSERT INTO `curso`(`name`, `description`, `hours`, `sDate`, `eDate`, `teacher_id`, `active`) 
    VALUES ($datos);";
    mysqli_query($conexion,$insertNewCourse);
    $buscarIDcurso = "SELECT code FROM curso WHERE teacher_id='".$_POST["nuevocurso"][5]."';";
    $ID = mysqli_query($conexion, $buscarIDcurso);
    $ID = mysqli_fetch_array($ID, MYSQLI_NUM);
    $ID = $ID[0];
    $updateTeacher = "UPDATE teachers SET curso_id='".$ID."' WHERE id ='".$_POST["nuevocurso"][5]."';";
    echo $updateTeacher;
    mysqli_query($conexion,$updateTeacher);
}

function addStudent($conexion)
{
    $dni=$_POST['dni'];
    $name=$_POST['name'];
    $surname=$_POST['surname'];        
    $password=md5($_POST['passwd']);
    $age = $_POST["age"];
    $picture=$_FILES['photo']['tmp_name'];
        
    if(is_uploaded_file($picture)){    
        $directory= "img/" ;            
        $fileName= $_FILES['photo']['name'];
        $idUnico=time();
        $path=$directory.$idUnico.$fileName;
        move_uploaded_file($picture,$path);
    }else{
        print("Error, no se ha subido la imagen");
    }

    $query="INSERT INTO students (dni, name, surname, stPass, age, picture) VALUES ('$dni','$name','$surname','$password','$age','$path')";
    mysqli_query($conexion,$query);

}

function buscarCurso($connection,$busqueda){

    if($busqueda==""){
        $cursoE = "SELECT * FROM curso";
    }else{
        $cursoE = "SELECT * FROM curso WHERE code = $busqueda"; 
    }
    
    $curso = mysqli_query($connection,$cursoE);
    $curso = mysqli_fetch_array($curso,MYSQLI_ASSOC);
    foreach($curso as $clave => $dato){
        $_POST[$clave] = $dato;
    }
}

function listaCursos($conexion, $busqueda)
{
    if($busqueda=="")
    {
        $query = "SELECT * FROM curso;";
    }else{
        $query = "SELECT * FROM curso WHERE name LIKE '%$busqueda%';"; 
    }
    $cursos = mysqli_query($conexion, $query);
    for($i=0; $i<mysqli_num_rows($cursos);$i++)
    {
        echo "<form action='editarCurso.php' method='POST'>";
        $curso = mysqli_fetch_array($cursos, MYSQLI_ASSOC);
        echo "<tr>";
        echo "<input type='hidden' name='codigo' value='".$curso["code"]."'>";
        foreach($curso as $clave=>$dato)
        {
            echo "<td>";
            if($clave=="active")
            {
                if($dato == "1")
                {
                    echo "Si";
                }else{
                    echo "No";
                }
            }else{
                echo $dato;
            }
            if($clave!="code"){
                echo "<input type='hidden' name='$clave' value='$dato'>";
            }
            echo "</td>";    
        }
        echo 
        "<td>
            <input type='submit' value='Editar'/>
        </td>";
        echo "</tr>";
        echo "<input type='hidden' name='listado'>";
        echo "</form>";    
    }
    echo "</table>";
}

function updateCurso($conexion, $code)
{
    if($_POST["active"]=="no"){
        $activo = "0";
    }else{
        $activo="1";
    }

    $set = "name='".$_POST["editCurso"][0]."', description='".$_POST["editCurso"][1].
    "',hours='".$_POST["editCurso"][2]."',sDate='".$_POST["editCurso"][3].
    "',eDate='".$_POST["editCurso"][4]."',teacher_id='".$_POST["editCurso"][5]."',active='".$activo."'";
    
    $query="UPDATE curso
    SET ".$set." WHERE code=".$code; 
    mysqli_query($conexion,$query);
    $takeTeacher = "UPDATE teachers SET curso_id='0' WHERE curso_id ='$code';";
    mysqli_query($conexion,$takeTeacher);
    $updateTeacher = "UPDATE teachers SET curso_id='$code' WHERE id ='".$_POST["editCurso"][5]."';";
    mysqli_query($conexion,$updateTeacher);
    
}

function selectTeachers($conexion,$nombreListado,$code,$curso)
{
    $query = "SELECT id,curso_id,name,surname FROM teachers WHERE active"."=1;";
    $teachers=mysqli_query($conexion,$query);
    echo "<select name='".$nombreListado."'>";
    for($i=0; $i<mysqli_num_rows($teachers);$i++){
        $teacher=mysqli_fetch_array($teachers, MYSQLI_ASSOC);
        if($teacher["curso_id"]==0 or $teacher["curso_id"]==$curso){
            if($code==$teacher["id"]){
                echo "<option value='".$teacher["id"]."' selected>".$teacher["name"]." ".$teacher["surname"]."</option>";
            }else{
                echo "<option value='".$teacher["id"]."'>".$teacher["name"]." ".$teacher["surname"]."</option>";
            }
        }
    }
    echo "</select>";
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
        $picture=$_FILES['photo']['tmp_name'];
        $active=($_POST['active']==='yes')?1:0;
        //Usmoas bind_param para asginarle los valores a la query y ejecutarla
        

        if(is_uploaded_file($picture)){    
            $directory= "img/" ;
            $fileName= $_FILES['photo']['name'];
            $idUnico=time();
            $path=$directory.$idUnico.$fileName;
            move_uploaded_file($picture,$path);
        }else{
            print("Error, no se ha subido la imagen");
        }
        $consulta->bind_param("sssssssi",$id,$dni,$name,$surname,$password, $title,$path,$active );
        $consulta->execute();
        $consulta->close();
        $conexion->close();
    }
    function fillInfoTeacher($id){
        $conexion = conexion();
        //Comprobamos que se ha hecho la conexion. Si da error, detiene la ejecucion del codigo
        if($conexion == FALSE){
            echo"Error en la base de datos";
            mysqli_connect_error();
            exit();
        }
        $query="SELECT id, dni, name, surname, title, active FROM teachers WHERE id = ?";
        $consulta = $conexion->prepare($query);
        $consulta->bind_param("i",$id);
        if($consulta->execute()){
            $datos=$consulta->get_result();
            if($datos->num_rows>0){
            $row= $datos->fetch_assoc();
            ?>
        <form action="edicionProfes.php" method="POST">
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
                <td><input type="radio" id="yes" name="active" value ="yes" <?php echo $row['active'] == 1 ?'checked':'';?> required><label for="yes">Si</label></td>
                <td><input type="radio" id="no" name="active" value = "no" <?php echo $row['active'] == 0  ?'checked':'';?>><label for="no">No</label></td>
            </tr>       
            </tr>            <td><input type="submit" value="Editar"></td>
                <td><a href='listarProfes.php'>Atras</td>
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
    function listaTeachers($name){
        $conexion=conexion();
        if($conexion == FALSE){
            echo"Error en la base de datos";
            mysqli_connect_error();
            exit();
        }
        $query = "SELECT id, dni, name, surname, title, picture FROM teachers";
        if ($name != ""){
            $query = $query." WHERE name = '$name'";
        }
        $cursos = mysqli_query($conexion, $query);
        echo"<table border = '1'>";
        echo"<tr>";
        echo"<td>ID </td>";
        echo"<td>DNI </td>";
        echo"<td>Nombre </td>";
        echo"<td>Apellido </td>";
        echo"<td>Titulo </td>";
        echo"<td>Foto </td>";
        echo"</tr>";
        for($i=0; $i<mysqli_num_rows($cursos);$i++){
            $curso = mysqli_fetch_array($cursos, MYSQLI_ASSOC);
            echo "<tr>";
            echo "<td>". $curso['id']."</td>";
            echo "<td>". $curso['dni']."</td>";
            echo "<td>". $curso['name']."</td>";
            echo "<td>". $curso['surname']."</td>";
            echo "<td>". $curso['title']."</td>";
            echo "<td><img src='".$curso['picture']."'></td>";
            echo "<td> <a href = 'edicionProfes.php?id=".$curso['id']."'> Editar </a></td>";
            echo "</tr>";
        }
        echo"</table>";
    }
?>
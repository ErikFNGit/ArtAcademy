<?php
function conexion(){
            $conexion = mysqli_connect("localhost","root","","ArtAcademy");
            return $conexion;
} 
function comprobarDNI($dni){
    $dni=strtoupper($dni);
    if (preg_match("/[0-9]{8}[A-Z]$/",$dni)){
        $numeroDni=intval(substr($dni, 0 ,8));
        $letra=substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeroDni % 23,1);
        $letra_usuario=substr($dni,-1);
        if ($letra===$letra_usuario){
            return true;
        }
    }
    return false; 
}
function findStudentID($conexion, $dni){
    $findStudent = "SELECT id FROM students WHERE dni LIKE '".$dni."';";
    $id = mysqli_query($conexion,$findStudent);
    $id = mysqli_fetch_array($id,MYSQLI_NUM);
    $id = $id[0];
    return $id;

}
function addCurso($conexion){
    $datos="";
    $datos=$datos."'".$_POST["name"]."',";
    $datos=$datos."'".$_POST["hours"]."',";
    $datos=$datos."'".$_POST["start"]."',";
    $datos=$datos."'".$_POST["end"]."',";
    $datos=$datos."'".$_POST["idTeacher"]."',";
    $datos=$datos."'".$_POST["descripcion"]."',";
    if($_POST["activo"] == "si"){
        $datos = $datos."'1'";
    }else{
        $datos = $datos."'0'";
    }
    $insertNewCourse = "INSERT INTO `curso`(`name`, `hours`, `sDate`, `eDate`, `teacher_id`, `description`,`active`) 
    VALUES ($datos);";
    mysqli_query($conexion,$insertNewCourse);
    $buscarIDcurso = "SELECT code FROM curso WHERE teacher_id='".$_POST["idTeacher"]."';";
    $ID = mysqli_query($conexion, $buscarIDcurso);
    $ID = mysqli_fetch_array($ID, MYSQLI_NUM);
    $ID = $ID[0];
    $updateTeacher = "UPDATE teachers SET curso_id='".$ID."' WHERE id ='".$_POST["idTeacher"]."';";
    echo $updateTeacher;
    mysqli_query($conexion,$updateTeacher);
}
function addStudent($conexion){
    $dni=$_POST['dni'];
    $name=$_POST['name'];
    $surname=$_POST['surname'];       
    $mail=$_POST['mail'] ;
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
    $query="INSERT INTO students (dni, name, surname, mail, stPass, age, picture) VALUES ('$dni','$name','$surname','$mail', '$password','$age','$path')";
    mysqli_query($conexion,$query);

}
function updateCurso(){
    $conexion = conexion();
    $findTeacher = "SELECT id FROM teachers WHERE curso_id = ".$_POST["id"]."";
    $teacherId = mysqli_query(conexion(),$findTeacher);
    $teacherId = mysqli_fetch_array($teacherId,MYSQLI_ASSOC);
    $teacherId = $teacherId["id"];
    //Comprobamos que se ha hecho la conexion. Si da error, detiene la ejecucion del codigo
    if($conexion == FALSE){
        echo"Error en la base de datos";
        mysqli_connect_error();
        exit();
    }
    //Preparamos la query para insertar el usuario
    $query="UPDATE curso SET name=?, description=?, hours=?, sDate=?, eDate=?, teacher_id=?, active=? WHERE code=".$_POST['id']."";
    $consulta = $conexion->prepare($query);
    $name=$_POST['name'];
    $description=$_POST['description'];
    $hours=$_POST['hours'];
    $sDate=$_POST['start'];
    $eDate=$_POST['end'];
    $teacher=$_POST['idTeacher'];
    $active=($_POST['active']==='yes')?1:0;
    $consulta = $conexion->prepare($query);
    //Usmoas bind_param para asginarle los valores a la query y ejecutarla
    $consulta->bind_param("ssissii",$name, $description, $hours, $sDate, $eDate, $teacher, $active );
    $consulta->execute();
    $consulta->close();
    $query="UPDATE teachers SET curso_id=? WHERE id=?";
    $consulta = $conexion->prepare($query);
    $consulta->bind_param("ii",$_POST['id'],$teacher);
    $consulta->execute();
    $conexion->close();
    $limpiarRegistroProfe = "UPDATE teachers SET curso_id='0' WHERE id='".$teacherId."'";
    mysqli_query(conexion(),$limpiarRegistroProfe);
    

}
function selectTeachers($code,$curso){
    $conexion = conexion();
    //Comprobamos que se ha hecho la conexion. Si da error, detiene la ejecucion del codigo
    if($conexion == FALSE){
        echo"Error en la base de datos";
        mysqli_connect_error();
        exit();
    }
    $query = "SELECT id,curso_id,name,surname FROM teachers WHERE active"."=1;";
    $teachers=mysqli_query($conexion,$query);
    echo "<select name='idTeacher'>";
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
function listarAlumnos($conexion,$busqueda){
    if($busqueda==""){
        $query = "SELECT * FROM students;";
    }else{
        $query = "SELECT * FROM students WHERE name LIKE '%$busqueda%';"; 
    }
    $alumnos = mysqli_query($conexion, $query);
    echo"<table border = '1'>";
        echo"<tr>";
            echo"<td>ID </td>";
            echo"<td>DNI </td>";
            echo"<td>Nomre </td>";
            echo"<td>Apellido </td>";
            echo"<td>Correo </td>";
        echo"</tr>";
    for($i=0; $i<mysqli_num_rows($alumnos);$i++){
        $alumno = mysqli_fetch_array($alumnos, MYSQLI_ASSOC);
        echo "<tr>";
            echo "<td>". $alumno['id']."</td>";
            echo "<td>". $alumno['dni']."</td>";
            echo "<td>". $alumno['name']."</td>";
            echo "<td>". $alumno['surname']."</td>";
            echo "<td>". $alumno['mail']."</td>";
        echo "</tr>";
    }
    echo "</table>";
}
function studentLogin($conexion){
    $dni = $_POST["dni"];
    $passwd = $_POST["passwd"];
    $passwd = md5($passwd);


    $query = "SELECT stPass FROM students WHERE dni LIKE '$dni'";
    $stPass = mysqli_query($conexion,$query);
    $stPass = mysqli_fetch_array($stPass, MYSQLI_NUM);
    $login = false;
    if(isset($stPass[0])){
        $stPass = $stPass[0];
        if($stPass==$passwd){
            $login = true;
        }
    }
   
    return $login;

}
function adminLogin($conexion){
    $ID = $_POST["ID"];
    $passwd = $_POST["passwd"];
    $passwd = md5($passwd);


    $query = "SELECT adminPass FROM datosadministrador WHERE id LIKE '$ID'";
    $adminPass = mysqli_query($conexion,$query);
    $adminPass = mysqli_fetch_array($adminPass, MYSQLI_NUM);
    $login = false;
    if(isset($adminPass[0])){
        $adminPass = $adminPass[0];
        if($adminPass==$adminPass){
            $login = true;
        }
    }
   
    return $login;
}
function checkID($conexion, $codigo){
    $query = "SELECT dni FROM students";
    $resultado = mysqli_query($conexion,$query);
    $esta = false;
    for($i=0; $i<mysqli_num_rows($resultado);$i++){
        $dni = mysqli_fetch_array($resultado, MYSQLI_NUM);
        if($codigo == $dni[0])
        {
            $esta = true;
        }
    }
    return $esta;
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
function fillInfoStudent($id){
    $conexion = conexion();
    //Comprobamos que se ha hecho la conexion. Si da error, detiene la ejecucion del codigo
    if($conexion == FALSE){
        echo"Error en la base de datos";
        mysqli_connect_error();
        exit();
    }
    $query="SELECT id, dni, name, surname, mail, stPass FROM students WHERE id = ?";
    $consulta = $conexion->prepare($query);
    $consulta->bind_param("i",$id);
    if($consulta->execute()){
        $datos=$consulta->get_result();
        if($datos->num_rows>0){
        $row= $datos->fetch_assoc();
        ?>
    <form action="editarEstudiante.php" method="POST">
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
            <td><label>Correo: </label></td>
            <td><input type="text" name="mail" value=<?php echo $row['mail'];?> required></td>
        </tr>  
        <tr>
            <td><label>Contraseña: </label></td>
            <td><input type="password" name="stPass" value=<?php echo $row['stPass']; ?> required></td>
        </tr>            
        <tr>            
            <td><input type="submit" value="Editar"></td>
            <td><a href='perfilAlumno.php'>Atras</td>
        </tr>
    </table>
</form>
        <?php
        }else{
        echo"<h2>Este id no correspone a ningun alumno</h2>";
        }
    $consulta->close(); 
    } 
}
function fillInfoCursos($idCurso){
    $conexion = conexion();
    //Comprobamos que se ha hecho la conexion. Si da error, detiene la ejecucion del codigo
    if($conexion == FALSE){
        echo"Error en la base de datos";
        mysqli_connect_error();
        exit();
    }
    $query="SELECT code, name, description, hours, sDate, eDate, teacher_id, active FROM curso WHERE code = ?";
    $consulta = $conexion->prepare($query);
    $consulta->bind_param("i",$idCurso);
    if($consulta->execute()){
        $datos=$consulta->get_result();
        if($datos->num_rows>0){
        $row= $datos->fetch_assoc();
        $idProfeSelect=$row['teacher_id'];
        ?>
        <div class="formulario">   
            <h1>Editar curso</h1>                 
            <form action="editarCurso.php" method="POST">
                <table>
                    <input type="hidden" name="id" value=<?php echo $row['code']; ?>>
                    <tr>
                        <td><label>Nombre del curso: </label></td>
                        <td><input type="text" name="name" value=<?php echo $row['name'];?> required></td>
                    </tr>
                    <tr>
                        <td><label>Descripcion del curso: </label></td>
                        <td><input type="text" name="description" value=<?php echo $row['description'];?> required></td>
                    </tr>
                    <tr>
                        <td><label>Horas del curso: </label></td> 
                        <td><input type="number" name="hours" value=<?php echo $row['hours'];1?> required></td>
                    </tr>
                    <tr>
                        <td><label>Fecha de inicio: </label></td>
                        <td><input type="date" name="start" value =<?php echo $row['sDate'];?>  min="<?php echo date("Y-m-d"); ?>" required><label for="yes"></label></td>
                    </tr>
                    <tr>
                        <td><label>Fecha de finalizacion: </label></td>
                        <td><input type="date" name="end" value =<?php echo $row['eDate'];?> required><label for="yes"></label></td>
                    </tr>
                    <tr>
                        <td><label>Profesor asignado: </label></td> 
                        <td><?php selectTeachers($idProfeSelect,$idCurso)?></td>
                    </tr>       
                    <tr>
                        <td><label>Activo: </label></td>
                        <td>
                            <input type="radio" id="yes" name="active" value ="yes" <?php echo $row['active'] == 1 ?'checked':'';?> required><label for="yes">Si</label>
                            <input type="radio" id="no" name="active" value = "no" <?php echo $row['active'] == 0  ?'checked':'';?>><label for="no">No</label>
                        </td>
                    </tr>       
                    <tr>
                        <td><input type="submit" value="Editar"></td>
                        <td><a href='listarCursos.php?id=admin'>Atras</td>
                    </tr>
                </table>
            </form> 
        
        </div>
        <?php
        }else{
        echo"<h2>Este id no correspone a ningun curso</h2>";
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
function listaCursos($conexion, $busqueda, $userType){
    if($busqueda==""){
        $query = "SELECT * FROM curso;";
    }else{
        $query = "SELECT * FROM curso WHERE name LIKE '%$busqueda%';"; 
    }
    if($userType=="student"){
        $cursosMatriculado = "SELECT curso_id FROM matricula WHERE student_id LIKE ".findStudentID($conexion, $_SESSION["dni"]);
        $cursosMatriculado = mysqli_query($conexion,$cursosMatriculado);
        $matriculas = [];
        for($i=0; $i<mysqli_num_rows($cursosMatriculado);$i++){
            $placeholder = mysqli_fetch_array($cursosMatriculado, MYSQLI_NUM);
            $matriculas[$i] = $placeholder[0];
        }

    }
    echo"<table>";
            echo"<tr>";
            echo"<td></td>";
            echo"<td>Nombre </td>";
            echo"<td>Descripcion </td>";
            echo"<td>Horas </td>";
            echo"<td>Fecha Inicio </td>";
            echo"<td>Fecha Final </td>";
            echo"<td>Profesor </td>";
        echo"</tr>";
    foreach(findCursos(conexion(),$query) as $curso){
        if($userType=="admin")
        {
            echo "<tr>";
            echo "<td class='indice'>*</td>";
            echo "<td>". $curso['name']."</td>";
            echo "<td>". $curso['description']."</td>";
            echo "<td>". $curso['hours']."</td>";
            echo "<td>". $curso['sDate']."</td>";
            echo "<td>". $curso['eDate']."</td>";
            echo "<td>". $curso['profesor']."</td>";
            echo "<td> <a href = 'editarCurso.php?id=".$curso["code"]."' class='button'> EDITAR </a></td>";

        }elseif($userType=="student" and $curso["active"]=="1" and in_array($curso["code"],$matriculas))
        {
            echo "<tr>";
            echo "<td class='indice'>*</td>";
            echo "<td>". $curso['name']."</td>";
            echo "<td>". $curso['description']."</td>";
            echo "<td>". $curso['hours']."</td>";
            echo "<td>". $curso['sDate']."</td>";
            echo "<td>". $curso['eDate']."</td>";
            echo "<td>". $curso["profesor"]."</td>";
            echo "<td><a href='?llamarDelete&codigo=".$curso["code"]."' class='button'>Desapuntarme</a></td>";
           /* if($_SESSION["screen"] != "inicioAlumno"){
                if(!in_array($curso["code"],$matriculas)){
                    echo "<td><a href='?llamarInsert&codigo=".$curso["code"]."' class='button'>Matricularme</a></td>";
                }else{
                    echo "<td><a href='?llamarDelete&codigo=".$curso["code"]."' class='button'>Desapuntarme</a></td>";
    
                }
            }*/
        }
        echo "</tr>";  
    }
    echo "</table>";
    
}

function cursosDisponibles($conexion){
    $cursosMatriculado = "SELECT curso_id FROM matricula WHERE student_id LIKE ".findStudentID($conexion, $_SESSION["dni"]);
    $cursosMatriculado = mysqli_query($conexion,$cursosMatriculado);
    $matriculas = [];
    for($i=0; $i<mysqli_num_rows($cursosMatriculado);$i++){
        $placeholder = mysqli_fetch_array($cursosMatriculado, MYSQLI_NUM);
        $matriculas[$i] = $placeholder[0];
    }
    $listadoCursos = findCursos(conexion(),"SELECT * FROM curso");
    foreach($listadoCursos as $curso){
        if(!in_array($curso["code"],$matriculas))
        {
            if($curso["sDate"]<date("Y-m-d"))
            {
                echo "<div>";
                    echo "<h1>".$curso["name"]."</h1>";
                    //Aqui ya pues pones tu ya pones la foto y tal
                    echo "<p>".$curso["description"]."</p>";
                    echo "<p>".$curso["hours"]."</p>";
                    echo "<p>".$curso["sDate"]."</p>";
                    echo "<p>".$curso["eDate"]."</p>";
                    echo "<p>".$curso["profesor"]."</p>";
                    echo "<td><a href='?llamarInsert&codigo=".$curso["code"]."' class='button'>Matricularme</a></td>";
                echo "</div>";
            }
        }
    }
    
}

if(isset($_GET["llamarInsert"])){ insertMatricula(conexion(), $_SESSION["dni"], $_GET["codigo"]); }
if(isset($_GET["llamarDelete"])){ dropMatricula(conexion(), $_SESSION["dni"], $_GET["codigo"]); }

function findCursos($conexion, $query){
    $cursos = mysqli_query($conexion, $query);
    $listaCursos = [];
    
    for($i=0; $i<mysqli_num_rows($cursos);$i++){
        $curso = mysqli_fetch_array($cursos, MYSQLI_ASSOC);
        $query2="SELECT name FROM teachers WHERE id = ".$curso['teacher_id']."";
        $nombreprofe=mysqli_query($conexion,$query2);
        $nombreprofe=mysqli_fetch_array($nombreprofe, MYSQLI_ASSOC);
        $curso["profesor"] = $nombreprofe['name'];
        $listaCursos[$i] = $curso;
    }
    return $listaCursos;
}

function insertMatricula($conexion,$alumno,$curso){

    $id = findStudentID($conexion,$alumno);
    $find = "SELECT * FROM matricula WHERE curso_id = $curso AND student_id = $id;";
    $esta = mysqli_query($conexion,$find);
    $esta = mysqli_fetch_array($esta,MYSQLI_NUM);
    try{
        $query = "INSERT INTO matricula (student_id,curso_id) VALUES ($id,$curso);";
        mysqli_query($conexion,$query);
    }catch(Exception $mysqli_sql_exception){}
        
    
}

function dropMatricula($conexion,$alumno,$curso){
    $id = findStudentID($conexion,$alumno);
    $query = "DELETE FROM matricula WHERE curso_id = $curso AND student_id = $id;";
    mysqli_query($conexion,$query);
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
            $query = $query." WHERE name = '%$name%'";
        }
        $cursos = mysqli_query($conexion, $query);
        echo"<table>";
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
            echo "<td> <a class='button' href = 'edicionProfes.php?id=".$curso['id']."'> Editar </a></td>";
            echo "</tr>";
        }
        echo"</table>";
}
function perfilStudent($dni){
    $conexion = conexion();
        //Comprobamos que se ha hecho la conexion. Si da error, detiene la ejecucion del codigo
        if($conexion == FALSE){
            echo"Error en la base de datos";
            mysqli_connect_error();
            exit();
        }
    $query="SELECT name, id, picture FROM students WHERE dni=?";
    $consulta = $conexion->prepare($query);
    $consulta->bind_param("i",$dni );
    $consulta->execute();
    $row=$consulta->get_result();
    $name=$row->fetch_assoc();
    $consulta->close();
    $query2="SELECT curso_id, score FROM matricula WHERE student_id = ".$name['id']."";
    $notas=mysqli_query($conexion, $query2);
    echo"<h2>Bienvenido a tu perfil de estudiante, ".$name['name']. " </h2>";
    echo "<div><img src='".$name['picture']."'></div>";

    echo"<div class='listado'>";
    echo"<div class='tabla'>";
    echo"<table border = '1'>";
    echo"<p>Notas: </p>";
    echo"<th>Curso </th>";
    echo"<th> Nota </th>";
    for($i=0;$i<mysqli_num_rows($notas);$i++){
        $row = mysqli_fetch_array($notas, MYSQLI_ASSOC);
        $query3="SELECT name FROM curso WHERE code =".$row['curso_id']." ";
        $nameCurso=mysqli_query($conexion,$query3);
        $nameCurso=mysqli_fetch_array($nameCurso, MYSQLI_ASSOC);
        echo"<tr>";
        echo "<td>".$nameCurso['name']." </td>";
        echo "<td>".$row['score']." </td>";
        echo"</tr>";
    }
    echo"</table>";
    echo"</div>";
    echo"</div>";
    echo "<td><a href = 'editarEstudiante.php?id=".$name['id']."'> Editar </a></td>";
}
function updateStudent(){
    $conexion = conexion();
    //Comprobamos que se ha hecho la conexion. Si da error, detiene la ejecucion del codigo
    if($conexion == FALSE){
        echo"Error en la base de datos";
        mysqli_connect_error();
        exit();
    }
    //Preparamos la query para insertar el usuario
    $query="UPDATE students SET id=?, dni=?, name=?, surname=?,mail=?, stPass=? WHERE id=?";
    $consulta = $conexion->prepare($query);
    $id=$_POST['id'];
    $dni=$_POST['dni'];
    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $mail=$_POST['mail'];
    $stPass=md5($_POST['stPass']);
    //Usmoas bind_param para asginarle los valores a la query y ejecutarla
    $consulta->bind_param("isssssi",$id,$dni, $name, $surname, $mail, $stPass, $id);
    $consulta->execute();
    $consulta->close();
    $conexion->close();
}
function passOlvidada($dni,$mail,$pass,$passMatch){
    $conexion=conexion();
    if($conexion == FALSE){
        echo"Error en la base de datos";
        mysqli_connect_error();
        exit();
    }
    if($pass == $passMatch){
        $query="UPDATE students SET stPass=? WHERE dni=?";
        $consulta = $conexion->prepare($query);
        $newPass=md5($pass);
        $consulta -> bind_param("ss", $newPass, $dni);
        $consulta->execute();
        $consulta->close();
        $conexion->close();
    }else{
        echo"<p>Ambas contraseñas no coinciden, introduzcalas de nuevo por favor.</p>";
        echo "<meta http-equiv='refresh' content ='10; url=passOlvidada.php'>";
        unset($_SESSION['dni']);
        unset($_SESSION['mail']);
        unset($_POST['pass']);
        unset($_POST['passComprobar']);
    }

    
}
?>
<?php

function conexion(){
    $conexion = mysqli_connect("localhost","root","","ArtAcademy");
    return $conexion;
} 

function addCurso($conexion)
{
    $datos="";
    foreach($_POST["nuevocurso"] as $dato)
    {
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
    if($_POST["active"]=="no")
    {
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
}

function selectTeachers($conexion,$nombreListado,$code)
{
    $query = "SELECT id,name,surname FROM teachers WHERE active"."=1;";
    $teachers=mysqli_query($conexion,$query);
    echo "<select name='".$nombreListado."'>";
    for($i=0; $i<mysqli_num_rows($teachers);$i++){
        $teacher=mysqli_fetch_array($teachers, MYSQLI_ASSOC);
        if($code==$teacher["id"])
        {
            echo "<option value='".$teacher["id"]."' selected>".$teacher["name"]." ".$teacher["surname"]."</option>";
        }else{
            echo "<option value='".$teacher["id"]."'>".$teacher["name"]." ".$teacher["surname"]."</option>";
        }
    }
    echo "</select>";
}




?>
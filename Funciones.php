<?php
    function connectDB()
    {
        $connection = mysqli_connect("localhost","root","","ArtAcademy");
        if($connection == false)
        {
            $connection = mysqli_connect_errror();
        }
        return $connection;
    }

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

?>
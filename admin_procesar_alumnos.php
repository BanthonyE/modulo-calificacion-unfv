<?php
if(!$_POST){
    header('location: admin_listado_alumnos.php');
}
else {
    //incluimos el archivo funciones que tiene la conexion
    require 'functions.php';
    //Recuperamos los valores que vamos a llenar en la BD
    $Username = htmlentities($_POST ['Username']);
    $Password = htmlentities($_POST ['Password']);
    $nombres = htmlentities($_POST ['nombres']);
    $apellidos = htmlentities($_POST ['apellidos']);
    $genero = htmlentities($_POST['genero']);
    $correo = htmlentities($_POST['correo']);
    $Alumno = htmlentities($_POST ['Alumno']);

    //insertar es el nombre del boton guardar que esta en el archivo alumnos.view.php
    if (isset($_POST['insertar'])){

         $result = $conn->query("insert into users (username,password,rol) values ('$Username','$Password','$Alumno')");
        $id_usu=$conn->lastInsertId(); 
        $result2 = $conn->query("insert into infousuarios (nombres, apellidos, genero, correo, id_usu) values ('$nombres', '$apellidos', '$genero', '$correo','$id_usu')");
        if (isset($result) && isset($result2)) {
            header('location:admin_listado_alumnos.php?info=1');
        } else {
            header('location:admin_alumnos_alumnos.php?err=1');
        }// validación de registro

    //sino boton modificar que esta en el archivo alumnoedit.view.php
    }else if (isset($_POST['modificar'])) {
        //capturamos el id alumnos a modificar
            $id_alumno = htmlentities($_POST['id_alumno']);

            $result = $conn->query("update users set username = '$Username', password = '$Password', rol = '$Alumno' where id = " . $id_alumno);
            
            $result2 = $conn->query("update infousuarios set nombres = '$nombres', apellidos = '$apellidos', genero = '$genero', correo = '$correo' where id_usu = " . $id_alumno);
            if (isset($result) && isset($result2)) {
                header('location:admin_listado_alumnos.php?id=' . $id_alumno . '&info=1');
            } else {
                header('location:admin_listado_alumnos.php?id=' . $id_alumno . '&err=1');
            }// validación de registro
    }

}


<?php
if(!$_POST){
    header('location: admin_listado_alumnos.php');
}
else {
    //incluimos el archivo funciones que tiene la conexion
    require 'functions.php';
    //Recuperamos los valores que vamos a llenar en la BD
    $nombres = htmlentities($_POST ['nombres']);
    $apellidos = htmlentities($_POST ['apellidos']);
    $genero = htmlentities($_POST['genero']);
    $correo = htmlentities($_POST['correo']);


    //insertar es el nombre del boton guardar que esta en el archivo alumnos.view.php
    if (isset($_POST['insertar'])){

        $result = $conn->query("insert into alumnos (nombres, apellidos, genero, correo) values ('$nombres', '$apellidos', '$genero', '$correo')");
        if (isset($result)) {
            header('location:admin_listado_alumnos.php?info=1');
        } else {
            header('location:admin_alumnos_alumnos.php?err=1');
        }// validación de registro

    //sino boton modificar que esta en el archivo alumnoedit.view.php
    }else if (isset($_POST['modificar'])) {
        //capturamos el id alumnos a modificar
            $id_alumno = htmlentities($_POST['id_alumno']);
            $result = $conn->query("update alumnos set nombres = '$nombres', apellidos = '$apellidos', genero = '$genero',correo = '$correo' where id = " . $id_alumno);
            if (isset($result)) {
                header('location:admin_listado_alumnos.php?id=' . $id_alumno . '&info=1');
            } else {
                header('location:admin_listado_alumnos.php?id=' . $id_alumno . '&err=1');
            }// validación de registro
    }

}


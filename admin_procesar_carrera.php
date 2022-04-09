<?php
if(!$_POST){
    header('location: admin_listado_carrera.php');
}
else {
    //incluimos el archivo funciones que tiene la conexion
    require 'functions.php';
    //Recuperamos los valores que vamos a llenar en la BD
    $nombrecarrera = htmlentities($_POST ['nombrecarrera']);
    $id_facultad = htmlentities($_POST ['id_facultad']);

    //insertar es el nombre del boton guardar que esta en el archivo alumnos.view.php
    if (isset($_POST['insertar'])){

        $result = $conn->query("insert into carrera (nombrecarrera, id_facultad) values ('$nombrecarrera', '$id_facultad')");
        if (isset($result)) {
            header('location:admin_listado_carrera.php?info=1');
        } else {
            header('location:admin_listado_carrera.php?err=1');
        }// validación de registro

    //sino boton modificar que esta en el archivo alumnoedit.view.php
    }else if (isset($_POST['modificar'])) {
        //capturamos el id alumnos a modificar
            $id_carrera = htmlentities($_POST['id_carrera']);
            $result = $conn->query("update carrera set nombrecarrera = '$nombrecarrera', id_facultad = '$id_facultad' where id_carrera = " . $id_carrera);
            if (isset($result)) {
                header('location:admin_edit_carrera.php?id=' . $id_carrera . '&info=1');
            } else {
                header('location:admin_edit_carrera.php?id=' . $id_carrera . '&err=1');
            }// validación de registro
    }

}


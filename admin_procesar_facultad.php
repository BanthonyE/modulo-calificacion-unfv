<?php
if(!$_POST){
    header('location: admin_listado_facultad.php');
}
else {
    //incluimos el archivo funciones que tiene la conexion
    require 'functions.php';
    //Recuperamos los valores que vamos a llenar en la BD
    $nombrefacultad = htmlentities($_POST ['nombrefacultad']);

    //insertar es el nombre del boton guardar que esta en el archivo alumnos.view.php
    if (isset($_POST['insertar'])){

        $result = $conn->query("insert into facultad (nombrefacultad) values ('$nombrefacultad')");
        if (isset($result)) {
            header('location:admin_registro_facultad.php?info=1');
        } else {
            header('location:admin_registro_facultad.php?err=1');
        }// validación de registro

    //sino boton modificar que esta en el archivo alumnoedit.view.php
    }else if (isset($_POST['modificar'])) {
        //capturamos el id alumnos a modificar
            $id_facultad = htmlentities($_POST['id_facultad']);

            $result = $conn->query("update facultad set nombrefacultad = '$nombrefacultad' where id_facultad = " . $id_facultad);
            if (isset($result)) {
                header('location:admin_edit_facultad.php?id=' . $id_facultad . '&info=1');
            } else {
                header('location:admin_edit_facultad.php?id=' . $id_facultad . '&err=1');
            }// validación de registro
    }

}


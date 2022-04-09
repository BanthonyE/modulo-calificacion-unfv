<?php
if(!$_POST){
    header('location: admin_listado_cursos.php');
}
else {
    //incluimos el archivo funciones que tiene la conexion
    require 'functions.php';
    //Recuperamos los valores que vamos a llenar en la BD
    $nombre = htmlentities($_POST ['nombre']);
    $num_evaluaciones = htmlentities($_POST ['num_evaluaciones']);
    $unidcreditos = htmlentities($_POST ['unidcreditos']);
    $ciclo = htmlentities($_POST ['ciclo']);
    $periodo = htmlentities($_POST ['periodo']);

    //insertar es el nombre del boton guardar que esta en el archivo alumnos.view.php
    if (isset($_POST['insertar'])){

        $result = $conn->query("insert into materias (nombre,num_evaluaciones,unidcreditos,id_ciclo,id_periodo) values ('$nombre','$num_evaluaciones','$unidcreditos','$ciclo','$periodo')");
        if (isset($result)) {
            header('location:admin_registro_cursos.php?info=1');
        } else {
            header('location:admin_registro_cursos.php?err=1');
        }// validación de registro

    //sino boton modificar que esta en el archivo alumnoedit.view.php
    }else if (isset($_POST['modificar'])) {
        //capturamos el id alumnos a modificar
            $id_curso = htmlentities($_POST['id_curso']);

            $result = $conn->query("update materias set nombre = '$nombre', num_evaluaciones = '$num_evaluaciones', unidcreditos = '$unidcreditos', id_ciclo = '$ciclo', id_periodo ='$periodo' where id = " . $id_curso);
            if (isset($result)) {
                header('location:admin_edit_cursos.php?id=' . $id_curso . '&info=1');
            } else {
                header('location:admin_edit_cursos.php?id=' . $id_curso . '&err=1');
            }// validación de registro
    }

}
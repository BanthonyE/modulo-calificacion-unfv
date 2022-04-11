<?php
if(!$_POST){
    header('location: alumnos.view.php');
}
else {
    //incluimos el archivo para hacer la conexion
    require 'functions.php';
    //Recuperamos los valores que vamos a llenar en la BD
    $id_curso = htmlentities($_POST ['id_curso']);
    $num_eval = htmlentities($_POST ['num_eval']);
    $num_alumnos = htmlentities($_POST['num_alumnos']);

    //insertar es el nombre del boton guardar que esta en el archivo notas.view.php
    if (isset($_POST['insertar'])){


        $sqlalumnos = $conn->prepare("select m.id as idmateria, m.nombre, m.num_evaluaciones,n.nota1,n.nota2,n.nota3,n.parcial,n.final,n.promedio1,n.sustitutorio,n.aplazado,n.observaciones, a.id as idalumno, a.nombres,a.apellidos from materias as m inner join notas as n on m.id = n.id_materia inner join alumnos as a on n.id_alumno = a.id where m.id =".$id_curso);
        $sqlalumnos->execute();
        $alumnos = $sqlalumnos->fetchAll();

        /*Recorro el numero de estudiantes*/
        foreach ($alumnos as $index => $alumno) :
            

            
            $id_alumno = htmlentities($_POST['n1'.$i]);

        endforeach;

        if (isset($result)) {
            header('location:notas.view.php?grado='.$id_grado.'&materia='.$id_materia.'&seccion='.$id_seccion.'&revisar=1&info=1');
        } else {
            header('location:notas.view.php?grado='.$id_grado.'&materia='.$id_materia.'&seccion='.$id_seccion.'&revisar=1&err=1');
        }// validación de registro*/

    //sino boton modificar que esta en el archivo alumnoedit.view.php
    }else if (isset($_POST['modificar'])) {
        //capturamos el id alumnos a modificar
            $id_alumno = htmlentities($_POST['id']);
            $result = $conn->query("update alumnos set num_lista = '$numlista', nombres = '$nombres', apellidos = '$apellidos', genero = '$genero',id_grado = '$idgrado', id_seccion = '$idseccion' where id = " . $id_alumno);
            if (isset($result)) {
                header('location:alumnoedit.view.php?id=' . $id_alumno . '&info=1');
            } else {
                header('location:alumnoedit.view.php?id=' . $id_alumno . '&err=1');
            }// validación de registro

    }

}


<?php
require 'functions.php';

$permisos = ['Profesor'];
permisos($permisos);

if(isset($_GET['id'])) {

    $id_curso = $_GET['id'];

    $curso = $conn->prepare("select distinct m.id,m.nombre,aa.id_alum,i.nombres,i.apellidos from materias as m inner join alumasignatura as aa on m.id = aa.id_asignatura inner join infousuarios as i on i.id_usu=aa.id_alum where m.id =".$id_curso);
    $curso->execute();
    $curso = $curso->fetchAll();

    $nombrecurso = $conn->prepare("select nombre from materias where id =".$id_curso);
    $nombrecurso->execute();
    $nombrecurso = $nombrecurso->fetchAll();    

}else{
    Die('Ha ocurrido un error');
}


?>
<!DOCTYPE html>
<html>
<head>
<title>Listado de Carreras</title>
    <meta name="description" content="Módulo de calificaciones" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>módulo de calificaciones</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li class="active"><a href="profe_listado_cursos.php">Listado de Cursos</a> </li>
        <li><a href="#">Consulta de Notas</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Listado de alumnos del curso de <?php echo $nombrecurso[0]['nombre'] ?></h4>

            <button type="reset" onclick="window.location.href='profe_listado_cursos.php'">Regresar</button>
            <br>
            <br>
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <th>#</th>
                    <th>Alumno</th>
                    <th>Acción</th>
                </tr>
                <?php $cont=0; foreach ($curso as $curso) : $cont++;?>
                <tr>
                        <td align="center"><?php echo $cont ?></td>
                        <td align="center"><?php echo $curso['apellidos']." ".$curso['nombres'] ?></td>
                        <td align="center"><a href="profe_detalle_notas.php?id=<?php echo $curso['id_alum']?>&idcurso=<?php echo $curso['id']?>">Ver nota</a> </td>

                </tr>
                <?php endforeach;?>
            </table>
                <br><br>
                <button onclick="window.location.href='profe_consulta_notas.php?id=<?php echo $id_curso ?>'">Consultar Notas</button>
                <a class="btn-link" href="profe_registro_notas.php?id=<?php echo $id_curso ?>">Registrar Notas</a>
                <br><br>
                <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
                <?php
                if(isset($_GET['err']))
                    echo '<span class="error">Error al almacenar el registro</span>';
                if(isset($_GET['info']))
                    echo '<span class="success">Registro almacenado correctamente!</span>';
                ?>


        </div>
</div>

<footer>
   <p>Universidad Federico Villarreal &copy; 2022</p>
</footer>

</body>

</html>
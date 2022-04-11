<?php
require 'functions.php';

$permisos = ['Alumno'];
permisos($permisos);
//consulta los alumnos para el listaddo de alumnos
$curso = $conn->prepare("select m.id as id_curso, m.nombre as nombrecurso, s.nombre as nombreseccion, i.nombres as nombreprofesor, i.apellidos as apellidoprofesor, m.unidcreditos, m.id_ciclo, m.id_periodo from users as u inner join alumasignatura as aa on aa.id_alum=u.id inner join docenteasignatura as d on d.id_materia=aa.id_asignatura inner join materias as m on m.id=aa.id_asignatura inner join infousuarios as i on i.id_usu=d.id_usuario_docente inner join secciones as s on s.id=d.id_seccion where u.id=".$_SESSION["id_usu"]);
$curso->execute();
$curso = $curso->fetchAll();

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
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Listado de cursos</h4>
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Nombre del curso</th>
                    <th>Docente</th>
                    <th>Periodo</th>
                    <th>Sección</th>
                    <th colspan="2">Acciones</th>
                </tr>
                <?php foreach ($curso as $curso) :
                    
                    ?>
                    <tr>
                        <td align="center"><?php echo $curso['nombrecurso'] ?></td>
                        <td align="center"><?php echo $curso['nombreprofesor']." ".$curso['apellidoprofesor'] ?></td>
                        <td align="center"><?php echo $curso['id_periodo'] ?></td>
                        <td align="center"><?php echo $curso['nombreseccion'] ?></td>
                        <td><a href="alumno_detalle_notas.php?id_alum=<?php echo $_SESSION["id_usu"] ?>&id_curso=<?php echo $curso['id_curso']; ?>">Ver notas</a> </td>                    
                </tr>
                <?php endforeach;?>
            </table>
                <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
                <?php
                if(isset($_GET['err']))
                    echo '<span class="error">Error al almacenar el registro</span>';
                if(isset($_GET['info']))
                    echo '<span class="success">Registro almacenado correctamente!</span>';
                ?>
                <br>
                <a class="abutton" href="alumno_reporte_notas.php?id=<?php echo $_SESSION["id_usu"] ?>">Reporte de notas</a>
        </div>
</div>

<footer>
    <p>Universidad Federico Villarreal &copy; 2022</p>
</footer>

</body>

</html>
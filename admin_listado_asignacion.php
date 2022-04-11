<?php
require 'functions.php';

$permisos = ['Administrador','Profesor'];
permisos($permisos);
//consulta los alumnos para el listaddo de alumnos
$docenasig = $conn->prepare("select *, m.nombre as mnombre,m.id_ciclo as mciclo, i.nombres as unombre,s.nombre as snombre, d.id_docasig as iddoc from docenteasignatura as d inner join materias as m on d.id_materia = m.id inner join users as u on u.id = d.id_usuario_docente inner join secciones as s on s.id=d.id_seccion inner join infousuarios as i on i.id_usu=u.id order by d.id_docasig");
$docenasig->execute();
$docenasig = $docenasig->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
<title>Listado de Cursos | Registro de Cursos</title>
    <meta name="description" content="Listado de Cursos" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Listado de Docente Asignados</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li><a href="admin_listado_facultad.php">Facultad</a> </li>
        <li><a href="admin_listado_carrera.php">Carrera</a> </li>
        <li ><a href="admin_listado_docentes.php">Docente</a> </li>
        <li><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <li ><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li class="active"><a href="admin_listado_asignacion.php">Asignación</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Listado de Docentes Asignados</h4>
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Codigo</th><th>Asignatura</th><th>Ciclo</th><th>Seccion</th><th>Docente</th><th>Eliminar</th>
                </tr>
                <?php foreach ($docenasig as $dc) :?>
                <tr>
                    <td align="center"><?php echo $dc['iddoc'] ?></td>
                    
                    <td><?php echo $dc['mnombre'] ?></td>
                    <td><?php echo $dc['mciclo'] ?></td>
                     <td><?php echo $dc['snombre'] ?></td>
                    <td><?php echo $dc['unombre'] ?></td>


                    <td><a href="admin_delete_asignacion.php?id=<?php echo $dc['iddoc'] ?>">Eliminar</a> </td>

                   
                </tr>
                <?php endforeach;?>
            </table>
                <br><br>

                <a class="btn-link" href="admin_listado_docentes.php">Ver Docentes</a>
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
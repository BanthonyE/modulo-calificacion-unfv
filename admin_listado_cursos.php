<?php
require 'functions.php';

$permisos = ['Administrador','Profesor'];
permisos($permisos);
//consulta los alumnos para el listaddo de alumnos
$cursos = $conn->prepare("select *,m.nombre as materia from materias as m inner join periodo as p on m.id_periodo = p.id_periodo");
$cursos->execute();
$cursos = $cursos->fetchAll();
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
        <h1>Listado de Cursos</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li><a href="admin_listado_facultad.php">Facultad</a> </li>
        <li><a href="admin_listado_carrera.php">Carrera</a> </li>
        <li ><a href="admin_listado_docentes.php">Docente</a> </li>
        <li><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <li class="active"><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li><a href="admin_listado_Asignación.php">Asignación</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Listado de Cursos</h4>
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <th>No de<br>lista</th><th>Nombre</th><th>N° Evaluaciones</th><th>Unid. Cred.</th><th>Ciclo</th><th>Periodo</th>
                    <th>Editar</th><th>Eliminar</th>
                </tr>
                <?php foreach ($cursos as $c) :?>
                <tr>
                    <td align="center"><?php echo $c['id'] ?></td>
                    <td><?php echo $c['materia'] ?></td>
                    <td><?php echo $c['num_evaluaciones'] ?></td>
                    <td align="center"><?php echo $c['unidcreditos'] ?></td>
                    <td align="center"><?php echo $c['id_ciclo'] ?></td>
                    <td align="center"><?php echo $c['nombre'] ?></td>

                    <td><a href="admin_edit_cursos.php?id=<?php echo $c['id'] ?>">Editar</a> </td>
                    <td><a href="admin_delete_cursos.php?id=<?php echo $c['id'] ?>">Eliminar</a> </td>

                   
                </tr>
                <?php endforeach;?>
            </table>
                <br><br>

                <a class="btn-link" href="admin_registro_cursos.php">Agregar Cursos</a>
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
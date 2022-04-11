<?php
require 'functions.php';

$permisos = ['Administrador'];
permisos($permisos);
//consulta los alumnos para el listaddo de alumnos
$carreras = $conn->prepare("select c.id_carrera, c.nombrecarrera, f.id_facultad, f.nombrefacultad from carrera as c inner join facultad as f on c.id_facultad = f.id_facultad");
$carreras->execute();
$carreras = $carreras->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Listado de Carreras</title>
    <meta name="description" content="Listado de carreras" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Listado de Carreras</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li><a href="admin_listado_facultad.php">Facultad</a> </li>
        <li class="active"><a href="admin_listado_carrera.php">Carrera</a> </li>
        <li><a href="admin_listado_docentes.php">Docente</a> </li>
        <li><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <li><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li><a href="admin_listado_asignacion.php">Asignación</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Listado de Carreras</h4>
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Nombre de la carrera</th>
                    <th>Nombre de la facultad</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                <?php foreach ($carreras as $carrera) :?>
                <tr>
                    <td align="center"><?php echo $carrera['nombrecarrera'] ?></td>
                    <td align="center"><?php echo $carrera['nombrefacultad'] ?></td>
                    <td><a href="admin_edit_carrera.php?id=<?php echo $carrera['id_carrera'] ?>">Editar</a> </td>
                    <td><a href="admin_delete_carrera.php?id=<?php echo $carrera['id_carrera'] ?>">Eliminar</a> </td>
                </tr>
                <?php endforeach;?>
            </table>
                <br><br>

                <a class="btn-link" href="admin_registro_carrera.php">Agregar Carrera</a>
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
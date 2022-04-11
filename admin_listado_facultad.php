<?php
require 'functions.php';

$permisos = ['Administrador'];
permisos($permisos);
//consulta los alumnos para el listaddo de alumnos
$facultades = $conn->prepare("select f.id_facultad, f.nombrefacultad from facultad as f");
$facultades->execute();
$facultades = $facultades->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Listado de Facultades</title>
    <meta name="description" content="Listado de facultades" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Listado de Facultades</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li class="active"><a href="admin_listado_facultad.php">Facultad</a> </li>
        <li><a href="admin_listado_carrera.php">Carrera</a> </li>
        <li><a href="admin_listado_docentes.php">Docente</a> </li>
        <li><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <li><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li><a href="admin_listado_asignacion.php">Asignación</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Listado de Facultades</h4>
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Nombre de Facultad</th>
                    <th>Editar</th><th>Eliminar</th>
                </tr>
                <?php foreach ($facultades as $facultades) :?>
                <tr>
                    <td align="center"><?php echo $facultades['nombrefacultad'] ?></td>
                    <td><a href="admin_edit_facultad.php?id=<?php echo $facultades['id_facultad'] ?>">Editar</a> </td>
                    <td><a href="admin_delete_facultad.php?id=<?php echo $facultades['id_facultad'] ?>">Eliminar</a> </td>
                </tr>
                <?php endforeach;?>
            </table>
                <br><br>

                <a class="btn-link" href="admin_registro_facultad.php">Agregar Facultad</a>
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
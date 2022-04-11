<?php
require 'functions.php';

$permisos = ['Administrador','Profesor'];
permisos($permisos);
//consulta los alumnos para el listaddo de alumnos
$users = $conn->prepare("select u.id, u.username,u.password,i.nombres,i.apellidos,i.genero,i.correo, u.rol from users as u inner join infousuarios as i on 
u.id=i.id_usu");
$users->execute();
$users = $users->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Listado de Docentes | Registro de Docentes</title>
    <meta name="description" content="Listado de Docentes" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Listado de Docentes</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li><a href="admin_listado_facultad.php">Facultad</a> </li>
        <li><a href="admin_listado_carrera.php">Carrera</a> </li>
        <li class="active"><a href="admin_listado_docentes.php">Docente</a> </li>
        <li><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <li><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li><a href="admin_listado_asignacion.php">Asignación</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Listado de Docentes</h4>
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <th>No de<br>lista</th><th>Username</th><th>Password</th><th>Nombre</th><th>apellidos</th><th>Genero</th><th>Correo</th><th>Rol</th>
                    <th>Editar</th><th>Eliminar</th><th>Asignación</th>
                </tr>
                <?php foreach ($users as $u) :?>
                <tr>
                    <?php
            if ($u['rol'] == "Profesor") { ?>
    
                    <td align="center"><?php echo $u['id'] ?></td>
                    <td><?php echo $u['username'] ?></td>
                    <td><?php echo $u['password'] ?></td>
                    <td align="center"><?php echo $u['nombres'] ?></td>
                    <td align="center"><?php echo $u['apellidos'] ?></td>
                    <td align="center"><?php echo $u['genero'] ?></td>
                    <td align="center"><?php echo $u['correo'] ?></td>
                    <td align="center"><?php echo $u['rol'] ?></td>
                    <td><a href="admin_edit_docentes.php?id=<?php echo $u['id'] ?>">Editar</a> </td>
                    <td><a href="admin_delete_docentes.php?id=<?php echo $u['id'] ?>">Eliminar</a> </td>
                    <td><a href="admin_asignacion_docentes.php?id=<?php echo $u['id'] ?>">Asignación</a> </td>
            <?php }
            ?>
                   
                </tr>
                <?php endforeach;?>
            </table>
                <br><br>

                <a class="btn-link" href="admin_registro_docentes.php">Agregar Docente</a>
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
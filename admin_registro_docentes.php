<!DOCTYPE html>
<?php
require 'functions.php';
//Define queienes tienen permiso en este archivo
$permisos = ['Administrador'];
permisos($permisos);

?>
<html>
<head>
<title>Registro de Docentes</title>
    <meta name="description" content="Registro de Docentes" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Registro de Docentes</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li ><a href="admin_listado_facultad.php">Facultad</a> </li>
        <li><a href="admin_listado_carrera.php">Carrera</a> </li>
        <li class="active"><a href="admin_listado_docentes.php">Docente</a> </li>
        <li><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
        <li><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li><a href="admin_listado_Asignación.php">Asignación</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Registro de Docentes</h4>
            <form method="post" class="form" action="admin_procesar_docentes.php">
                <label>Username</label><br>
                <input type="text" required name="Username" maxlength="45">
                <br>
                <label>Password</label><br>
                <input type="text" required name="Password" maxlength="45">
                <br><br>
                <label>Nombre</label><br>
                <input type="text" required name="Nombre" maxlength="45">
                <br><br>
                <label>Rol</label><br>
                <input type="text" readonly name="Profesor" value="Profesor">
                <br><br>
                <button type="submit" name="insertar">Guardar</button> <button type="reset">Limpiar</button> <a class="btn-link" href="admin_listado_docentes.php">Ver Listado</a>
                <br><br>
                <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
                <?php
                if(isset($_GET['err']))
                    echo '<span class="error">Error al almacenar el registro</span>';
                if(isset($_GET['info']))
                    echo '<span class="success">Registro almacenado correctamente!</span>';
                ?>

            </form>
        <?php
        if(isset($_GET['err']))
            echo '<span class="error">Error al guardar</span>';
        ?>
        </div>
</div>

<footer>
    <p>Universidad Federico Villarreal &copy; 2022</p>
</footer>

</body>

</html>
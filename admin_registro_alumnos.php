<!DOCTYPE html>
<?php
require 'functions.php';
//Define queienes tienen permiso en este archivo
$permisos = ['Administrador'];
permisos($permisos);

?>
<html>
<head>
<title>Registro de Alumnos</title>
    <meta name="description" content="Registro de Alumnos" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Registro de Alumnos</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li ><a href="admin_listado_facultad.php">Facultad</a> </li>
        <li><a href="admin_listado_carrera.php">Carrera</a> </li>
        <li ><a href="admin_listado_docentes.php">Docente</a> </li>
        <li class="active"><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
        <li><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li><a href="admin_listado_asignacion.php">Asignación</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Registro de Alumnos</h4>
            <form method="post" class="form" action="admin_procesar_alumnos.php">
                <label>Nombres</label><br>
                <input type="text" required name="nombres" maxlength="45">
                <br>
                <label>Apellidos</label><br>
                <input type="text" required name="apellidos" maxlength="45">
                <br><br>
                <label>Genero</label><br>
                <input type="text" required name="genero" maxlength="45" placeholder="M/F">
                <br><br>
                <label>Correo</label><br>
                <input type="text" name="correo" required placeholder="xxxxx@unfv.edu.pe">
                <br><br>
                <button type="submit" name="insertar">Guardar</button> <button type="reset">Limpiar</button> <a class="btn-link" href="admin_listado_alumnos.php">Ver Listado</a>
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
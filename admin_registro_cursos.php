<!DOCTYPE html>
<?php
require 'functions.php';
//Define queienes tienen permiso en este archivo
$permisos = ['Administrador'];
permisos($permisos);

?>
<html>
<head>
<title>Registro de Cursos</title>
    <meta name="description" content="Registro de Cursos" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Registro de Cursos</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li ><a href="admin_listado_facultad.php">Facultad</a> </li>
        <li><a href="admin_listado_carrera.php">Carrera</a> </li>
        <li ><a href="admin_listado_docentes.php">Docente</a> </li>
        <li><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
        <li class="active"><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li><a href="admin_listado_asignacion.php">Asignación</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Registro de Cursos</h4>
            <form method="post" class="form" action="admin_procesar_cursos.php">
                <label>Nombre</label><br>
                <input type="text" required name="nombre" maxlength="45">
                <br>
                <label>N° Evaluaciones</label><br>
                <input type="text" required name="num_evaluaciones" maxlength="45">
                <br><br>
                <label>Uni. Cred.</label><br>
                <input type="text" required name="unidcreditos" maxlength="45">
                <br><br>
                <label>Ciclo</label><br>
                <select name="ciclo" id="ciclo">
                <option value="1">Ciclo 1</option>
                <option value="2">Ciclo 2</option>
                <option value="3">Ciclo 3</option>
                <option value="4">Ciclo 4</option>
                <option value="5">Ciclo 5</option>
                <option value="6">Ciclo 6</option>
                <option value="7">Ciclo 7</option>
                <option value="8">Ciclo 8</option>
                <option value="9">Ciclo 9</option>
                <option value="10">Ciclo 10</option>
                </select>
                <br><br>
                <label>Periodo</label><br>
                <select name="periodo" id="ciclo">
                <option value="1">Periodo 1</option>
                <option value="2">Periodo 2</option>
                </select>
                <br><br>
                <button type="submit" name="insertar">Guardar</button> <button type="reset">Limpiar</button> <a class="btn-link" href="admin_listado_cursos.php">Ver Listado</a>
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
    <p>Derechos reservados &copy; 2020</p>
</footer>

</body>

</html>